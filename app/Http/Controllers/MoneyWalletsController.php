<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MoneyWallet;
use App\User;
use App\DepositHistory;
use App\WithdrawHistory;
use App\Setting;
use App\StockWallet;
use App\FundRequest;

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
    public function detail(){
        $users = User::get();        
        return view('bsb.moneywallets.detail')->with(compact('users'));
    }

    public function update(){
        $cost_exchange_rate = Setting::latest()->first()->cost_exchange_rate;
        $type = $_POST['type'];
        $user_id=$_POST['userid'];
        $user = User::where('id',$user_id)->first();      
        if(empty($user)){
            return redirect('/moneywallets/detail')->with('error','这个用户不存在。');
        }
        if ($type=="deposite"){
            //$user_id=$_POST['userid'];
            $amount = $_POST['amount'];            
            $money_amount = MoneyWallet::where('id',$user->money_wallet_id)->first()->after_amount;
            $stock_real_amount = StockWallet::where('id',$user->stock_wallet_id)->first()->before_amount;
            $stock_give_amount = StockWallet::where('id',$user->stock_wallet_id)->first()->after_amount;
            DepositHistory::create([
                'user_id'  => $user_id,
                'amount'  => $amount,
                'type'  => $_POST['bill_type'],
                'status' => '1',
                'before_amount' => $stock_real_amount
            ]);
         
            $res1 = MoneyWallet::where('id',$user->money_wallet_id)->update(['after_amount'=>$money_amount + $cost_exchange_rate*$amount]);
            $res2 = StockWallet::where('id',$user->stock_wallet_id)->update(['after_amount'=>$stock_give_amount + ($cost_exchange_rate-1)*$amount ]);
            $res3 = StockWallet::where('id',$user->stock_wallet_id)->update(['before_amount'=>$stock_real_amount + $amount ]);
            return redirect('/moneywallets');
        }
        elseif($type=="deduction"){           
            $amount_org = $_POST['amount'];
            $money_wallet = MoneyWallet::where('id',$user->money_wallet_id)->first();
            $money_amount = $money_wallet->after_amount;
            $money_stock_amount = $money_wallet->before_amount; 
            //$bill_type=$_POST['bill_type'];           
            $stock_wallet = StockWallet::where('id',$user->stock_wallet_id)->first();
            $stock_real_amount = $stock_wallet->before_amount;
            $stock_give_amount = $stock_wallet->after_amount;
            //////////////////////////win or rose////////////////////
            if(($money_amount + $money_stock_amount)>($stock_give_amount+$stock_real_amount)){
                $amount = $amount_org;
                if($amount_org>($money_amount-$stock_give_amount)){
                    return redirect('/moneywallets/detail')->with('error','不能出金。退出太多了。');
                }else{
                    $res1 = MoneyWallet::where('id',$user->money_wallet_id)->update(['after_amount'=>$money_amount - $amount]);
                    $res2 = StockWallet::where('id',$user->stock_wallet_id)->update(['before_amount'=>$stock_real_amount -  $amount]);
                }
            }else{
                $amount = $amount_org * 10;
                if($amount_org>($money_amount-$stock_give_amount)){
                    return redirect('/moneywallets/detail')->with('error','不能出金。退出太多了。');
                }else{
                    $res1 = MoneyWallet::where('id',$user->money_wallet_id)->update(['after_amount'=>$money_amount - $amount]);
                    $res2 = StockWallet::where('id',$user->stock_wallet_id)->update(['before_amount'=>$stock_real_amount -  $amount_org]);
                    $res3 = StockWallet::where('id',$user->stock_wallet_id)->update(['after_amount'=>$stock_give_amount -  $amount_org *  ($cost_exchange_rate-1)]);
                }
            }
            //if($bill_type=="handling"){
                
                $res4 = WithdrawHistory::create([
                    'user_id'  => $user_id,
                    'amount'  => $amount,
                    'bank'  => $user->kh_bank,
                    'bank_name' =>$user->bank_name,
                    'type'  => $_POST['bill_type'],
                    'status' => '1',
                    'before_amount' => $stock_real_amount
                ]);
                //var_dump($res3);exit();
            //}
           
            return redirect('/moneywallets');
        }
       
    }

    
}
