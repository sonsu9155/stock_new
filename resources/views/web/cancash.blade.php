@extends('layouts.web_template')

@section('css')
<link href="/css/style2.css" rel="stylesheet" type="text/css" />
<style>
  .mybox th {font-size:12px; font-weight:normal; color:#fff;}
  .mybox td {padding:3px; line-height:18px;}
</style>
@endsection

@section('script')
<script type="text/javascript" src="/js/jquery.date_input.js"></script>
<script type="text/javascript">
$(document).ready(function(){

});
</script>
@endsection

@section('content')
<table width="98%" align="center" cellpadding="3" cellspacing="1" bgcolor="#3f4042" style="margin-top:5px;border:1px solid #CCCCCC;" class="mybox">
  <tr>
    <td width="50%" height="30" bgcolor="#3f4042">
      &nbsp;&nbsp;&nbsp;交易账户：{{ $user->username }}　
      截至: <font color=red><b>{{ date("Y-m-d H-m-s")}}</b></font>
      保证金：<span class="money1">￥{{  number_format($stock_wallet->before_amount - $fund_amount, 2) }}</span>
      &nbsp;&nbsp;可用保证金：
      <span class="money1">
            @if($money_wallet->before_amount >  $money_wallet->after_amount + $money_wallet->before_amount- $stock_wallet->after_amount - $fund_amount)
              ￥ 0
            @else
              ￥ {{   $money_wallet->after_amount - $stock_wallet->after_amount -$fund_amount}}
            @endif
      </span> 
      明细如下！
    <input type="button" name="Submit" value="刷新" onClick="self.location.href=self.location.href +'?' + Math.random();" class="button3"></td>
  </tr>
</table>
<table width='98%' border='0' align="center" cellpadding='3' cellspacing='1' bgcolor="#CCCCCC" class="mybox">
  <tr align='center'>
    <th width="13%" class="text-center">保证金(A)</th>
    <th width="13%" class="text-center">持仓总金额(B)</th>
    <th width="13%" class="text-center">持仓保证金(C)</th>
    <th width="13%" class="text-center">委托总金额(D)</th>
    <th width="13%" class="text-center">委托保证金(E)</th>
    <th width="13%" class="text-center">可用保证金(F)</th>
  </tr>
  <tr align='center' bgcolor="#3f4042" onMouseOver="this.style.background='#3f4042';" onMouseOut="this.style.background='#3f4042';">
    <td>￥{{ number_format($stock_wallet->before_amount - $fund_amount, 2) }}</td>
    <td>￥{{ number_format($money_wallet->after_amount - $fund_amount, 2) }}</td>
    <td>
            @if($money_wallet->before_amount >  $money_wallet->after_amount + $money_wallet->before_amount- $stock_wallet->after_amount - $fund_amount)
              ￥ {{ $money_wallet->after_amount - $stock_wallet->after_amount - $fund_amount }}
            @else
              ￥ {{ $money_wallet->after_amount - $stock_wallet->after_amount - $fund_amount - $money_wallet->before_amount}}
            @endif
    </td>
    <td>￥ 0 </td>
    <td>￥ 0 </td>
    <td>￥{{ number_format($money_wallet->after_amount + $money_wallet->before_amount - $stock_wallet->after_amount - $fund_amount , 2) }}</td>
  </tr>  
</table>
@endsection