<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\DepositHistory;
use App\MoneyWallet;
use App\StockWallet;
use App\User;
use App\Setting;
use App\FundRequest;
use App\WithdrawHistory;
use App\SellHistory;
use App\BuyHistory;
use App\News;
use Hash;

class WebController extends Controller
{
    //
    public function index(){
        $user = Auth::user();
        $money_wallet = MoneyWallet::where('id', $user->money_wallet_id)->first();
        $stock_wallet = StockWallet::where('id', $user->stock_wallet_id)->first();
        $funds = FundRequest::where('user_id',$user->id)
                            ->where('type','出金')->get();
        if($funds){
            $fund_amount = $funds->sum('money');           
        }  
        $new_latest = News::latest()->first();
        return view('web.index')->with(compact('user','money_wallet','stock_wallet', 'fund_amount', 'new_latest'));
    }
    public function operate(){
        $user = Auth::user();
        $money_wallet = MoneyWallet::where('id', $user->money_wallet_id)->first();
        $stock_wallet = StockWallet::where('id', $user->stock_wallet_id)->first();
        $funds = FundRequest::where('user_id',$user->id)
                ->where('type','出金')->get();
        if($funds){
        $fund_amount = $funds->sum('money');           
        }  
      
        $new_latest = News::latest()->first();
        return view('web.operate')->with(compact('user','money_wallet','stock_wallet','fund_amount', 'new_latest'));
        
    }
    public function order(){
        $user = Auth::user();
        $money_wallet = MoneyWallet::where('id', $user->money_wallet_id)->first();
        $stock_wallet = StockWallet::where('id', $user->stock_wallet_id)->first();
        $funds = FundRequest::where('user_id',$user->id)
                ->where('type','出金')->get();
        if($funds){
        $fund_amount = $funds->sum('money');           
        }  
      
        $new_latest = News::latest()->first();
        return view('web.order')->with(compact('user','money_wallet','stock_wallet','fund_amount', 'new_latest'));
        
    }

    public function getstock(){
        // $this->buyhistory_init();
         $stockcode = $_GET['stockcode']; 
        // var_dump($stockcode);exit();
         return $stockdata= $this->getstockPrice($stockcode);
     }
     
    public function getstockPrice($stockcode){
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
        //var_dump($data);exit();
        curl_close($ch);        
        $realdata = mb_substr($data, 21, strlen($data)-24);
        $realdata_arr = explode (",", $realdata);
        $utf8Str = mb_convert_encoding($realdata , 'UTF-8' , 'GBK');
        //$realdata = utf8_decode($realdata);
        //var_dump($utf8Str);exit();
        return $utf8Str;

    }

    public function stock_detail(){
        $user = Auth::user();
        $money_wallet = MoneyWallet::where('id', $user->money_wallet_id)->first();
        $stock_wallet = StockWallet::where('id', $user->stock_wallet_id)->first();
        $funds = FundRequest::where('user_id',$user->id)
                ->where('type','出金')->get();
        if($funds){
        $fund_amount = $funds->sum('money');           
        }  
        $new_latest = News::latest()->first();
        return view('web.stock_detail')->with(compact('user','money_wallet','stock_wallet','fund_amount', 'new_latest'));
        
    }

