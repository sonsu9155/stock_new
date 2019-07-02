<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class PassportController extends Controller
{
    //
    public function login(Request $request){
        return $request->all();
     }
     public function dologin(Request $request){
        if($request){         
         if (auth()->attempt(
             ['username' => $request['name'], 'password' => $request['password']]           
         )) {                     
           
             $user = auth()->user();
            // var_dump(auth('api')->user());exit();
             $token =  $user->createToken('MyApp')->accessToken;
             //var_dump();exit();
             $res = array('status'=>'success', 'token'=>$token);
             return  json_encode($res);           
         } else {
             $res = array('status'=>'error', 'content'=>'ID或密码错误');
             return  json_encode($res);     
         }
        }else{
             
            $res = array('status'=>'error', 'content'=>'输入您的用户名和密码。');
             return  json_encode($res);  
        }
      }

      public function details()
      {
          
          return response()->json(['user' => auth('api')->user()], 200);
      }
     
}
