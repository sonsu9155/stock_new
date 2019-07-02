<?php

namespace App\Http\Controllers;

use App\Mail\ForgotPassword;
use App\User;
use App\UserSession;
use App\OnlineUser;
use App\Setting;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use Mail;
use Session;
use Validator;

class SessionsController extends Controller {
    public function login() {
       // var_dump(Hash::make('123456'));exit();   
        return view('bsb.authentications.login');
    }
   
    public function doLogin(Request $request) {
        //
        $system_guard = Setting::latest()->first()->system_safeguard;
        $system_guard_direct = Setting::latest()->first()->system_safeguard_direc;
        if ($system_guard =="on"){
            return redirect('/login/index')
            ->with('error',$system_guard_direct);
        }

        $valid = ['username' => 'required', 'password' => 'required'];
        $validate = Validator::make($request->all(), $valid);
        if ($validate->fails()) {
            return redirect('login')
                ->withInput()
                ->withErrors($validate);
        }
        $pass=$request['password'];
        //var_dump(Hash::make('123456'));exit();
        if (Auth::attempt(
            ['username' => $request['username'],
                'password' => $request['password'],
                'status' => '1'],
            $request['remember']
        )) {
            $agent = new Agent();
            // store session
            $found = UserSession::where('user_id', '=', Auth::user()->id)->first();
            if ($found) {
                $found->update(['session_id' => Session::getId()]);
            } else {
                UserSession::create(['user_id' => Auth::user()->id, 'session_id' => Session::getId()]);
            }
           // store online_user
           //var_dump('here');exit();
            $found1 = OnlineUser::where('user_id', '=', Auth::user()->id)->first();
            if ($found1) {
                $found1->update(['created_at' => \Carbon\Carbon::now()->toDateTimeString()]);
            } else {
                OnlineUser::create([
                    'user_id' => Auth::user()->id,
                    'platform' => $agent->device().','.$agent->platform(),
                    'ipaddress' => $request->ip(),
                    'created_at'     => \Carbon\Carbon::now()->toDateTimeString(),
                    'updated_at'     => \Carbon\Carbon::now()->toDateTimeString(),
                ]);
            }

            if (Auth::user()->hasRole('superadministrator')) {
               
                return redirect()->intended('dashboard');

            } elseif (Auth::user()->hasRole('user')) {
                if($agent->isDesktop()){
                    return redirect()->intended('/web/index');
                }elseif($agent->isPhone()){
                    return redirect()->intended('/site/wapindex');
                }            
            }
        } else {
            Session::flash('error', '登录失败。 用户名和密码不匹配。');
            return redirect('login')
                ->withInput();
        }
    }

    public function logout() {
        //OnlineUser::where('user_id',Auth::user()->id)->delete();
        Auth::logout();        
        return redirect('/');
    }

    public function forgot() {
        return view('bsb.authentications.forgot');
    }

    public function doForgot(Request $request) {
        $user = User::where('phone', '=', $request->get('phone'))->first();
       
        if (!empty($user)) {
            $user->update(['forgot_token' => str_random(60)]);
            $reset_token = $user->forgot_token;
            //Mail::to($user->email)->send(new ForgotPassword($user, $reset_token));
            return new ForgotPassword($user, $reset_token);
            // Session::flash('success', 'please check your email for next step reset password');
            // return back();
        }else{
            Session::flash('error', '找不到用户');
            return back()->withInput();
        }
       
    }

    public function passwordReset(Request $request, $token) {
        $user = User::where('forgot_token', $token)->first();
        if ($user == null) {
            Session::flash('error', '您的令牌已过期');
            return redirect('login');
        }
        return view('bsb.authentications.reset')->with('token', $token);
    }

    public function doPasswordReset(Request $request, $token) {
        $user = User::where('forgot_token', $request->token)->first();
        //var_dump($user);exit();
        if (!empty($user)) {
            $hash_password = Hash::make($request['password']);
            $validate = Validator::make($request->all(), User::valid_update_forgot());
            if ($validate->fails()) {
                return back()
                    ->withErrors($validate)
                    ->withInput();
            } else {
                if ($user->update(
                    [
                        'password' => $hash_password,
                        'password_confirmation' => $hash_password,
                        'forgot_token' => null]
                )) {
                    Session::flash('success', '成功更新密码，让我们登录');
                    echo '<script> alert("成功更新密码，让我们登录");</script>' ;
                    echo "<script>location.href = '/'</script>";
                }
            }
        }
        Session::flash('error', '更新用户失败');
        return redirect('/');
    }
}