    public function atm(){
        $user = Auth::user();  
        $setting = Setting::latest()->first();
        $money_wallet = MoneyWallet::where('id', $user->money_wallet_id)->first();
        $stock_wallet = StockWallet::where('id', $user->stock_wallet_id)->first();
        $new_latest = News::latest()->first();
        $funds = FundRequest::where('user_id',$user->id)
                            ->where('type','出金')->get();
        if($funds){
            $fund_amount = $funds->sum('money');           
        }        
        return view('web.atm')->with(compact('user','setting','money_wallet','stock_wallet', 'new_latest','fund_amount'));
    }
    public function add_atm(){
        $user_id = Auth::user()->id;
        $user = User::where('id','=', $user_id)->first();
        $money_wallet = MoneyWallet::where('id', $user->money_wallet_id)->first();
        $stock_wallet = StockWallet::where('id', $user->stock_wallet_id)->first();
        $funds = FundRequest::where('user_id',$user->id)
                            ->where('type','出金')->get();
        if($funds){
            $fund_amount = $funds->sum('money');           
        }   
        if($_POST['money'] > $money_wallet->after_amount -$stock_wallet->after_amount -$fund_amount){
            echo '<script> alert("不能出金。");</script>' ;
            echo "<script>location.href = '/web/atm'</script>";
        }
        $atmpwd = $_POST['atmpwd'];
        if($atmpwd == $user->atmpwd){
            $res = FundRequest::create([
                'user_id' => $user_id,
                'type' => '出金',
                'money' => $_POST['money'],
                'bank' => $_POST['bankname']
            ]);
            echo '<script> alert("成功.");</script>' ;
            echo "<script>location.href = '/web/atm'</script>";
        }else{
            echo '<script> alert("密码不匹配.");</script>' ;
            echo "<script>location.href = '/web/atm'</script>";
        }
       
    }
    public function payment(){
        $user = Auth::user();
        $money_wallet = MoneyWallet::where('id', $user->money_wallet_id)->first();
        $stock_wallet = StockWallet::where('id', $user->stock_wallet_id)->first();
        $funds = FundRequest::where('user_id',$user->id)
                            ->where('type','出金')->get();
        if($funds){
            $fund_amount = $funds->sum('money');           
        } 
        $new_latest = News::latest()->first();
        return view('web.payment')->with(compact('user','money_wallet','stock_wallet', 'fund_amount','new_latest'));
     
    }

