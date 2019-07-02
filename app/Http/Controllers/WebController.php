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
}
