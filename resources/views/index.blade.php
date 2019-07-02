@extends('layouts.main')
@section('title')
    财智通
@endsection
@section('css')
    <style>
        body{
            position: relative;
            background: #EFF2F4;
            font: normal 13px "宋体" !important;
        }
        body,div,ul,li,p,a,img{
            padding: 0;
            margin: 0;
        }
        /*右侧悬浮菜单*/
        .slide{
            width: 50px;
            height: 250px;
            position: fixed;
            top: 50%;
            margin-top: -126px;
            background: #00496F;
            right: 0;
            border-radius: 5px 0 0 5px;
            z-index: 999;
        }
        .slide ul{
            list-style: none;
        }
        .slide .icon li{
            width: 49px;
            height: 50px;
            background: url("/images/icon.png") no-repeat;
        }
        .slide .icon .up{
            background-position:-330px -120px ;
        }
        .slide .icon li.qq{
            background-position:-385px -73px ;
        }
        .slide .icon li.tel{
            background-position:-385px -160px ;
        }
        .slide .icon li.wx{
            background-position:-385px -120px ;
        }
        .slide .icon li.down{
            background-position:-330px -160px ;
        }
        .slide .info{
            top: 50%;
            height: 147px;
            position: absolute;
            right: 100%;
            background: #00496F;
            width: 0px;
            overflow: hidden;
            margin-top: -73.5px;
            transition:0.5s;
            border-radius:4px 0 0 4px ;
        }
        .slide .info.hover{
            width: 145px;
            
        }
        .slide .info li{
            width: 145px;
            color: #CCCCCC;
            text-align: center;
        }
        .slide .info li p{
            font-size: 1.1em;
            line-height: 2em;
            padding: 15px;
            text-align: left;
        }
        .slide .info li.qq p a{
            display: block;
            margin-top: 12px;
            width: 100px;
            height: 32px;
            line-height: 32px;
            color: #00DFB9;
            font-size: 16px;   
            text-align: center;
            text-decoration: none;
            border: 1px solid #00DFB9;
            border-radius: 5px;
        }
        .slide .info li.qq p a:hover{
            color: #FFFFFF;
            border: none;
            background: #00E0DB;
        }
        .slide .info li div.img{
            height: 100%;
            background: #DEFFF9;
            margin: 15px;
        }
        .slide .info li div.img img{
            width: 100%;
            height: 100%;
        }
        /*控制菜单的按钮*/
        .index_cy{
            width: 30px;
            height: 30px;
            background: url("/images/index_cy.png");
            position: fixed;
            right: 0;
            top: 50%;
            margin-top: 140px;
            background-position: 62px 0;
            cursor: pointer;
        }
        .index_cy2{
            width: 30px;
            height: 30px;
            background: url("/images/index_cy.png");
            position: fixed;
            right: 0;
            top: 50%;
            margin-top: 140px;
            background-position: 30px 0;
            cursor: pointer;
        }
        
        /*自适应 当屏小于1050时隐藏*/
        @media screen and (max-width: 1050px) {
            .slide{
                display: none;
            }
            #btn{
                display: none;
            }
            
        }
        body{background-color: #191919}
        .m{ width: 740px; height: 400px; margin-left: auto; margin-right: auto; margin-top: 100px; }
        #pointer{
            animation-iteration-count: 1000;
        }
        #baba-top{
            animation-iteration-count: 1000;
        }
        .bannerBox-new{
            width: 100%;
            height: 506px;
            overflow: hidden;
            position: relative;
        }
        .bannerList{
            width: 1920px;
            height: 506px;
            position: absolute;
            left: 50%;
            margin-left: -960px;
        }
        .bannerBox-new img{
            width: 100%;
            height: 506px;
        }
        .bannerBox-new ul{
            top:0;
            left:0;
            width: 400%;
            height: 506px;
            position: absolute;
        }
        .bannerBox-new li{
            float: left;
            width: 25%;
            height: 506px;
        }
        .li1{
            background: url("/images/banner.png") center 0 no-repeat;
        }
        .li2{
            background: url("/images/banner-1.png") center 0 no-repeat;
        }
        .bannerBtn span{
            top:50%;
            color: #fff;
            width: 50px;
            cursor: pointer;
            height: 100px;
            margin-top: -50px;
            position: absolute;
            text-align: center;
            font:normal 40px/100px '宋体';
            background: rgba(0,0,0,.5);
        }
        .l{
            left:0;
        }
        .r{
            right: 0;
        }
    </style>
@endsection
@section('nav1_active')
        id = "navActive"
