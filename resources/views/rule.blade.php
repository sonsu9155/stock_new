@extends('layer.main')
@section('title')
    财智通
@endsection
@section('css')
<style>
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
    </style>
@endsection
@section('nav5_active')
        id= "navActive"
@endsection
@section('content')

<!--banner star-->
<div class="bannerBox">
    <div class="banner-list">
        <img src="/images/banner-1-1.png"  class="banner-1">
    </div>
    <img src="/images/yige.png"  class="oneTop animated zoomInRight">
    <p class="describe animated zoomInLeft">
        融资融券交易机制，多空双向操作，既可以买涨也可以买跌 <br>T+0交易，当天买卖，当天可以平仓交易
    </p>
</div>
<div class="youshiBox" style="height: 700px;line-height: 30px;">
    <!--公告 star-->
    <!--公告 end-->
    <div class="container" style="margin: 20px auto 70px auto;">
        大成国际资产融资融券交易规则介绍<br>
        开设注册账户前，请详细阅读客户须知；股市有风险，投资需谨慎；<br>
        大成国际资产融资融券交易须知：<br>
        1、 交易融资比例为1:10,即最大资金使用量为客户可用保证金（即本金）的10倍；
        2、 每笔交易均以交易金额为准下单即时扣除交易费用（其中包括：千分之一印花税，千分之四手续费（单边千二），千分之三融资利息）；<br>
        3、 留仓股票最多持仓时间为五个交易日（留仓天数到期日以当日收盘价，系统将自动进行平仓）；<br>
        4、 留仓股票均以交易总金额扣除万分之八为当天留仓过夜费；<br>
        5、 交易熔断阈值为交易股票每日涨（跌）幅达到百分之七，或前一日涨（跌）幅达到百分之八时,系统将停止当日该交易股票多（空）新单的购买；系统并有权修正熔断期间任何异常下单； <br>
        6、 个股盘中任一时点（含开盘、收盘）触及涨跌停板,跳空等异常情况下单,为保证共同利益，系统将有权自动止盈止损，均以涨跌停板价或建仓价自动平仓结算。<br>
        7、 以股票买入的成本价计算，赢/亏额达到百分之七十时，系统将自动平仓；
        因为股票是撮合制交易，会出现无法在预期价格交易，如急速拉升或买卖量不足等，会将自动平仓比例放大所以自动平仓70%-85%都属于正常范围。 8、 单股每笔持仓最低交易金额为一万元以上，单仓或多仓集合竞买不超过五十万元人民币（单向同时持仓）；<br>
        9、每支股票单笔买入后不可分批卖出，故建议客户同一支股票可分次购入；<br>
        10、为保证客户下单交易的及时和有效性，系统对每笔下单均为及时成交价,系统代为委托下单；<br>
        11、新建仓之股票15分钟内系统不允许平仓，平仓时会自动扣除相应之手续费用；<br>
        12、系统交易时间为：A股正常交易日内的上午09:32-11:30，下午13:02-14:57；系统出金时间为A股正常交易时间；<br>
        13、当日有留仓的客户端不支持出金；<br>
        14、客户提现T+1到账；<br>
        15、本交易规则如有未尽事宜，可视状况随时调整。本公司保留规则和条款的最终解释权<br>
    </div>
    <div class="clearfix"></div>
</div>
<!--优势 end-->
@endsection
@section('javascript')
<script>
$(function(){  
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
    
});
</script>
@endsection