    public function payment_log(){
        $user_id= Auth::user()->id;
        $user = Auth::user();
        $money_wallet = MoneyWallet::where('id', $user->money_wallet_id)->first();
        $stock_wallet = StockWallet::where('id', $user->stock_wallet_id)->first();
        $deposite_histories = DepositHistory::where('user_id',$user_id)->get();
        $funds = FundRequest::where('user_id',$user->id)
                            ->where('type','出金')->get();
        if($funds){
            $fund_amount = $funds->sum('money');           
        } 
        $new_latest = News::latest()->first();
        return view('web.payment_log')->with(compact('user','money_wallet','stock_wallet','deposite_histories', 'fund_amount','new_latest'));
    }    
    public function atm_log(){
        $user_id= Auth::user()->id;
        $user = Auth::user();
        $money_wallet = MoneyWallet::where('id', $user->money_wallet_id)->first();
        $stock_wallet = StockWallet::where('id', $user->stock_wallet_id)->first();
        $withdraw_histories = WithdrawHistory::where('user_id',$user_id)->get();
        $funds = FundRequest::where('user_id',$user->id)
                            ->where('type','出金')->get();
        if($funds){
            $fund_amount = $funds->sum('money');           
        } 
        $new_latest = News::latest()->first();
        return view('web.atm_log')->with(compact('user','money_wallet','stock_wallet','withdraw_histories','fund_amount', 'new_latest'));
    }
    public function pay_page(){
        $user_id = Auth::user()->id;
        $user = User::where('id','=', $user_id)->first();        
        $money_wallet = MoneyWallet::where('id', $user->money_wallet_id)->first();
        $stock_wallet = StockWallet::where('id', $user->stock_wallet_id)->first();
        $money = $_POST['money'];
        $res = FundRequest::create([
            'user_id' => $user_id,
            'type' => '入金',
            'money' => $money,
            'bank' => 'our'
        ]);
        $funds = FundRequest::where('user_id',$user->id)
                            ->where('type','出金')->get();
        if($funds){
            $fund_amount = $funds->sum('money');           
        } 
        $new_latest = News::latest()->first();
        return view('web.pay_page')->with(compact('user','money_wallet','stock_wallet','money','fund_amount', 'new_latest'));
    }
    // public function selforder(){
    //     return view('home.index.web.selforder');
    // }
    public function deal(){
        $user = Auth::user();
        $setting = Setting::latest()->first();
        $money_wallet = MoneyWallet::where('id', $user->money_wallet_id)->first();
        $stock_wallet = StockWallet::where('id',$user->stock_wallet_id)->first();
        $sell_histories = SellHistory::where('user_id', $user->id)->get();
        $buy_histories = BuyHistory::where('user_id', $user->id)->get();
        $funds = FundRequest::where('user_id',$user->id)
                            ->where('type','出金')->get();
        if($funds){
            $fund_amount = $funds->sum('money');           
        } 
        $new_latest = News::latest()->first();
        return view('web.deal')->with(compact('user', 'setting', 'money_wallet', 'stock_wallet', 'sell_histories', 'buy_histories', 'fund_amount','new_latest'));
    }
    public function atmpwd(){
        $user = Auth::user();
        $money_wallet = MoneyWallet::where('id', $user->money_wallet_id)->first();
        $stock_wallet = StockWallet::where('id',$user->stock_wallet_id)->first();
        $funds = FundRequest::where('user_id',$user->id)
                            ->where('type','出金')->get();
        if($funds){
            $fund_amount = $funds->sum('money');           
        } 
        $new_latest = News::latest()->first();
        return view('web.atmpwd')->with(compact('user','money_wallet','stock_wallet','fund_amount', 'new_latest'));
    }
    public function save_atmpwd(){
        $user = Auth::user();
        $atmpwd = $_POST['atmpwd'];
        $oldpwd = $_POST['oldpwd'];
        if($oldpwd != $user->atmpwd ){
            echo '<script> alert("旧密码不匹配.");</script>' ;
            echo "<script>location.href = '/web/atmpwd'</script>";
        }else{
            $res = User::where('id',$user->id)->update(['atmpwd'=>$atmpwd]);
            echo '<script> alert("密码修改成功.");</script>' ;
            echo "<script>location.href = '/web/atmpwd'</script>";
        }
       
    }
    public function pwd(){
        $user = Auth::user();
        $money_wallet = MoneyWallet::where('id', $user->money_wallet_id)->first();
        $stock_wallet = StockWallet::where('id',$user->stock_wallet_id)->first();
        $funds = FundRequest::where('user_id',$user->id)
                            ->where('type','出金')->get();
        if($funds){
            $fund_amount = $funds->sum('money');           
        } 
        $new_latest = News::latest()->first();
        return view('web.pwd')->with(compact('user','money_wallet','stock_wallet','fund_amount', 'new_latest'));
    }
    public function rules(){
        $user = Auth::user();
        $money_wallet = MoneyWallet::where('id', $user->money_wallet_id)->first();
        $stock_wallet = StockWallet::where('id',$user->stock_wallet_id)->first();
        $funds = FundRequest::where('user_id',$user->id)
                            ->where('type','出金')->get();
        if($funds){
            $fund_amount = $funds->sum('money');           
        } 
        $new_latest = News::latest()->first();
        return view('web.rules')->with(compact('user','money_wallet','stock_wallet', 'fund_amount','new_latest'));
     
    }
    public function news(){
        $user = Auth::user();
        $money_wallet = MoneyWallet::where('id', $user->money_wallet_id)->first();
        $stock_wallet = StockWallet::where('id',$user->id)->first();
        $funds = FundRequest::where('user_id',$user->id)
                            ->where('type','出金')->get();
        if($funds){
            $fund_amount = $funds->sum('money');           
        } 
        $news = News::get();
        $new_latest = News::latest()->first();
        return view('web.news')->with(compact('user','money_wallet','stock_wallet','news', 'fund_amount','new_latest'));
    
    }
    public function save_pwd(){
        $user = Auth::user();
        $pwd = $_POST['password'];
        $oldpwd = $_POST['oldpwd'];
        if (Hash::check($oldpwd, $user->password)) {
            // The passwords match...
            $res = User::where('id',$user->id)->update(['password'=>Hash::make($pwd)]);
            echo '<script> alert("密码修改成功.");</script>' ;
            echo "<script>location.href = '/web/pwd'</script>";
        }else{
            echo '<script> alert("旧密码不匹配.");</script>' ;
            echo "<script>location.href = '/web/pwd'</script>";    
        }
       
    }
    public function trade_detail(){
        $user = Auth::user();
        $setting = Setting::latest()->first();
        $buy_histories = BuyHistory::where('user_id', $user->id)->get();       
        $money_wallet = MoneyWallet::where('id', $user->money_wallet_id)->first();
        $stock_wallet = StockWallet::where('id',$user->stock_wallet_id)->first();
        $funds = FundRequest::where('user_id',$user->id)
                            ->where('type','出金')->get();
        if($funds){
            $fund_amount = $funds->sum('money');           
        } 
        $new_latest = News::latest()->first();
        return view('web.trade_detail')->with(compact('user','money_wallet','stock_wallet','buy_histories', 'setting', 'fund_amount','new_latest'));
       
    }
    public function cancash(){
        $user = Auth::user();  
        $setting = Setting::latest()->first();
        $money_wallet = MoneyWallet::where('id', $user->money_wallet_id)->first();
        $stock_wallet = StockWallet::where('id', $user->stock_wallet_id)->first();
        $sell_histories = SellHistory::where('user_id', $user->id)->get();
        $buy_histories = BuyHistory::where('user_id', $user->id)->get();
        $funds = FundRequest::where('user_id',$user->id)
                            ->where('type','出金')->get();
        if($funds){
            $fund_amount = $funds->sum('money');           
        } 
        $new_latest = News::latest()->first();
        return view('web.cancash')->with(compact('user', 'setting', 'money_wallet', 'stock_wallet', 'buy_histories', 'sell_histories','fund_amount', 'new_latest'));
    }
    public function report_day(){
        //$day = $_GET['date'];
        $user = Auth::user();
        $setting = Setting::latest()->first();
        $money_wallet = MoneyWallet::where('id', $user->money_wallet_id)->first();
        $stock_wallet = StockWallet::where('id',$user->stock_wallet_id)->first();
        $sell_histories = SellHistory::where('user_id', $user->id)->get();
        $buy_histories = BuyHistory::where('user_id', $user->id)->get();
        $funds = FundRequest::where('user_id',$user->id)
                            ->where('type','出金')->get();
        if($funds){
            $fund_amount = $funds->sum('money');           
        } 
        $new_latest = News::latest()->first();
        //var_dump($sell_histories);exit();
        return view('web.report_day')->with(compact('user', 'setting', 'money_wallet', 'stock_wallet', 'sell_histories', 'buy_histories','fund_amount', 'new_latest'));
    }
    public function report_week(){
        //$day = $_GET['date'];
        $user = Auth::user();
        $setting = Setting::latest()->first();
        $money_wallet = MoneyWallet::where('id', $user->money_wallet_id)->first();
        $stock_wallet = StockWallet::where('id',$user->stock_wallet_id)->first();
        $start_day = \Carbon\Carbon::today()->startOfWeek();
        
        $buy_array = array();        
        $myobj = array();
       
        for($i=0 ; $i< 7 ; $i++){
            $amount = 0;
            $fee = 0;
            $rise = 0;
            $position = 0;
            $position_fee = 0;
            $sell_histories = SellHistory::whereDate( 'created_at', $start_day->copy()->addDay($i))
                            ->where('user_id', $user->id)->get();
            $buy_histories = BuyHistory::whereDate( 'created_at', $start_day->copy()->addDay($i))
                            ->where('user_id', $user->id)->get();
            if($buy_histories){
                foreach($buy_histories as $buy_history){
                    $position += $buy_history->amount * $buy_history->cost * 100;
                    $position_fee += $position * $buy_history->fee;
                }               
            }      
            if($sell_histories){
                //var_dump($sell_histories->sum('fee'));exit(); 
                foreach($sell_histories as $sell_history){
                    $amount += $sell_history->amount ;               
                    $fee +=  $sell_history->amount* $sell_history->cost * 100 * $sell_history->sell_fee ;              
                    $rise +=  $sell_history->fee;
                }

            } 
            $array = array('amount'=>$amount, 'position'=>$position, 'fee'=>$fee, 'position_fee'=>$position_fee, 'rise'=>$rise);
            array_push($myobj, $array); 
        }
       
        $data = $myobj;
        $funds = FundRequest::where('user_id',$user->id)
                            ->where('type','出金')->get();
        if($funds){
            $fund_amount = $funds->sum('money');           
        } 
        $new_latest = News::latest()->first();
        return view('web.report_week')->with(compact('user','money_wallet', 'stock_wallet', 'start_day', 'data', 'fund_amount','new_latest'));
    }
    public function user(){
        $user = Auth::user();
        
        $money_wallet = MoneyWallet::where('id',$user->money_wallet_id)->first();
        $stock_wallet = StockWallet::where('id',$user->stock_wallet_id)->first();
        $fund = FundRequest::where('user_id',$user->id)->sum('money');
        //var_dump($fund);exit();
        $setting = Setting::latest()->first();
        $funds = FundRequest::where('user_id',$user->id)
                            ->where('type','出金')->get();
        if($funds){
            $fund_amount = $funds->sum('money');           
        } 
        $new_latest = News::latest()->first();
        return view('web.user')->with(compact('user','money_wallet', 'stock_wallet','fund', 'setting', 'fund_amount','new_latest'));
    }
    public function stockdata(Request $request){
        $type = $_GET['type'];
        $page = $_GET['page'];
        $pagesize = $_GET['pagesize'];
        $stockcode = $_GET['stockcode'];
        $bkname = $_GET['bkname'];
        $stockcodes=array('000001','000002', '000003', '000004', '000005', '000006', '000007', '000008', '000009', '000010', '000011', '000012', '000013', '000014', '000015', '000016', '000017', '000018', '000019', '000020', '000021', '000022', '000023', '000024', '000025');
        $total_arr=array();        
        foreach($stockcodes as $index => $stockcode ){
            if(substr($stockcode,0,1)=='6'){
                $url = "http://hq.sinajs.cn/list=sh".$stockcode;
            }else{
                $url = "http://hq.sinajs.cn/list=sz".$stockcode;
            }       
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            
            $data = curl_exec($ch);
            //var_dump($data);exit();
            curl_close($ch);        
            $realdata = mb_substr($data, 21, strlen($data)-24);
            $realdata_arr = explode (",", $realdata);
            $utf8Str = mb_convert_encoding($realdata , 'UTF-8' , 'GBK');
            //$realdata = utf8_decode($realdata);
            //var_dump($utf8Str);exit();
            $stockdata = explode(",", $utf8Str); 
            $sub_arr=array('code' =>$stockcode, 'data'=>$stockdata);
            $count=array_push($total_arr,$sub_arr);
        }
        $stock_arr=array('total'=>1,'current'=>$count, 'list'=> $total_arr);
        //var_dump($stockdata[0]);exit();
       return json_encode($stock_arr);


    }

