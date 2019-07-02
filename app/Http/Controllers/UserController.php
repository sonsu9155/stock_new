<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\MoneyWallet;
use App\StockWallet;
use App\OnlineUser;
use App\FundRequest;
use Hash;
use App\RoleUser;

class UserController extends Controller
{
    //
    public function index() {
        $users = User::get();
        return view('bsb.user.index')->with(compact('users'));   
    }

    public function create() {
        return view('bsb.user.create');   
    }

    public function docreate(Request $data) {

        MoneyWallet::create([
            'before_amount' => 0,
            'after_amount' => 0
        ]);
        StockWallet::create([
            'before_amount' => 0,
            'after_amount' => 0
        ]);
        $moeny = MoneyWallet::get();
        $stock = StockWallet::get();
        //var_dump($data->file('filename'));exit();
        if($data->hasfile('filename'))
         {
         
            foreach($data->file('filename') as $image)
            {
                $name=$image->getClientOriginalName();
                $image->move(public_path().'/images/upload/'.$data['name'], $name);  
                $image_url[] = $name;  
            }
         }
        $result = User::create([
            'username'     => $data['name'],
            'password' => Hash::make($data['password']) ,
            'name'  => $data['realname'],
            'idcard'  => $data['idcard'],
            'kh_bank' => $data['kh_bank'],
            'bank_name' => $data['bank_name'],        
            'bank_card'  => $data['bank_card'],  
            'phone'    => $data['mobile'], 
            'atmpwd' =>$data['atmpwd'],   
            'image_url' => json_encode($image_url),         
            'status' => $data['agent'],
            'money_wallet_id' => $moeny[ $moeny->count() -1 ]->id,
            'stock_wallet_id' => $stock[ $stock->count() -1 ]->id
        ]); 
        $user_id = User::latest()->first()->id;
        RoleUser::create([
            'user_id'  => $user_id,
            'role_id'  => '2'
        ]);
       
        return redirect('/users');
    }

    public function edit($id){
        $user = User::find($id);
        return view('bsb.user.edit')->with(compact('user'));
    }

    public function detail($id){
        $user = User::find($id);
        return view('bsb.user.detail')->with(compact('user'));
    }
    public function update($id, Request $request){
        $input = $request->all();
        $input['password'] = Hash::make($request->password);
        $user = User::findorfail($id);
        $updateNow = $user->update($input);

        return  redirect('/users');
    }
    public function delete($id){      
        $user = User::findorfail($id);
        $updateNow = $user->delete($id);
        $money_wallet = MoneyWallet::findorfail($id);
        $updatenow =$money_wallet->delete($id);
        $stock_wallet = StockWallet::findorfail($id);
        $updatenow =$stock_wallet->delete($id);
        $fund_requests = FundRequest::where('user_id',$user->id)->get();
        if($fund_requests){
            foreach($fund_requests as $fund_request){
                $fund_request->delete();
            }
        }
      
        return  redirect('/users');
    }
}
