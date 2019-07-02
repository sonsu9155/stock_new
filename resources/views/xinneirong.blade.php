@extends('layouts.main')
@section('css')
	<style>
		.m{ width: 740px; height: 400px; margin-left: auto; margin-right: auto; margin-top: 100px; }
	</style>
@endsection
@section('nav2_active')
        id = "navActive"
@endsection
@section('content')

    <!--banner star-->
    <div class="bannerBox">
        <div class="banner-list">
            <img src="/images/banner1.png" class="banner">
        </div>
        <img src="/images/1-26.png" height="76px" class="oneTop animated zoomInRight">
        <p class="describe animated zoomInLeft">【实时交易】 【委托交易】两种玩法 日内交易最高提供10倍杠杆 <br>助您收益步步高升</p>
    </div>
    <!--banner end-->

    <!--content star-->
    <div class="clearfix"></div>
    <div class="content">
        <div class="contentLeft">
            <span class="dealBtnActive" style="margin-right: 16px">活跃交易</span>
            <div class="activeDealBox" id="hy" >
                <div class="activeItem" style="border-bottom: 1px solid #ddd;">
                    <p class="activeItem-h"><img src="/images/1-32.png" alt="">专属T+0交易</p>
                    <div class="activeItem-c">
                        当日买入股票当日即可卖出，<br> 灵活交易
                    </div>
                </div>
                <div class="activeItem" style="border-bottom: 1px solid #ddd;">
                    <p class="activeItem-h"><img src="/images/1-30.png" alt="">低投入，高杠杆</p>
                    <div class="activeItem-c">
                        提供最高10倍杠杆，<br> 最低买入10手
                    </div>
                </div>
                <div class="activeItem">
                    <p class="activeItem-h"><img src="/images/1-31.png" alt="">低佣金，低费率</p>
                    <div class="activeItem-c">
                        手续费低至1%
                    </div>
                </div>
            </div>
        </div>
        <div class="contentRight">
                <video id="my-video" class="video-js" controls preload="none" width="790" height="420"poster="/images/FM-2.jpg" data-setup="{}">
                <source src="/video/rzrq2.mp4" type="video/mp4">
                <p class="vjs-no-js">
                To view this video please enable JavaScript, and consider upgrading to a web browser that
                <a href="javascript:if(confirm('http://videojs.com/html5-video-support/  \n\n??ļ?δ?? Teleport Pro ?????Ϊ ?λ??ʼ???????ı߽????????????  \n\n??Ҫ?ӷ????????'))window.location='http://videojs.com/html5-video-support/'" tppabs="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
                </p>
            </video>
            <script src="/js/video.min.js"></script>	
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="bigBtnBox">
        <div class="bigBtnBox-con">
            <img src="/images/1-38.png" class="leftSan" alt="">
            <img src="/images/1-39.png" class="rightSan"  alt="">
        </div>
    </div>
    <div class="clearfix"></div>
    <!--content end-->
@endsection