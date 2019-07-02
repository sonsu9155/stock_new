<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\WithdrawHistory;

class WithdrawController extends Controller
{
    //
    public function index() {
        $withdrawHistories = WithdrawHistory::get();
        return view('bsb.withdrawhistory.index')->with(compact('withdrawHistories'));   
    }

    public function delete($id){
        $withdrawhistory = WithdrawHistory::findorfail($id);
        $updateNow = $withdrawhistory->delete($id);

        return  redirect('/withdrawhistory');
    }
}