    public function buystock(Request $request){
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
            $error = array('error' => 1, 'content' => ' 休市时间');
            
            echo '<script> alert(" 休市时间");</script>' ;
            echo "<script>location.href = '/pc/wclient'</script>";
            return false;
        }

        //////////////////////////////////////////////////////////////////////
        ///////////////////rise and fall///////////////////////////////////
        $stockcode = $_POST['buy_code'];
        $realdata = $this->getstockPrice($stockcode);            
        $cur_price_real = explode (",", $realdata);
        $buy_sd = Setting::latest()->first()->buy_sd;
        $st_buy_sd = Setting::latest()->first()->st_buy_sd;
        //var_dump($cur_price_real);exit();
        $price_rise = $cur_price_real[4]/$cur_price_real[5] - 1;
        if(substr($stockcode,0,2)!="st"){
            if(($price_rise >$buy_sd)||($price_rise < -$buy_sd)){
                $error = array('error' => 1, 'content' => '你不能购买涨跌波动的股票。'); 
                echo '<script> alert("你不能购买涨跌波动的股票。");</script>' ;
                echo "<script>location.href = '/pc/wclient'</script>";
                return false;
            }
        }elseif(substr($stockcode,0,2)=="st"){
            if(($price_rise >$st_buy_sd)||($price_rise < -$st_buy_sd)){                
                $error = array('error' => 1, 'content' => '你不能购买涨跌波动的股票。');
                echo '<script> alert("你不能购买涨跌波动的股票。");</script>' ;
                echo "<script>location.href = '/pc/wclient'</script>";
                return false;
            }
        }
        //////////////////////////////////////////////////////////////////////////////////////

