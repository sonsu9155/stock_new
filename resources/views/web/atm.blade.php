@extends('layouts.web_template')

@section('css')
<link href="/css/tip-violet.css" rel="stylesheet" type="text/css" />
<link href="/css/style2.css" rel="stylesheet" type="text/css" />
<style>
    #TB_window {min-height:100px;}
</style>
@endsection
@section('script')
<script type="text/javascript" src="/js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="/js/jquery.poshytip.js"></script>
<script type="text/javascript" src="/js/jquery.validate.js"></script>
<script type="text/javascript" src="/js/noright.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	var isdemo = 0;
	if(isdemo==1)
	{
		parent.ymPrompt.alert({title:'申请提款',message:'试玩帐户不能进行“申请提款”操作！请您注册我们的正式帐号！'});
		$('#btnAtm').attr('value','试玩帐号不能提款操作');
		$('#btnAtm').attr('disabled','true');
		$('#money').attr('disabled','true');
		$('#bank').attr('disabled','true');
		$('#bankname').attr('disabled','true');
		$('#bankno').attr('disabled','true');
		$('#bankrealnam').attr('disabled','true');
		$('#atmpwd').attr('disabled','true');
	}
	
	$("#btnOK").click(function(){
		tb_remove();
	});
	
	$("#btnReg").click(function(){
		tb_remove();
		top.location.href='reg.php?utype=1';
	});
	$("#AtmForm").validate({
		rules: {
			money: {required:true, number:true },
			bankrealname: {required: true},
			atmpwd: {required:true}
		},
		messages: {
			money: {required: "请输入要出金的金额."},
			bankrealname: {required: "请输入帐户名."},
			atmpwd: {required:"请输入资金密码.",number:"资金密码必须是数字.",remote: jQuery.format("[<b>资金密码</b>]:你输入的资金密码不正确.")}
		},
		submitHandler: function(form) {
			form.submit();
		}
	});
});
</script>
@endsection
@section('content')
<div style="color: #010000;">
<form id="AtmForm" method="post" action="/web/add_atm">
{{ csrf_field() }}
  <table width="99%"  border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC" class="mybox">
    <tr>
      <th colspan="2" class="text-center">证券转银行(出金)</th>
    </tr>
    <tr bgcolor="#EDF8FF">
      <td align="right" bgcolor="#EDF8FF">友情提醒：</td>
      <td>可出金时间为: <font color=red> 周一至周五09:30—18:00（节假日除外），申请出金单笔5元手续费，由三方监管银行扣除，根据银行监管T+1结算机制，当天申请出金第二个交易日下午18:00之前到账，具体到账时间以银行结算时间为准！</font> <br>
    </tr>
    <tr bgcolor="#EDF8FF">
      <td width="20%" align="right" bgcolor="#EDF8FF">可出金额：</td>
      <td>
         <span class="money">
          @if($money_wallet->after_amount - $fund_amount >$stock_wallet->after_amount)
          ￥{{ number_format( $money_wallet->after_amount - $stock_wallet->after_amount  - $fund_amount , 2) }}
          @else
          ￥0
          @endif
        </span>
    </td>
    </tr>
    <tr bgcolor="#EDF8FF">
      <td align="right">出金金额：</td>
      <td><input name="money" type="text" id="money" value="0" size="10"  value="">&nbsp;<span class="gray"></span> </td>
    </tr>
    <tr bgcolor="#EDF8FF" hidden>
    <td align="right">开 户 行：</td>
    <td><input name="kh_bank" type="text" id="kh_bank" value={{ $user->kh_bank }}  size="30"> </td>
    </tr> 
    <tr bgcolor="#EDF8FF"  hidden>
      <td align="right">帐 户 名：</td>
      <td><input name="realname" type="text" id="realname" size="30" value={{ $user->name }} readonly> &nbsp;<span class="gray"></span></td>
    </tr>
    <tr bgcolor="#EDF8FF"  hidden>
      <td align="right">银行名称：</td>
      <td><input name="bankname" type="text"  size="30" value="" readonly="readonly">{{$user->bank_name}}</td>
    </tr>
    <tr bgcolor="#EDF8FF"  hidden>
      <td align="right">银行帐号：</td>
      <td><input name="bankno" type="text" id="bankno" size="30" value={{$user->bank_card}} readonly="readonly"></td>
    </tr>
    <tr bgcolor="#EDF8FF">
      <td align="right">资金密码：</td>
      <td><input name="atmpwd" type="password" id="atmpwd" size="5" maxlength="4" style="width:50px"><font color=red></td>
    </tr>
    <tr bgcolor="#EDF8FF">
      <td align="right">&nbsp;</td>
      <td><input type="submit" name="Submit" id='btnAtm' value="确认出金" class="button3"></td>
    </tr>
  </table>
  </div>
@endsection






