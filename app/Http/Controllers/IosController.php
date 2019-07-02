<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;
use Validator;
use App\User;
use Hash;
use App\MoneyWallet;
use App\StockWallet;
use App\UserSession;
use App\RoleUser;
use App\Setting;
use App\FundRequest;
use App\news;
use App\StockType;
use App\BuyHistory;
use App\SellHistory;
use Carbon\Carbon;
use Cmgmyr\Messenger\Models\Message;
use Cmgmyr\Messenger\Models\Participant;
use Cmgmyr\Messenger\Models\Thread;
use Session;
class IosController extends Controller
{
    //
    public function login(Request $request){
        return $request->all();
     }
     public function dologin(Request $request){
        if($request){         
         if (Auth::attempt(
             ['username' => $request['name'], 'password' => $request['password']]           
         )) {
             //var_dump(auth('api')->user()->id);exit();
             // store session
            
             $found = UserSession::where('user_id', '=', auth('api')->user()->id)->first();
             if ($found) {
                 $found->update(['session_id' => Session::getId()]);
             } else {
                 UserSession::create(['user_id' => auth('api')->user()->id, 'session_id' => Session::getId()]);
             }
             $user = auth('api')->user();
             $success['token'] =  $user->createToken('MyApp')->accessToken;


             
             //var_dump();exit();
             $res = array('status'=>'success', 'content'=>$success['token']);
             return  json_encode($res);           
         } else {
             $res = array('status'=>'error', 'content'=>'ID或密码错误');
             return  json_encode($res);     
         }
        }else{
             
            $res = array('status'=>'error', 'content'=>'输入您的用户名和密码。');
             return  json_encode($res);  
        }
      }

      public function wapindex(Request $request){     
       
        $user_id = auth('api')->user()->id;
        $user = User::where('id','=', $user_id)->first();
        $money_wallet = MoneyWallet::where('id', '=', $user->money_wallet_id)->first();


        $res = array('status'=>'success','useable_amount'=>$money_wallet->after_amount, 'user_name'=>$user->name);
        return json_encode($res);
      }

      public function wapinfo(Request $request){
        $user_id = auth('api')->user()->id;
        $user = User::where('id','=', $user_id)->first();
        $setting = Setting::latest()->first();
        $moneywallet = MoneyWallet::where('id', '=', $user->money_wallet_id)->first();
        $stockwallet = StockWallet::where('id', '=', $user->money_wallet_id)->first();
        $fund = FundRequest::where('user_id',$user->id)->sum('money');

        $res = array(
            'status'=>'success',
            'user_name'=>$user->name,
            'protection_money'=>$moneywallet->before_amount + $moneywallet->after_amount - $stockwallet->after_amount,
            'usable_protection_money'=>$moneywallet->before_amount + $moneywallet->after_amount - $stockwallet->after_amount - $fund,
            'buy_fee'=>$setting->cost_bull_max *100,
            'sell_fee'=>$setting->cost_sell_max *100,
            'save_fee'=>$setting->cost_save_max *100,
            'save_day'=>$setting->cost_save_day,
            'phone_num'=>$user->phone,
            'date'=>$moneywallet->updated_at,
        );
        return json_encode($res);

      }

      public function wapxiaoxi(Request $request){
        $user_id = auth('api')->user()->id;
        $threads = Thread::forUser( $user_id )->get();    
        $res=array( 'status'=>'success');
        $tmpArry = array();
        foreach($threads as $thread){
            $res1=array(               
                'from'=>'管理员发送',
                'title'=>$thread->subject,
                'content'=>$thread->messages[0]->body,
                'date'=>$thread->created_at,
                'status'=>'已读'
            );
            array_push($tmpArry,$res1);
        }
        $res["messages"] = $tmpArry;
        return json_encode($res);
      }