        if($request->ajax()) {
            $data = $request->all();
        }
        // dd(json_decode($data));  
        
        $userid = Auth::user()->id;
        $user = User::where('id','=', $userid)->first();
        ////////////////////////////////// low money warning/////////////////////////
        $baocang_precent = Setting::latest()->first()->baocang_precent;   
        $cost_exchange_rate = Setting::latest()->first()->cost_exchange_rate;   
        $after_amount = MoneyWallet::where('id','=',$user->money_wallet_id)->first()->after_amount;
        $before_amount = MoneyWallet::where('id','=',$user->money_wallet_id)->first()->before_amount;
        $stock_amount = StockWallet::where('id',$user->stock_wallet_id)->first()->after_amount;
        $stock_before_amount = StockWallet::where('id',$user->stock_wallet_id)->first()->before_amount;
        //var_dump(($after_amount + $before_amount - $stock_amount)/$stock_amount*9);exit();
        $rate_money = ($after_amount + $before_amount - $stock_amount)/$stock_amount*($cost_exchange_rate-1);
        if($rate_money<(1-$baocang_precent*0.01)){
            echo '<script> alert("如果您不存款，则无法进行交易。");</script>' ;
            echo "<script>location.href = '/pc/wclient'</script>";
            return false;
        }

        $funds = FundRequest::where('user_id',$user->id)
                            ->where('type','出金')->get();
        if($funds){
            $fund_amount = $funds->sum('money');           
        } 
        /////////////////////////////////// 
        $stockname = $_POST['buy_name'];
        $stocktype = StockType::firstOrCreate(array('code' => $stockcode, 'cn_name' => $stockname ));
        $stocktype_id = $stocktype->id; 
        $amount = $_POST['bull_num'];
        $cost = $_POST['buys_price'];
        $method = $_POST['buy_type']; 
        $fee = Setting::latest()->first()->cost_bull_max;
        
