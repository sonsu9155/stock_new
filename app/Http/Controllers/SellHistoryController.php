<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SellHistory;

class SellHistoryController extends Controller
{
    //
    public function index() {
        $sellHistories = SellHistory::get();
        return view('bsb.sellhistory.index')->with(compact('sellHistories'));  
    }

    public function delete($id){
      
        $sellhistory = SellHistory::findorfail($id);
        $updateNow = $sellhistory->delete($id);

        return  redirect('/sellhistory');
    }
}