      public function wapindex2(Request $request){
        $sh = $this->getCompositeIndex('s_sh000001');      
       
        $sz = $this->getCompositeIndex('s_sz399001');
        $cy = $this->getCompositeIndex('s_sz399006');
        
        $news = News::orderBy('updated_at', 'contents')->get();
       
        $res = array('status'=>'success','sh'=>$sh, 'sz'=>$sz, 'cy'=>$cy );
        $tmpArry = array();
        foreach($news as $index => $new_one){
            $res1=array(
                'contents'=>$new_one->contents,
                'date'=>$new_one->updated_at
            );
            array_push($tmpArry, $res1);
        }
        $res["news"] = $tmpArry;
        // array_push($res, array("news" => $tmpArry) );
        // //array_push($res,array());   
        //var_dump($res);exit();       
        return json_encode($res);
      }

      public function getCompositeIndex(string $stockcode){
        $sh_url = "http://hq.sinajs.cn/list=".$stockcode;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $sh_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        $data = curl_exec($ch);
        curl_close($ch);        
        $realdata = mb_substr($data, 23, strlen($data)-30);
        
        $utf8Str = mb_convert_encoding($realdata , 'UTF-8' , 'GBK');
        $realdata_arr = explode (",", $utf8Str);
        //var_dump($realdata);exit();
        return $realdata_arr;

    }
    public function getstock(Request $request){
        // $this->buyhistory_init();
        if(!Input::get()){
            $res = array('status'=>'error', 'content'=>'请正确输入密码。');
            return json_encode($res);
        }
         $stockcode = $_GET['stockcode']; 
         $stockdata= $this->getstockPrice($stockcode);
         return json_encode($stockdata);
     }
     public function getstockPrice($stockcode){
         if(substr($stockcode,0,1)=='6'){
             $sh_url = "http://hq.sinajs.cn/list=sh".$stockcode;
             $image_url = "http://image2.sinajs.cn/newchart/min/sh".$stockcode.".gif";
         }else{
             $sh_url = "http://hq.sinajs.cn/list=sz".$stockcode;
             $image_url = "http://image2.sinajs.cn/newchart/min/sz".$stockcode.".gif";
         }       
         $ch = curl_init();
         curl_setopt($ch, CURLOPT_URL, $sh_url);
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
         curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
         
         $data = curl_exec($ch);
         //var_dump($data);exit();
         curl_close($ch);        
         $realdata = mb_substr($data, 21, strlen($data)-24);         
         $utf8Str = mb_convert_encoding($realdata , 'UTF-8' , 'GBK');
         $realdata_arr = explode (",", $utf8Str);
         //$realdata = utf8_decode($realdata);
         //var_dump($utf8Str);exit();
         $realdata_arr["image_url"] = $image_url;
         $realdata_arr["status"] = 'success';
         return $realdata_arr;
 
     }
     public function getdeal(){
        //var_dump('here');exit();
        $user_id = auth('api')->user()->id;
        $buyhistories = BuyHistory::where('user_id','=', $user_id)->get();
        $realdata_arr=array();
         foreach($buyhistories as $index => $buyhistory){
             $stocktype_id = $buyhistory->stock_type_id;
             $stockcode = StockType::where('id','=', $stocktype_id)->first()->code;
             if(substr($stockcode,0,1)=='6'){
                $sh_url = "http://hq.sinajs.cn/list=sh".$stockcode;
            }else{
                $sh_url = "http://hq.sinajs.cn/list=sz".$stockcode;
            }   
             $ch = curl_init();
             curl_setopt($ch, CURLOPT_URL, $sh_url);
             curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
             curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
             $data = curl_exec($ch);           
             curl_close($ch);                    
             $data_arr = explode (",", $data);
             array_push($realdata_arr, $data_arr[3]);            
        }
        //var_dump($realdata_arr);exit();
        return json_encode($realdata_arr);
    }
    public function waporder(Request $request){
        $user_id = auth('api')->user()->id;
        $user = User::where('id','=', $user_id)->first();
        $money_wallet = MoneyWallet::where('id', '=', $user->money_wallet_id)->first();
        $stock_wallet = StockWallet::where('id', '=', $user->stock_wallet_id)->first();
        $fund = FundRequest::where('user_id',$user->id)->sum('money');
        $funds = FundRequest::where('user_id',$user->id)
                ->where('type','出金')->get();
        if($funds){
            $fund_amount = $funds->sum('money'); 
        } 
        $buyingfee = Setting::latest()->first()->cost_bull_max;

        if(($money_wallet->after_amount + $money_wallet->before_amount)>($stock_wallet->after_amount+$stock_wallet->before_amount)){
            $available_money = number_format( $money_wallet->after_amount - $fund_amount, 2);
        }else{
            $available_money = number_format( $money_wallet->after_amount - 10*$fund_amount, 2);
        }     
        $res = array(
            'status'=>'success',
            'available_money' => $available_money,
            'buy_fee' => $buyingfee*100
        );
        return json_encode($res);
       
    }

