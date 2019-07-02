<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DepositHistory;

class DepositController extends Controller
{
    //
    public function index() {
        $depositHistories = DepositHistory::get();
        return view('bsb.deposithistory.index')->with(compact('depositHistories'));  
    }
}
