<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FundRequest;

class FundRequestController extends Controller
{
    //
    public function index(){
        
        $fund_requests = FundRequest::get();
        //$user = User::where('money_wallet_id',$fund_request)
        return view('bsb.fundrequest.index')->with(compact('fund_requests'));
    }

    public function delete($id){
        $fund_request = FundRequest::findorfail($id);
        $updateNow = $fund_request->delete($id);

        return  redirect('/fundrequest');
    }
}