    public function buystock(Request $request)
    {
        ///////////////////////////////////////////////////////////////////////////     
        
       ///////////////////////open_start_time/////////////////////////////////////
       $am_start_time = Setting::latest()->first()->open_AM_Start;
       $am_end_time = Setting::latest()->first()->open_AM_End;
       $pm_start_time = Setting::latest()->first()->open_PM_Start;
       $pm_end_time = Setting::latest()->first()->open_PM_End;
       $now = date_create("now",timezone_open("Asia/Hong_Kong"));
        $am_start = date_create($am_start_time,timezone_open("Asia/Hong_Kong"));
        $am_end =  date_create($am_end_time,timezone_open("Asia/Hong_Kong"));
        $pm_start = date_create($pm_start_time,timezone_open("Asia/Hong_Kong"));
        $pm_end = date_create($pm_end_time,timezone_open("Asia/Hong_Kong"));
        $dayOfTheWeek = \Carbon\Carbon::now()->dayOfWeek;
        if ((( $am_start >  $now) ||  ( $am_end <  $now )) && (( $pm_start >  $now) ||  ( $pm_end <  $now ) || (  $dayOfTheWeek =='0') || ( $dayOfTheWeek=='6')))
        {    
            $error = array('status' => 'error', 'content' => '休市时间');
           
            return json_encode($error);
        }
       
        //////////////////////////////////////////////////////////////////////
        ///////////////////rise and fall///////////////////////////////////

        $stockcode = $_POST['code'];
        $realdata = $this->getstockPrice($stockcode);            
        $cur_price_real =  $realdata ;
        $buy_sd = Setting::latest()->first()->buy_sd;
        $st_buy_sd = Setting::latest()->first()->st_buy_sd;
        //var_dump($cur_price_real);exit();
        $price_rise = $cur_price_real[4]/$cur_price_real[5] - 1;
        if(substr($stockcode,0,2)!="st"){
            if(($price_rise >$buy_sd)||($price_rise < -$buy_sd)){

                $error = array('status' => 'error', 'content' => '你不能购买涨跌波动的股票。');
           
                 return json_encode($error);
           
            }
        }elseif(substr($stockcode,0,2)=="st"){
            if(($price_rise >$st_buy_sd)||($price_rise < -$st_buy_sd)){
                
                $error = array('status' => 'error', 'content' => '你不能购买涨跌波动的股票。');
           
                return json_encode($error);
          
            }
        }
        //////////////////////////////////////////////////////////////////////////////////////
        if($request->ajax()) {
            $data = $request->all();
        }
       // dd(json_decode($data));  
      
        $user_id = auth('api')->user()->id;
        $user = User::where('id','=', $user_id)->first();
        ////////////////////////////////// low money warning/////////////////////////
        $baocang_precent = Setting::latest()->first()->baocang_precent;
        $cost_exchange_rate = Setting::latest()->first()->cost_exchange_rate;      
        $after_amount = MoneyWallet::where('id','=',$user->money_wallet_id)->first()->after_amount;
        $before_amount = MoneyWallet::where('id','=',$user->money_wallet_id)->first()->before_amount;
        $stock_amount = StockWallet::where('id',$user->stock_wallet_id)->first()->after_amount;
        $stock_before_amount = StockWallet::where('id',$user->stock_wallet_id)->first()->after_amount;
        //var_dump(($after_amount + $before_amount - $stock_amount));exit();
        $rate_money = ($after_amount + $before_amount - $stock_amount)/$stock_amount*($cost_exchange_rate-1);
        if($rate_money<(1-$baocang_precent*0.01)){
            $error = array('status'=> 'error','content'=>'如果您不存款，则无法进行交易。');
            return json_encode($error);
        }
        $funds = FundRequest::where('user_id',$user->id)
                ->where('type','出金')->get();
        if($funds){
                $fund_amount = $funds->sum('money');           
        } 
       /////////////////////////////////// 
       // 
        $stockname = $_POST['cn_name'];
        $stocktype = StockType::firstOrCreate(array('code' => $stockcode, 'cn_name' => $stockname ));
        $stocktype_id = $stocktype->id; 
        $amount = $_POST['buy_num'];
        $cost = $_POST['buys_price'];
        $method = $_POST['buy_type'];              
        $fee = Setting::latest()->first()->cost_bull_max;        
        $buy_amount = $amount * $cost*100;
       
        ////////////////
        if(($after_amount+$before_amount)<($stock_amount+$stock_before_amount)){
            $fund_amount_over = $fund_amount*10;
        }else{
            $fund_amount_over = $fund_amount;
        }
        if($after_amount - $fund_amount_over< $buy_amount ){            
            $error = array('status'=> 'error','content'=>'没有足够的钱购买大量的股票。');
            return json_encode($error);
        }
       $res = MoneyWallet::where('id','=', $user->money_wallet_id)->update(array('after_amount' => $after_amount - $buy_amount - $buy_amount * $fee * 0.1));
       $res1 = MoneyWallet::where('id','=',$user->money_wallet_id)->update(array('before_amount' => $before_amount + $buy_amount));
       BuyHistory::create([
            'user_id'   => $user_id,
            'stock_type_id' => $stocktype_id,
            'amount'    => $amount,
            'cost'      => $cost,
            'method'    => $method,
            'before_amount' => $after_amount,
            'fee'       =>$fee
        ]);        

        $success = array('status'=>'success','content'=>'下单成功');
        return json_encode($success);
    }

