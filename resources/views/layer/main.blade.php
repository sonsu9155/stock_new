
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset=utf-8>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="美股投资,期货投资,美股配资,原油投资,大宗商品,白银投资,贵金属,石油,黄金期货,港股配资,杠杆交易,现货">
    <meta name="description" content="大成国际资产，灵活投资">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="/css/huazhou.css" >
    <link rel="stylesheet" href="/css/animate.min.css">
    <link rel="shortcut icon" href="/resources/images/favicon1.ico" type="image/x-icon" />
    <link href="/css/video-js.css"  rel="stylesheet"> 
    @yield('css')  
</head>
<body>
    <!--nav star-->
    <div class="navBox">
        <div class="nav">
            <a href="{{ route('home') }}" ><img src="/images/logo.png" tppabs="/images/logo.png"  style="width: 158px;" alt="大成国际资产"></a>
            <ul class="linkBtn">
                <li><a href="{{ route('home') }}" @yield('nav1_active')>首页</a></li>
                <li><a href="{{ route('neirong') }}" @yield('nav2_active')>产品</a></li>
                <li><a href="{{ route('about') }}" @yield('nav3_active')>关于</a></li>
                <li><a href="{{ route('login') }}" @yield('nav4_active')>快速登录</a></li>
                <li><a href="{{ route('rule') }}" @yield('nav5_active')>交易规则</a></li>
            </ul>
        </div>
    </div>
    <!--nav end-->
    @yield('content')  
    <!--footer star-->
    <div class="footerBox">
        <div class="footer">
            <div class="footerLeft">
                <ul>
                    <li><img src="/images/1-24.png" alt=""></li>
                    <li style="text-align: left;line-height: 35px;"><span class="h3">投资建议</span></li>
                </ul>
            </div>
            <div class="footerRight">
                <ul>
                    <li><img src="/images/1-25.png" alt=""></li>
                    <li style="text-align: left;line-height: 35px;"><span class="h3">联系我们</span><br>官方投诉电话：00852-59856291<br></li>
                </ul>
            </div>
            <div class="clearfix"></div>
            <div style="margin: 20px 0;border-bottom: 1px solid #737373;" ></div>
            <div class="footerWords">
                证券价格可能有时会波动性很大。证券价格或涨或跌，甚至会变成毫无价值。买卖证券未必一定会赚取利润，可能会招致损失。证券价格或收益以及所产生的任何收入都可能因为很多因素发生改变。例如：市场风险、公司、部门和国家风险、货币汇率风险、经济以及政治风险，都会影响证券及证券发行。您的投资资本价值可能会大幅下滑，而没有投资收入。
                <span><br/>香港证监会认可的持牌法团（中央编号：AZT137）</span>    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;   金融监管机构FSA监督 &nbsp;监管号：655871
        </div>
    <!--footer end-->

    <!--右侧悬浮菜单-->
        <div class="slide" style="display: block;">
            <ul class="icon">
                <li class="up" title="上一页"></li>
                <li class="qq"></li>
                <li class="tel"></li>
                <li class="down" title="下一页"></li>
            </ul>
            <ul class="info">
                <li class="qq" style="display: none;">
                    <p> 在线沟通，请点我<a href="http://wpa.qq.com/msgrd?v=3&uin=&site=qq&menu=yes"  target="_blank">在线咨询</a> </p>
                </li>
                <li class="tel" style="display: none;">
                    <p> 咨询热线： <br> 00852-59856291  </p>
                </li>
            </ul>
        </div>
    </div>
    <div id="btn" class="index_cy"></div>
    
    <script src="/js/jquery-1.11.1.min.js"></script>
    <script src="/js/jquery.tersebanner.min.js"></script>
    <script type="text/javascript" src="/js/jquery.min.js"></script>
    <script type="text/javascript">
        $(function(){
            $('.slide .icon li').not('../.up,.down').mouseenter(function(){
                $('../.slide .info').addClass('hover');
                $('.slide .info li').hide();
                $('.slide .info li.'+$(this).attr('class')).show();//.slide .info li.qq
            });
            $('.slide').mouseleave(function(){
                $('../.slide .info').removeClass('hover');
            });
            
            $('#btn').click(function(){
                $('.slide').toggle();
                if($(this).hasClass('index_cy')){
                    $(this).removeClass('index_cy');
                    $(this).addClass('index_cy2');
                }else{
                    $(this).removeClass('index_cy2');
                    $(this).addClass('index_cy');
                }
            });   
            $(".linkBtn li").mouseover(function () {
                $(this).addClass("animated bounce");
            });
            $(".linkBtn li").mouseleave(function () {
                $(this).removeClass("animated bounce");
            });   
        });     
    </script>
    @yield('javascript')
</body>
</html>
