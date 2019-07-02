<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StockType;

class StockGraphController extends Controller
{
    //
    public function index() {
        $stockTypes = StockType::get();
        return view('bsb.stockgraph.index')->with(compact('stockTypes'));  
    }
}
