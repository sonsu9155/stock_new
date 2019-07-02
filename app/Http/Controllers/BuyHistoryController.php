<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BuyHistory;

class BuyHistoryController extends Controller
{
    
    public function index() {
        $buyhistories = BuyHistory::get();
        return view('bsb.buyhistory.index')->with(compact('buyhistories')); 
    }
}