    public function getgain($buyhistoryid, $cur_price, $cur_num){
        $buyhistory = BuyHistory::where('id','=', $buyhistoryid)->first();

        ////////////////  trading slip price  &  dc5,dc6,dc7,dc8,dc9 ///////////////////
         

        $user_id = auth('api')->user()->id;
        $user = User::where('id','=', $user_id)->first();
        $stocktype_id = $buyhistory->stockType->id;
        //var_dump($stocktype_id);exit();      
        $amount = $cur_num ;
        $cost = $buyhistory->cost;
        $method = $buyhistory->method;      
        $after_amount = MoneyWallet::where('id','=',$user->money_wallet_id)->first()->after_amount;
        $before_amount = MoneyWallet::where('id','=',$user->money_wallet_id)->first()->before_amount;
        $save_date = $buyhistory->created_at;
        $save_fee = Setting::latest()->first()->cost_save_max;
        $state_fee =Setting::latest()->first()->cost_state_max;
        $diff  	= date_diff( date_create($save_date) , date_create());
        /////////////////////  sel_max_time  //////////////////////
        //var_dump($diff->i);exit();
        $sel_max_time = Setting::latest()->first()->sel_max_time;
        if($sel_max_time > $diff->i){
            $sell_fee =  Setting::latest()->first()->cost_sell_limit; 
        }else{
            $sell_fee = Setting::latest()->first()->cost_sell_max;  
        }      
        $buy_fee = Setting::latest()->first()->cost_bull_max;        
       
        if ($diff->d == 0 | $diff->h >8){
            $saveday=1;
        }else{
            $saveday = $diff->d;
        }
       //var_dump($cur_price);exit();
       if ($method==1){
            $gain = $cur_price*$amount*100 - $cost*$amount*100 - $cost*$amount*100*($buy_fee   + $saveday * $save_fee);
       }else{
            $gain = $cost*$amount*100 - $cur_price*$amount*100  - $cost*$amount*100*($buy_fee  + $saveday * $save_fee);
       }
       return $gain;
    }

