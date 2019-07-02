<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OnlineUser;

class OnlineUserController extends Controller
{
    //
    public function index(){
        $onlinehistories = OnlineUser::get();
        return view('bsb.onlinehistory.index')->with(compact('onlinehistories'));
    }

    public function delete($id){
      
        $lecture = OnlineUser::findorfail($id);
        $updateNow = $lecture->delete($id);

        return  redirect('/onlineuser');
    }
}
