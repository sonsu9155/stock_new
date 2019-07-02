@extends('bsb.templates.admin')
@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>
            股票图
            <small>管理>股票图表</small>
        </h2>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        今日股票图
                    </h2>

                </div>
                <div class="body">
                    <div class="row">
                    </div>
                    <div id="img">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('additional_footer')
<?php Assets::add('datatable'); ?>
<script type="text/javascript">
    $(function () {
        function getProductKImage(kkstr , code) {
            var kuangdu = $(".body").width();
            var area_str = "sh";
            if (kkstr == "") {
                kstr = "min";
            } else {
                kstr = kkstr;
            }
            
            if (code.substring(0, 1) == "6") {
                area_str = "sh";
            }
            if (code.substring(0, 1) == "0" || code.substring(0, 1) == "3")
                area_str = "sz";
            if (code != "" && code.length == 6) {
                if (area_str != "") {
                    var picstr = "<div style='position:relative;' class='img-box'><img id='pic_k_id' class='sj-img' src='http://image2.sinajs.cn/newchart/" + kstr + "/n/" + area_str + code + ".gif?" + Math.random() * 100000 + "' border='0' width='" + kuangdu + "' /><i style='width: 31px;height: 20px;position: absolute;background: #1c1b29;right: 10%;top: 49.2%;'></i></div>";
                    return picstr;
                }
            }
        }

        var picstr = getProductKImage("min" , "000001");
        $("#img").html(picstr);
    });
</script>
@endsection
