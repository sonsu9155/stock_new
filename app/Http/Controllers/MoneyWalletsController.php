<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MoneyWallet;
use App\User;
use App\DepositHistory;
use App\WithdrawHistory;
use App\Setting;
use App\StockWallet;

class MoneyWalletsController extends Controller
{
    //
    public function index(){
        $money_wallets=MoneyWallet::get();
        return view('bsb.moneywallets.index')->with(compact('money_wallets'));
    }

    public function edit(){
       
        return view('bsb.moneywallets.edit');
    }

    public function update(){
        $cost_exchange_rate = Setting::latest()->first()->cost_exchange_rate;
        $type = $_POST['type'];
        $user_id=$_POST['userid'];
        $user = User::where('id',$user_id)->first();
       // var_dump($user);exit();
        if(empty($user)){
            return redirect('/moneywallets/edit')->with('error','这个用户不存在。');
        }
        if ($type=="deposite"){
            //$user_id=$_POST['userid'];
            $amount = $_POST['amount'];            
            $before_amount = MoneyWallet::where('id',$user_id)->first()->after_amount;
            $real_before_amount = StockWallet::where('id',$user_id)->first()->after_amount;
            DepositHistory::create([
                'user_id'  => $user_id,
                'amount'  => $amount,
                'type'  => $_POST['bill_type'],
                'status' => '1',
                'before_amount' => $before_amount
            ]);
            //var_dump($real_before_amount);exit();
            $res1 = MoneyWallet::where('id',$user_id)->update(['after_amount'=>$before_amount + $cost_exchange_rate*$amount]);
            $res2 = StockWallet::where('id',$user_id)->update(['after_amount'=>$real_before_amount + ($cost_exchange_rate-1)*$amount ]);
            return redirect('/moneywallets');
        }
        elseif($type=="deduction"){
            //$user_id = $_POST['userid'];
            $amount = $_POST['amount'];
            $before_amount = MoneyWallet::where('id',$user_id)->first()->after_amount;
            $bill_type=$_POST['bill_type'];
            $real_before_amount = StockWallet::where('id',$user_id)->first()->after_amount;
            //if($bill_type=="handling"){
                $res1 = MoneyWallet::where('id',$user_id)->update(['after_amount'=>$before_amount - $cost_exchange_rate*$amount]);
                $res2 = StockWallet::where('id',$user_id)->update(['after_amount'=>$real_before_amount -  ($cost_exchange_rate-1)*$amount]);
                WithdrawHistory::create([
                    'user_id'  => $user_id,
                    'amount'  => $amount,
                    'type'  => $_POST['bill_type'],
                    'status' => '1',
                    'before_amount' => $before_amount
                ]);
            //}
           
            return redirect('/moneywallets');
        }
       
    }

    
}
