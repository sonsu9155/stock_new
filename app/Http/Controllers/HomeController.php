<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index(){
        return view('index');
    }
    public function neirong(){
        return view('xinneirong');
    }
    public function about(){
        return view('about');
    }
    public function rule(){
        return view('rule');
    }
}