@endsection
@section('content')
    <!--banner star-->
    <div class="bannerBox">
        <div class="banner-list">
            <img src="/images/banner-1-1.png" class="banner-1">
        </div>
        <img src="/images/yige.png" class="oneTop animated zoomInRight">
        <p class="describe animated zoomInLeft">
            融资融券交易机制，多空双向操作，既可以买涨也可以买跌 <br>T+0交易，当天买卖，当天可以平仓交易
        </p>
    </div>
    <!--banner star-->
    <div class="youshiBox">
        <!--公告 star-->
        <div class="container">
            <div class="tipBox">
                <img src="/images/horn.png"  alt="">大成国际资产证券即将开通港股和港期交易，届时欢迎大家体验！
            </div>
        </div>
        <!--公告 end-->
        <div class="container" style="margin: 20px auto 70px auto">
            <div  class="advantageBox" style="margin-right: 149px;">
                <div class="advantageTitle">开户简单快捷</div>
                <ul class="advantage">
                    <li style="margin-right: 10px;"><img src="/images/1-1.png"  alt=""></li>
                    <li style="line-height: 25px">
                        只需一分钟 <br>即可打开全新投资之路 <br> 开启您从0到1的 <br>财富跨越
                    </li>
                </ul>
            </div>
            <div class="advantageBox" style="margin-right: 149px;">
                <div class="advantageTitle">资金三方监管</div>
                <ul class="advantage">
                    <li style="margin-right:0px;margin-left:-10px;"><img src="/images/1-2.png"   alt=""></li>
                    <li style="line-height: 25px">
                        五分钟快速收付 <br>支持多家银行 <br> 提供股票、期货、期权、 <br>ETF多品种交易
                    </li>
                </ul>
            </div>
            <div class="advantageBox">
                <div class="advantageTitle">7*24小时中文客服</div>
                <ul class="advantage">
                    <li style="margin-right: 10px;"><img src="/images/1-3.png" alt=""></li>
                    <li style="line-height: 25px">
                        投资无须困扰 <br>全天24小时，专属客服 <br> 全程陪伴，只为您 <br>提供更优质的服务
                    </li>
                </ul>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <!--优势 end-->
    <!--高杠杆 低费用 star-->
    <div class="clearfix"></div>
    <div class="heightLowBox" style="background-color:#ffffff;">
        <div class="heightLow">
            <div class="heightLowLeft">
                <img src="/images/1-4.png"  alt="">
                <p class="h1">高杠杆.低费用</p>
                <hr>
                <ul style="line-height: 60px">
                    <li>缺少资金.无须担忧</li>
                    <li>大成国际资产证券为您提供最高</li>
                    <li><span class="h1">10</span> 倍杠杆，手续费最低 <span class="h1">0.7%</span></li>
                </ul>
            </div>
            <div class="heightLowRight">
                <video id="my-video" class="video-js" controls preload="none" width="840" height="450" poster="/images/FM-1.png" data-setup="{}">
                    <source src="/video/rzrq1.mp4" type="video/mp4">
                    <p class="vjs-no-js">
                    To view this video please enable JavaScript, and consider upgrading to a web browser that
                    <a href="http://videojs.com/html5-video-support/" tppabs="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
                    </p>
                </video>
                <script src="/js/video.min.js" ></script>   
            </div>
        </div>
    </div>
    <!--高杠杆 低费用 end-->
    <!--阿里 star-->
    <div class="clearfix"></div>
    <div class="alibaba">
        <div class="alibaba_top">假设中国平安（601318）股价100元，交易5手（500股）为例</div>
        <div class="alibaba_con">
            <img src="/images/1-7.png?version=1.0.1"  id="baba-top"  alt="">
        </div>
        <div class="alibaba-left animated fadeInLeft">
            <div class="alibaba-left-h1">
                无融资买入中国平安需要 <br> <span class="h2">100</span>元*<span class="h2">500</span>股 <br> =<span class="h2">50,000</span>元
            </div>
            <div class="alibaba-left-h2">
                <img src="/images/1-8.png"  style="vertical-align: middle;margin-right: 10px" alt=""><span class="h1">5万人民币</span>
            </div>
        </div>
        <div class="alibaba-right animated fadeInRight">
            <div class="alibaba-right-h1">
                通过大成国际资产证券买入中国平安只需 <br> <span class="h2">50000</span>元/<span class="h2">10</span>倍杠杆+ <span class="h2">50000</span>元*手续费 <span class="h2">0.7%</span> <br> =<span class="h2">5350</span>元
            </div>
            <div class="alibaba-right-h2">
                <img src="/images/1-9.png" style="vertical-align: middle;margin-right: 10px" alt=""><span class="h1">约5350.0人民币</span>
            </div>
        </div>
    </div>
    <!--阿里 end-->
    <!--一个账户 star-->
    <div class="clearfix"></div>
    <div class="oneAccountBox" style="background-color: #ffffff">
        <div class="oneAccount">
            <div class="oneAccountLeft">
                <img src="/images/1-22.png?version=1.0.1"   id="pointer"  alt="">
            </div>
            <div class="oneAccountRight">
                <img src="/images/1-11.jpg" alt="">
                <p class="h1">15分钟迅速交易</p>
                <hr>
                <ul style="line-height: 40px">
                    <li>盘面震荡加剧，无须恐慌</li>
                    <li>大成国际资产证券为您搭建<span class="h1">15分钟</span>交易通道</li>
                    <li>发现行情判断错误15分钟后迅速平仓</li>
                    <li>毫秒级延迟。</li>
                </ul>
            </div>
        </div>
    </div>
    <!--软件下载 star-->
    <div class="clearfix"></div>
    <div class="downLoadBox">
        <div class="downLoad" id="downLoading">
            <ul class="downLoad-1">
            <li class="downLoad-2">多交易平台</li>
            <li>你可以使用 <span class="h1">1台</span>电脑，或者 <span class="h1">1部</span>手机</li>
            <li>我们提供多平台客户端，满足您不同的使用环境</li>
            </ul>
            <div class="clearfix"></div>
            <div class="downLoading">
            <ul class="downLoadItem">
            <li class="downLoadActive"><img src="/images/windows-h.png"   width="50px" alt=""> windows（pc）</li>
            <li>
                <span class="downLoadBtn-n"><a href="dacheng32.exe"  target="_black">32下载</a></span>
                <span class="downLoadBtn-n"><a href="dacheng64.exe"  target="_black">64下载</a></span>
            </li>
            </ul>
            </div>
            <div class="downLoading" style="position: relative;">
                <img class="adrerweima" src="/images/addapp.png"   alt="下载app" style="display: none;position: absolute;top:-130px;left:100px;width: 200px">
                <ul class="downLoadItem">
                <li class="downLoadActive">
                    <img src="/images/android-hui.png"  width="50px" alt=""> Android
                </li>
                <li class="adrapp"><span class="downLoadBtn-n"><a href="javascript:;" >马上下载(安卓)</a></span></li>
                </ul>   
            </div>
            <div class="downLoading" style="position: relative;">
            <img class="ioserweima" src="/images/iosapp.png" alt="下载app" style="display: none;position: absolute;top:-130px;left:100px;width: 200px">
                <ul class="downLoadItem">
                    <li class="downLoadActive"><img src="/images/ios-hui.png" width="50px" alt=""> IOS</li>
                    <li class="iosapp"><span class="downLoadBtn-n"><a href="javascript:;" >马上下载(Iphone)</a></span></li>
                </ul>
            </div>
        </div>
    </div>
    <!--软件下载 end-->