    public function waptrade(){
        $user_id = auth('api')->user()->id;
        $buyhistories = BuyHistory::where('user_id', '=', $user_id)->get();
       // var_dump($buyhistories);exit();
        if (count($buyhistories)){
            $save_date = BuyHistory::where('user_id','=',$user_id)->first()->created_at;
            $diff  	= date_diff( date_create($save_date) , date_create());
            if ($diff->d == 0 | $diff->h >8){
                $saveday=1;
            }else{
                $saveday = $diff->d;
            }

        }   
        $setting = Setting::latest()->first();           
        $temp_array = array();
        $total_gain=0;
        $total_cost=0;
        foreach($buyhistories as $buyhistory){
            $stockcode = $buyhistory->stockType->code;
            $realdata = $this->getstockPrice($stockcode);            
            $cur_price_real = $realdata; 

            $gain = $this->getgain($buyhistory->id, $cur_price_real[3], $buyhistory->amount);
            $cost = $buyhistory->cost * $buyhistory->amount*100;            

            $res1 = array(
                'id' => $buyhistory->id,
                'method' => $buyhistory->method,
                'gain' => $gain,
                'cost' => $cost,
                'cur_price' => $cur_price_real[3]
            );
            $total_gain += $gain;
            $total_cost += $cost;          
            array_push($temp_array,$res1);
        }
        $res = array(
            'status'=>'success',
            'buy_fee' => $setting->cost_bull_max*100,
            'sell_fee' => $setting->cost_sell_max*100,
            'save_fee' => $setting->cost_save_max*100,
            'total_gain' => $total_gain,
            'total_cost' => $total_cost + $total_gain
        );
        $res["buy_history"] = $temp_array;

        return json_encode($res);
    }

    public function sale_buy(){
        ///////////////////////////////// open close time//////////////////
        $am_start_time = Setting::latest()->first()->open_AM_Start;
        $am_end_time = Setting::latest()->first()->open_AM_End;
        $pm_start_time = Setting::latest()->first()->open_PM_Start;
        $pm_end_time = Setting::latest()->first()->open_PM_End;
        $now = date_create("now",timezone_open("Asia/Hong_Kong"));
        $am_start = date_create($am_start_time,timezone_open("Asia/Hong_Kong"));
        $am_end =  date_create($am_end_time,timezone_open("Asia/Hong_Kong"));
        $pm_start = date_create($pm_start_time,timezone_open("Asia/Hong_Kong"));
        $pm_end = date_create($pm_end_time,timezone_open("Asia/Hong_Kong"));
        $dayOfTheWeek = \Carbon\Carbon::now()->dayOfWeek;
        if ((( $am_start >  $now) ||  ( $am_end <  $now )) && (( $pm_start >  $now) ||  ( $pm_end <  $now ) || (  $dayOfTheWeek =='0') || ( $dayOfTheWeek=='6')))
        {    
            $error = array('status' => 'error', 'content' => '休市时间');           
            return json_encode($error);
        }
        
        /////////////////////////////////////
        
        $historyid=$_GET['id'];        
        $buyhistory = BuyHistory::where('id','=', $historyid)->first();

        $stockcode = $buyhistory->stockType->code;
        $realdata = $this->getstockPrice($stockcode);            
        $cur_price_real =  $realdata; 

        $res=array(
            'status'=>'success',
            'cn_name' =>  $buyhistory->stockType->cn_name,
            'buy_code' => $buyhistory->stockType->code,
            'created_at' => $buyhistory->created_at,
            'buy_amount' => $buyhistory->amount,
            'buy_price' => $buyhistory->cost,
            'cur_price' => $cur_price_real[3]
        );
        return json_encode($res);
    }

