@extends('layouts.web_template')

@section('css')
    <link rel="stylesheet" href="/css/base.css">
    <link rel="stylesheet" href="/css/order.css">
    <link href="/css/font-awesome.min.css" rel="stylesheet">
    <link href="/css/jquery-confirm.min.css" rel="stylesheet">
    <link href="/css/toastr.min.css" rel="stylesheet">
@endsection

@section('script')
    <script src="/js/jquery.min.js"></script>
    <script src="/js/jquery-confirm.min.js"></script>
    <script src="/js/toastr.min.js"></script>
    <script type="text/javascript" async="" src="https://www.google-analytics.com/analytics.js"></script>
    <script  type="text/javascript" src="/js/clipboard.min.js"></script>
    <script>

        $("#dialog-submit").click(function () {
            return toastr.success('请耐心等待对方确认,此页面关闭即可', null, {positionClass: 'toast-top-center'});
        });

        $('.pay-channel label').click(function () {
            $(this).addClass('current').siblings().removeClass('current');
            $('.order-channel-content div[class*=channel]').hide()
            $('.order-channel-content .channel-'+ $(this).data('channel')).show();
        });


        $('button[data-action="next"]').click(function () {
            var i = $(this).attr('data-step');
        $('.dialog-confirm').show();
        });

        function step2Next() {
            if (status == 0) {
                $('.dialog-confirm,.dialog-shape').show()
            } else if (status == 2){
                return toastr.error('订单已失效，请返回后重新下单支付', null, {positionClass: 'toast-top-center'});
            }else if(status == 1){
                return toastr.error('您已经提醒过了,请耐心等待', null, {positionClass: 'toast-top-center'});
            }
        }

        function formVal(name) {
            var items = $('input[name="' + name + '"]');
            var val = '';
            if(items.is('[type="text"]')){
                val = items.val();
            }else{
                val = items.filter(':checked').val();
            }
            val = val ? val.trim() : '';
            return val;
        }

        (function () {
            var begin_time = '2019-03-09 20:07:00';
            var EndTime = new Date(begin_time.replace(' ','T')).getTime() + 9000000;
            var timer = null;

            function GetRTime() {
                var NowTime = new Date().getTime();
                var nMS = (EndTime - NowTime) / 1000;

                var nD = Math.floor(nMS / (60 * 60 * 24));
                var nH = Math.floor(nMS / (60 * 60)) % 24;
                var nM = Math.floor(nMS / (60)) % 60;
                var nS = Math.floor(nMS) % 60;

                if (nMS <= 0) {
                    window.clearInterval(timer);
                    nD = '00';
                    nH = '00';
                    nM = '00';
                    nS = '00';
                    callback();
                }
                $('#time').html(fill(nM, 2) + ':' + fill(nS, 2));
            }

            function fill(num, n) {
                var len = num.toString().length;
                while (len < n) {
                    num = "0" + num;
                    len++;
                }
                return num;
            }

            function callback() {
                status = 1;
                $(".section-order-time").text('交易已关闭');
            }

            $(document).ready(function () {
                GetRTime()
                timer = window.setInterval(GetRTime, 1000);
            });

        })();


        var status = "0";


        $('.dialog .icon-close').click(function () {
            $('.dialog-confirm,.dialog-shape').hide()
        });

        $("#dialog-back").click(function () { 
            $('.dialog-confirm,.dialog-shape').hide()
        });

        var clipboard = new ClipboardJS('.btn-copy');
        clipboard.on('success', function(e) {
            var $tip = $('<span>复制成功</span>').delay('1s').fadeOut(function () {
                $(this).remove();
            })
            $tip.appendTo(e.trigger)
            e.clearSelection();
        });

        $('.tip').click(function () {
            $('.tip').removeClass('active');
            $(this).addClass('active');
        })
        $('.tip .roll-up').click(function (e) {
            e.stopPropagation();
            $(this).closest('.tip').removeClass('active');
        })

        function alertError(txt) {
            var width = '500px';
            if('ontouchend' in window){
                width = '80%';
            }
            $.confirm({
                title:false,
                content: '<div style="font-size:16px;margin-top:10px;">'+txt+'</div>',
                boxWidth: width,
                useBootstrap: false,
                buttons: {
                    close: {
                        text: '关闭',
                        btnClass:'btn btn-primary',
                    }
                }
            });
        }

    </script>
    <script async="" src="js/f68558689ed74f1ab85c907814f163c4.js"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-122927834-1');
    </script>