        $buy_amount = $amount * $cost*100;
        // var_dump($buy_amount);exit();
        ////////////////bull_money_over warning//////////////
        if(($after_amount+$before_amount)<($stock_amount+$stock_before_amount)){
            $fund_amount_over = $fund_amount*10;
        }else{
            $fund_amount_over = $fund_amount;
        }
        if($after_amount - $fund_amount_over< $buy_amount ){
            echo '<script> alert("没有足够的钱购买大量的股票。");</script>' ;
            echo "<script>location.href = '/pc/wclient'</script>";
            return false;
        }
        //////////////////////
        $res = MoneyWallet::where('id','=', $user->money_wallet_id)->update(array('after_amount' => $after_amount - $buy_amount - $buy_amount * $fee));
        $res1 = MoneyWallet::where('id','=', $user->money_wallet_id)->update(array('before_amount' => $before_amount + $buy_amount));
        BuyHistory::create([
            'user_id'   => $userid,
            'stock_type_id' => $stocktype_id,
            'amount'    => $amount,
            'cost'      => $cost,
            'method'    => $method,
            'before_amount' => $after_amount,
            'fee'       =>$fee
        ]); 
        echo '<script> alert("下单成功");</script>' ;
        echo "<script>location.href = '/pc/wclient'</script>";
        return false;
        //  return redirect('/pc/wclient');      
        
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
             $error = array('error' => 1, 'content' => ' 休市时间');
            