    public function sell_act(){


        $buyhistoryid=$_POST['id'];
        $cur_price = $_POST['cur_price'];
        $cur_num = $_POST['num'];
        // var_dump($cur_price);exit();
        if ($cur_price==''){ 
            $error = array('status' => 'error', 'content' => '当前操作无法执行，请立即重试');           
            return json_encode($error);
        }
        $this->sell($buyhistoryid, $cur_price, $cur_num);        
        $error = array('status' => 'success', 'content' => '销售成功');           
        return json_encode($error);
    }

    public function sell($buyhistoryid, $cur_price, $cur_num ){     
       

        $buyhistory = BuyHistory::where('id','=', $buyhistoryid)->first();

        ////////////////  trading slip price  &  dc5,dc6,dc7,dc8,dc9 ///////////////////
        $stockcode = $buyhistory->stockType->code;
        $realdata = $this->getstockPrice($stockcode);            
        $cur_price_real = $realdata ;   

        $slip_price =$cur_price_real[3] / $cur_price - 1;
        $slip_up_float = Setting::latest()->first()->up_float;
        $slip_down_float = Setting::latest()->first()->down_float;
        $slip_dc5 = Setting::latest()->first()->dc5;
        $slip_dc6 = Setting::latest()->first()->dc6;
        $slip_dc7 = Setting::latest()->first()->dc7;
        $slip_dc8 = Setting::latest()->first()->dc8;
        $slip_dc9 = Setting::latest()->first()->dc9;
        if ($slip_dc5 > 0){
            $slip_up_float=0.005;
            $slip_down_float=0.005;
        }elseif($slip_dc6 > 0){
            $slip_up_float=0.006;
            $slip_down_float=0.006;
        }elseif($slip_dc7 > 0){
            $slip_up_float=0.007;
            $slip_down_float=0.007;
        }elseif($slip_dc8 > 0){
            $slip_up_float=0.008;
            $slip_down_float=0.008;
        }elseif($slip_dc9 > 0){
            $slip_up_float=0.009;
            $slip_down_float=0.009;
        }
        
        if ($slip_price > $slip_up_float){
           
            $error = array('status' => 'error', 'content' => '目前的价格高于待售价格。');           
            return json_encode($error);
        }elseif($slip_price < - $slip_down_float){
            
            $error = array('status' => 'error', 'content' => '目前的价格低于待售价格。');           
            return json_encode($error);
        }

        $user_id = auth('api')->user()->id;
        $user = User::where('id','=', $user_id)->first();
        $stocktype_id = $buyhistory->stockType->id;
        //var_dump($stocktype_id);exit();
      
        $amount = $cur_num ;
        $cost = $buyhistory->cost;
        $method = $buyhistory->method;      
        $after_amount = MoneyWallet::where('id','=',$user->money_wallet_id)->first()->after_amount;
        $before_amount = MoneyWallet::where('id','=',$user->money_wallet_id)->first()->before_amount;
        $save_date = $buyhistory->created_at;
        $save_fee = Setting::latest()->first()->cost_save_max;
        $state_fee =Setting::latest()->first()->cost_state_max;
        $diff  	= date_diff( date_create($save_date) , date_create());
        /////////////////////  sel_max_time  //////////////////////
        //var_dump($diff->i);exit();
        $sel_max_time = Setting::latest()->first()->sel_max_time;
        if($sel_max_time > $diff->i){
            $sell_fee =  Setting::latest()->first()->cost_sell_limit; 
        }else{
            $sell_fee = Setting::latest()->first()->cost_sell_max;  
        }      
        $buy_fee = Setting::latest()->first()->cost_bull_max;        
       
        if ($diff->d == 0 | $diff->h >8){
            $saveday=1;
        }else{
            $saveday = $diff->d;
        }
       //var_dump($cur_price);exit();
       if ($method==1){
            $gain = $cur_price*$amount*100 - $cost*$amount*100 - $cost*$amount*100*($buy_fee  + $sell_fee + $state_fee + $saveday * $save_fee);
       }else{
            $gain = $cost*$amount*100 - $cur_price*$amount*100  - $cost*$amount*100*($buy_fee  + $sell_fee + $state_fee + $saveday * $save_fee);
       }
       //var_dump($gain);exit();
        $res = MoneyWallet::where('id','=', $user->money_wallet_id)->update(array('before_amount' => $before_amount - $cost*$amount*100 , 'after_amount' => $after_amount + $cost*$amount*100 + $gain));
        $amount_org = $buyhistory->amount;
        $amount_cur = $amount_org - $amount;
        if ($amount_cur == '0'){
            BuyHistory::where('id',$buyhistoryid)->delete();
        }else{
            BuyHistory::where('id',$buyhistoryid)->update(['amount' => $amount_cur]);
        }
       // var_dump($cost);exit();
        $res = SellHistory::create([
            'user_id'   => $user_id,
            'stock_type_id' => $stocktype_id,
            'buy_cost' => $cost,
            'buy_fee' => $buy_fee ,
            'sell_fee' => $sell_fee,
            'state_fee' => $state_fee,
            'buy_time' => $save_date,
            'amount'    => $amount,
            'sell_cost'  => $cur_price,
            'method'    => $method,
            'before_amount' => $after_amount,
            'save_fee' => $save_fee,
            'fee'       => $gain
        ]);
       // var_dump($res['id']);exit();
       
    }