@endsection

@section('content')
    <div class="nav">
    </div>

    <div class="order-container">
        <div class="container">
            <div class="order-guide-tip">
                <h3>加密 | 收银台</h3>
                <p>您购买的USDT已在加密平台系统完成托管锁定，卖家无法单独提走，请放心支付</p>
            </div>

            <div class="section-order-content">

                <div class="pay-channel">
                    <h3>交易方式</h3>
                    <div>
                      <label data-channel="bank" for="user_pay_channel2" class=" current "><span></span> <i class="icon icon-upay"></i> 银联卡转账</label>
                    </div>
                </div>

                <div class="order-note">
                    <ul>
                        <li>1、每次支付<span class="text-danger">随机匹配</span>的卖家不同，同一个卖家所使用的银行卡也可能不同，<span class="text-danger">请按照每次所显示的付款信息打款，</span>请勿直接打款到之前充值过的卡号，<span class="text-danger">否则可能无法到账，</span>造成的损失平台概不负责。</li>
                        <li>2、转账时<span class="text-danger">请勿填写任何备注！</span>包括数字货币、USDT、充值、美金、外汇等字样。<span class="text-danger">否则可能导致卖家账户和您的账户被冻结，</span>造成的损失平台概不负责。</li>
                        <li>3、<b>重要提示：</b>作为独立公正的数字货币撮合平台，<span class="text-danger">加密平台坚决反对任何机构和个人利用加密产品从事不符合法律的商业行为。</span>如果您对交易有疑问，或有任何的投诉或建议，请email联系加密通道官方客服：<span class="text-danger"></span>我们确保100%回复。</li>
                    </ul>
                </div>

                <div class="content content-step-3">

                    <div class="order-money-total"> </div>
                    <div class="g1">
                        <div class="order-uknow">
                            <h3>交易须知:</h3>
                            <ul>
                                <li>1.根据国家相关法律规定，购买数字货币仅支持自然人之间的点对点转账交易</li>
                                <li>2.卖家收到转账后您购买的USDT将从加密平台释放到您充值的商家平台</li>
                            </ul>
                        </div>
                    </div>
                    <div class="g2">
                        <div class="order-channel" style="height:100%;">
                            <div class="order-channel-head">
                                <ul>
                            
                                    <li><b>卖家信用</b></li>
                                        <li><b>订单金额：{{$money}}元</b></li>
                                    
                                </ul>
                            </div>
                            <div class="order-channel-content">
                                <span class="tip pull-left"><i class="fa fa-question-circle-o" aria-hidden="true"></i> 卖家是谁，交易安全么? <span class="tip-content">卖家是由加密平台经过严格身份认证和审核的个人。加密平台采用支付宝模式，卖家的数字货币已经被加密平台托管锁定，不存在卖家收到钱后不发币的风险。加密平台为本次交易的安全性提供担保和先行赔付服务，请放心交易。<div class="roll-up">收起 <i class="fa fa-angle-up"></i></div></span></span>
                                <div class="channel-alipay" style="display:  none ;">
                                    <div class="text text-pc">请用 <i class="icon icon-alipay-text"></i> 扫码完成支付</div>
                                    <div class="text text-mobile">
                                        如已安装支付宝请直接点击下方支付按钮<br>
                                        或 保存二维码，在支付宝APP扫一扫中选择相册打开
                                    </div>
                                    <div class="qrcode">
                                        <img src="" alt="" style="width: 220px;height: 250px;max-width:100%;max-height:100%;">
                                        <a class="btn btn-primary" href="">打开支付宝支付</a>
                                    </div>
                                    <div class="text">支付完成后，请点击下方的“提醒卖家收款”按钮</div>

                                </div>
                                <div class="channel-bank" style="display:  block ;">
                                    <div class="text text-pc">请用 <i class="icon icon-upay"></i> 网银或银行APP完成转账</div>
                                    <table>
                                        <tbody><tr>
                                            <td>卖家信息：</td><td>胡翼文</td><td><button class="btn btn-primary btn-sm btn-copy" data-clipboard-text="胡翼文">复制</button></td>
                                        </tr>
                                        <tr>
                                            <td>银行信息：</td><td>广州农村商业银行夏良支行</td><td><button class="btn btn-primary btn-sm btn-copy" data-clipboard-text="广州农村商业银行夏良支行">复制</button></td>
                                        </tr>
                                        <tr>
                                            <td>银行卡号：</td><td>622439320015563061</td><td><button class="btn btn-primary btn-sm btn-copy" data-clipboard-text="622439320015563061">复制</button></td>
                                        </tr>
                            
                                    </tbody></table>
                                    <div class="text">支付完成后，请点击下方的“提醒卖家收款”按钮</div>
                                </div>
                            </div>
                        </div>


                    </div>

                    <div class="clear"></div>

                    <div class="order-safe-tip">                   
                        <div class="order-safe-tip-content">
                            <dl>
                                <dt><i class="icon icon-safe-safe"></i></dt>
                                <dd>
                                    <h5>联合担保</h5>
                                    <p>本次交易由加密和商家提供联合担保</p>
                                </dd>
                            </dl>                    
                            <dl>
                                <dt><i class="icon icon-safe-money"></i></dt>
                                <dd>
                                    <h5>保证金</h5>
                                    <p>卖家已向加密平台缴纳足额保证金</p>
                                </dd>
                            </dl>
                            <dl>
                                <dt><i class="icon icon-safe-lock"></i></dt>
                                <dd>
                                    <h5>托管锁定</h5>
                                    <p>卖家出售USDT已托管锁定在加密平台</p>
                                </dd>
                            </dl>
                        </div>
                    </div>

                    <div class="footer-fixed">
                        <div class="order-next">
                            <a href="/web/payment"><button class="btn btn-primary btn-lg btn-color-light" onclick="../">上一步</button></a> &nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="/web/payment_log"><button class="btn btn-primary btn-lg" data-action="next" data-step="2">提醒卖家收款</button></a>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>


    <div class="order-note">
        <div class="container">
            <h3>交易提醒：</h3>
            <ul>
                <li>1、<b>关于加密：</b>加密是全球首个场景化数字货币兑换平台，撮合数字货币持有者、数字货币需求者进行快速的数字货币兑换，并用担保交易确保兑换的100%安全。</li>
                <li>2、<b>交易时间段：</b>9：00-21：00，其他时间的交易可能会延迟到下个交易时间段处理。</li>
                <li>3、<b>到账速度：</b>根据银行结算制度，在工作日的17：00以前，到账速度为实时到账；工作日17：00以后和周末节假日时间，到账速度可能略有延迟。到账时间取决于银行规定，请咨询您的银行。</li>
            </ul>
        </div>
    </div>

    <div class="dialog dialog-confirm">
        <div class="dialog-head"><i class="icon icon-close"></i>温馨提示</div>
        <div class="dialog-body">
            <p>
                <span class="text-danger">若您尚未转账给卖家，请不要提醒卖家确认，</span><br>
                <span>以免造成充值失败和不必要的纠纷。</span>
            </p>
        </div>
        <div class="dialog-button">
            <button class="btn btn-primary" id="dialog-submit">确认已转账</button>
            <button class="btn" id="dialog-back">尚未转账</button>
        </div>
    </div>
@endsection