@endsection
@section('javascript')
    <script>
        $(function(){
            $(window).scroll(function (){
                if ($(window).scrollTop()>300) {
                    $('.advantageBox').addClass('animated swing');
                }
                if ($(window).scrollTop()>700) {
                    $('#baba-top').addClass('animated rubberBand');
                }
                if ($(window).scrollTop()>1000) {
                    $('#pointer').addClass('animated rotateIn');
                }
            });
            /*下载app二维码*/
            $('.iosapp').click(function () {
                $('.ioserweima').show(200);
            });
            $('.ioserweima').click(function () {
                $('.ioserweima').hide(200);
            });
            $('.adrapp').click(function () {
                $('.adrerweima').show(200);
            });
            $('.adrerweima').click(function () {
                $('.adrerweima').hide(200);
            });
            /*轮播图*/
            // 为了实现无缝滚动，我们需要将第一张图片复制一份放到 ul 的最后。
            $('.bannerBox-new ul li:first').clone(true).appendTo( $('.bannerBox-new ul') );

            // 点击右按钮动画。
            var num = 0;
            $('.r').click(play);
            // 将右按钮点击代码封装
            function play(){
                num++;
                if( num == 3 ){
                    $('.bannerBox-new ul').css({'left':0});
                    num = 1;
                }
                $('.bannerBox-new ul').stop().animate({'left':-num*100+'%'},500);
            }
            $('.l').click(function(){
                num--;
                if( num == -1 ){
                    $('.bannerBox-new ul').css({'left':- 300+'%'});
                    num = 2;
                }
                $('.bannerBox-new ul').stop().animate({'left':-num*100+'%'},500);
            });
        });
    </script>
@endsection