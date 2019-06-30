@extends('layer.main')
@section('title')
    财智通
@endsection
@section('nav3_active')
    id = "navActive"
@endsection
@section('content')
<!--banner star-->
<div class="bannerBox">
    <div class="banner-list">
        <img src="/images/1-40.png"  class="banner">
    </div>
    <img src="/images/1-41.png"   height="76px" style="margin-top:160px;" class="oneTop animated zoomInRight">
    <p class="describe animated zoomInLeft" style="margin-top: 10px">
        大成国际资产致力于提供全球最优质的证券投资品种 <br>为广大投资者提供更高效更快捷更安全的金融投资业务
    </p>
</div>
<!--banner end-->

<!--content star-->
<div class="clearfix"></div>
<div class="aboutCon1">
     <div class="aboutCon1-box">
         <img src="/images/1-42.png" t  >
         <h4>安全</h4>
         <p> 打造最安全的<br>投资交易系统</p>
     </div>
     <div class="aboutCon1-box">
         <img src="/images/1-43.png"  >
         <h4>丰富</h4>
         <p> 选择最具有投资价值<br>的全球化金融产品</p>
     </div>
     <div class="aboutCon1-box">
         <img src="/images/1-44.png"  >
         <h4>惠普</h4>
         <p> 创建最具影响力的<br>全球化投资学院 </p>
     </div>
    <div class="aboutCon1-box">
        <img src="/images/1-45.png"  >
        <h4>便捷</h4>
        <p> 提供最优质的<br>美股财经资讯 </p>
    </div>
</div>
<div class="clearfix"></div>
<div class="aboutCon2">
    <div class="aboutCon2-box">
        <div class="aboutCon2-box-left">
            <img src="/images/1-47.png"  alt=""><br>
            <img src="/images/1-48.png"  alt=""><br>
            <img src="/images/1-49.png"  alt="">
        </div>
        <div class="aboutCon2-box-right">
            大成国际资产公司介绍：<br/>
  
            公司全称：大成国际资产金融有限公司|成立时间：2018年6月5号<br/>
            注册资本：11485000港元|注册号：2164537<br/>
            公司地址：香港中环夏悫道10号和记大厦419-420室<br/>
            联系电话：00852-59856291
          
        </div>
    </div>
</div>
<div class="clearfix"></div>
<!--content end-->
@endsection
@section('javascript')
    <script>
        $(function(){       
            /* 下载按钮 */
            $('#downBtn').click(function () {
                window.location='index.html#downLoading';
            });
            /*动画执行*/
            $(window).scroll(function (){
                if ($(window).scrollTop()==200) {
                    $('.aboutCon1-box img').addClass('animated wobble');
                }
            });
        });
    </script>
@endsection