    public function wapmingxi(){
        $user_id = auth('api')->user()->id;
        $user = User::where('id','=', $user_id)->first();
        $sellhistories = SellHistory::where('user_id', '=', $user_id)->get();
        $total_gain = $sellhistories -> sum('fee'); 
        $money_wallet = MoneyWallet::where('id', '=', $user->money_wallet_id)->first();
        $stock_wallet = StockWallet::where('id', '=', $user->stock_wallet_id)->first();   
        $setting = Setting::latest()->first(); 
        $funds = FundRequest::where('user_id',$user->id)
                ->where('type','出金')->get();
        if($funds){
            $fund_amount = $funds->sum('money'); 
        }
        if(($money_wallet->after_amount + $money_wallet->before_amount)>($stock_wallet->after_amount+$stock_wallet->before_amount)) {     
            $available_money = number_format( $money_wallet->after_amount - $fund_amount, 2) ;
        }else{
            $available_money = number_format( $money_wallet->after_amount - 10*$fund_amount, 2) ;
        } 
        $temp_array = array();
        foreach($sellhistories as $sellhistory){
            $res1= array(             
                'id'=>$sellhistory->id,
                'cn_name'=>$sellhistory->stockType->cn_name,
                'created_at'=>$sellhistory->created_at,
                'method'=> $sellhistory->method,
                'sell_cost'=>$sellhistory->sell_cost,
                'sell_amount'=>$sellhistory->amount,
                'gain'=>number_format($sellhistory->fee, 2)
            );
            array_push($temp_array,$res1);
        }
        $res= array(
            'status'=>'success',
            'buy_fee'=>$setting->cost_bull_max * 100,
            'sell_fee'=> $setting->cost_sell_max * 100 ,
            'save_fee'=> $setting->cost_save_max * 100,
            'available_money' =>$available_money,
            'total_gain' => $total_gain
        );  
        $res["sell_history"]=$temp_array;
        return json_encode($res);
    }
    public function message_index(){
        $users = User::where('id', '1')->first();
        $res = array();
        $res["status"]='success';
        $res["user_name"]=$users->name;
        return json_encode($res);
    }
    public function message_store(){
        $input = Input::all();
        $thread = Thread::create([
            'subject' => $input['subject'],
        ]);
        // Message
        Message::create([
            'thread_id' => $thread->id,
            'user_id' =>auth('api')->user()->id,
            'body' => $input['message'],
        ]);
        // Sender
        Participant::create([
            'thread_id' => $thread->id,
            'user_id' =>auth('api')->user()->id,
            'last_read' => new Carbon,
        ]);
        // Recipients
        if (Input::has('recipients')) {
            $thread->addParticipant($input['recipients']);
        }
        $res = array( 'status'=>'success', 'content'=>'消息已创建');
        return json_encode($res);
    }
}