             echo '<script> alert(" 休市时间");</script>' ;
             echo "<script>location.href = '/pc/wclient'</script>";
             return false;
         }
        /////////////////////////////////////


       $historyid=$_GET['id'];
       //
       $buyhistory = BuyHistory::where('id','=', $historyid)->first();
       //var_dump($buyhistory);exit();
       return view('pc.sell')->with(compact('buyhistory')); 
   }
   public function sell_act(){


       $buyhistoryid=$_POST['id'];
       $cur_price = $_POST['cur_price'];
       $cur_num = $_POST['num'];
       // var_dump($cur_price);exit();
       $this->sell($buyhistoryid, $cur_price, $cur_num);
       return redirect('pc/wclient');

   }
   function sell($buyhistoryid, $cur_price, $cur_num ){      

        $buyhistory = BuyHistory::where('id','=', $buyhistoryid)->first();
      

        ////////////////  trading slip price  &  dc5,dc6,dc7,dc8,dc9 ///////////////////
        $stockcode = $buyhistory->stockType->code;
        
        $realdata = $this->getstockPrice($stockcode);            
        $cur_price_real = explode (",", $realdata);    
       //var_dump($cur_price_real);exit();

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
          // var_dump($cur_price_real);exit();
            return back()->with('error','目前的价格高于待售价格。');
        }elseif($slip_price < - $slip_down_float){
            return back()->with('error','目前的价格低于待售价格。');
        }

        $user_id = $buyhistory->user_id;
        $user = $buyhistory->user();
        $stocktype_id = $buyhistory->stockType->id;
        //var_dump($stocktype_id);exit();
      
        $amount = $cur_num;
        $cost = $buyhistory->cost;
        $method = $buyhistory->method;      
        $after_amount = MoneyWallet::where('id','=',$user->money_wallet_id)->first()->after_amount;
        $before_amount = MoneyWallet::where('id','=',$user->money_wallet_id)->first()->before_amount;
        $save_date = BuyHistory::where('user_id','=',$user_id)->first()->created_at;
        $save_fee = Setting::latest()->first()->cost_save_max;
        $state_fee = Setting::latest()->first()->cost_state_max;
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
       
       if ($method==1){
            $gain = $cur_price*$amount*100 - $cost*$amount*100 - $cost*$amount*100*($buy_fee + $sell_fee + $state_fee + $saveday* $save_fee);
       }else{
            $gain = $cost*$amount*100 - $cur_price*$amount*100  - $cost*$amount*100*($buy_fee + $sell_fee + $state_fee + $saveday* $save_fee);
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
       
       $res = SellHistory::create([
           'user_id'   => $user_id,
           'stock_type_id' => $stocktype_id,
           'buy_cost' => $cost,
           'buy_fee' => $buy_fee,
           'sell_fee' => $sell_fee ,
           'state_fee' => $state_fee,
           'buy_time' => $save_date,
           'amount'    => $amount,
           'sell_cost'  => $cur_price,
           'method'    => $method,
           'before_amount' => $after_amount,
           'save_fee' => $save_fee,
           'fee'       => $gain
       ]);
    }
}
