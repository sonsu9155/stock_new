<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;

class SettingController extends Controller
{
    //
    public function setting(){
        $data = Setting::latest()->first();
        return view('bsb.setting.setting')->with(compact('data'));
    }

    public function dosetting(Request $request){

        // var_dump($request->open_xitong);exit();
        // $datas= array_merge($request->all(), ['index' => 'value']);
        // foreach ($datas as  $data){
        //     Setting::create($data);
        // }
        Setting::truncate();
        $request->offsetUnset('_token');
        $request->offsetUnset('Submit');
        Setting::updateOrCreate($request->all());
        
        return back();

    }
}
