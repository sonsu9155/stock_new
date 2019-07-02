
<!DOCTYPE html >
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>@yield('title')</title>
    <meta http-equiv="X-UA-Compatible" content="IE=7" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no"/>
    <link href="/css/style.css" rel="stylesheet" type="text/css" />
    <link href="/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="/js/jquery1.3.2.js"></script>
    <script type="text/javascript" src="/js/ymPrompt.js"></script>
    <script type="text/javascript" src="/js/me_function.js"></script> 
    <script type="text/javascript" src="/js/vue.js"></script>  
    <script>
        $(document).ready(function(){ 
            showTime();
            showDate();
        });
       function showTime(){
            var date = new Date();
            var h = date.getHours(); 
            var m = date.getMinutes();
            var s = date.getSeconds(); 
            var session = "AM";
            if(h == 0){
                h = 12;
            }
            if(h > 12){
                h = h - 12;
                session = "PM";
            }
            h = (h < 10) ? "0" + h : h;
            m = (m < 10) ? "0" + m : m;
            s = (s < 10) ? "0" + s : s;
            var time = h + ":" + m + ":" + s + " " + session;            
            document.getElementById("MyClockDisplay").innerText = time;
            document.getElementById("MyClockDisplay").textContent = time;
            setTimeout(showTime, 1000);
        }
        function showDate(){            
            var date = new Date();
            var days = ['星期日', '星期一', '星期二', '星期三', '星期四', '星期五', '星期六'];
            var curWeekDay = days[date.getDay()];
            document.getElementById("date").innerText = curWeekDay;
            document.getElementById("date").textContent = curWeekDay;
        }
    </script>
    @yield('script')
    <style>
        .user_ii{
           
            color:#000;
            padding:50px;
            line-height:30px;
            background-color: #cfd4d3;
           
        }      
        #clock {  
            font-family: 'Microsoft YaHei','Lantinghei SC','Open Sans',Arial,'Hiragino Sans GB','STHeiti','WenQuanYi Micro Hei','SimSun',sans-serif;  
            color: #ffffff;  
            text-align: center;  
            color: #daf6ff;  
            text-shadow: 0 0 20px #0aafe6, 0 0 20px rgba(10, 175, 230, 0);  
        }  
        #clock .time {  
            letter-spacing: 0.05em;  
            font-size: 25px;  
            padding: 5px 0; 
            margin: 0 0 0; 
        }  
        #clock .date {  
            letter-spacing: 0.1em;  
            font-size: 25px; 
            margin: 0 0 0; 
        }  
        #clock .text {  
            letter-spacing: 0.1em;  
            font-size: 12px;  
            padding: 20px 0 0;  
        }  
    
        #time_new{
            margin:0px auto;
            text-align:center;
            box-shadow:5px 5px 2px 2px #abcdef inset;
            border:none;
        }
        .nav_ico img{
            width:50px;
        }

        .nav_ico a{
            color:#fff;
            display:block;
            margin-left:30px;
        }

        .nav_ico a:hover{
            color:red;
        }
    </style>   
    @yield('css')
    </head>
    <body> 
    @include('layouts.web_top')
    <div class ="row" >
        <div class ="col-sm-2">
            <div class="user_ii" >
                用户：<strong><font color="#000">{{ $user->username }}</font></strong>
                &nbsp;
                <br>
                保证金: <br><span style="color:#000"><span id="a_money">{{  number_format($stock_wallet->before_amount - $fund_amount , 2) }}</span></span>元
               
                <br>
            </div>
            <div >
                <table border="0" cellpadding="0" cellspacing="0" class="main" style="width:100%;background-color: #cfd4d3;"> 
                    <tr> 
                        <td > 
                            <div class="leftmenu" style="width:100%"> 
                            <h5>转账记录</h5> 
                            <ul> 
                                <li><a href="/web/payment_log" target="_self">入金记录</a></li> 
                                <li><a href="/web/atm_log" target="_self">出金记录</a></li> 
                            </ul> 
                            <h5>交易信息</h5> 
                            <ul> 
                                <li><a href="/web/report_day" target="_self">每日报表</a></li> 
                                <li><a href="/web/report_week" target="_self">每周报表</a></li> 
                                <li><a href="/web/trade_detail" target="_self">交易明细</a></li> 
                                <li><a href="/web/cancash" target="_self">资金查询</a></li> 
                                <li style="display:none;"><a href="cancash.php" class="on" target="_self">我的下线佣金</a></li> 
                            </ul> 
                            <h5>我的系统</h5> 
                            <ul> 
                                <li><a href="/web/atmpwd" target="_self">资金密码</a></li> 
                                <li><a href="/web/pwd" target="_self">登录密码</a></li> 
                                <li><a href="/web/rules" target="_self">交易规则</a></li> 
                                <li><a href="/web/news" target="_self">系统公告</a></li>
                            </ul> 
                            </div>
                        </td> 
                    </tr> 
                </table> 
                <p>&nbsp;</p>
            </div>
        </div>
        <div class="col-sm-10">
            @yield('content')
        </div>
    </div>

</body>
</html>