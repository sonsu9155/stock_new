@extends('layouts.web_template')

@section('css')
<link href="/css/ymPrompt.css" rel="stylesheet" type="text/css" />
<link href="/css/tip-violet.css" rel="stylesheet" type="text/css" />
<link href="/css/style2.css" rel="stylesheet" type="text/css" />
<style>
  .mybox td {padding:3px; line-height:18px; }
</style>
@endsection
@section('script')
<script type="text/javascript" src="/js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="/js/cookie.js"></script>
<script type="text/javascript" src="/js/jquery.poshytip.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    showgain();
    $('#tips_gain,#tips_gain1,#tips_cost,#tips_cc,.tips_n').poshytip({
      className: 'tip-violet',
      bgImageFrameSize: 9
    });
  });
</script>
@endsection
@section('content')
<table width="99%" border="0" align="center" cellpadding="3" cellspacing="1" class="mybox" style="border:1px solid #cccccc;">
  <tr align="center">
    <td width="13%" style="border: 1px solid black;">交易账户：<span class="gray">{{$user->username}}</span></td>
    <td width="13%" style="border: 1px solid black;">姓名：<span class="gray">{{$user->name}}</span></td>
    <td width="13%" style="border: 1px solid black;">买入手续费 :<span class="gray">{{ $setting->cost_bull_max * 100 }}‰</span></td>
    <td width="13%" style="border: 1px solid black;">卖出手续费：<span class="gray">{{ $setting->cost_sell_max * 100 }}‰</span></td>
    <td width="13%" style="border: 1px solid black;">利息 ：<span class="gray">{{ $setting->cost_daily_max * 100 }}‰</span></td>
    <td width="13%" style="border: 1px solid black;">留仓费率：<span class="gray">{{ $setting->cost_save_max * 100 }}‰ /天 </span></td>
    <td width="13%" style="border: 1px solid black;">日期：<span class="gray">{{ date(" Y-m-d ") }}</span></td>
    <td style="border: 1px solid black;">
    <span style="float:left; display:inline; margin-left:20px;">可用额度：</span>
    <span class="money" style="display:inline;">
    @if(($money_wallet->after_amount + $money_wallet->before_amount)>($stock_wallet->after_amount+$stock_wallet->before_amount))          
    ￥{{ number_format( $money_wallet->after_amount - $fund_amount, 2) }}
    @else
    ￥{{ number_format( $money_wallet->after_amount - 10*$fund_amount, 2) }}
    @endif
  </span></td>
  </tr>
</table>
<table width="99%" border="0" align="center" cellpadding="3" cellspacing="1" class="mybox" style="margin-top:10px;">
  <tr>
    <th colspan="14" class="text-center">平仓单</th>
  </tr>
  <tr>
    <td rowspan="2" align="center"  style="border: 1px solid black;">订单号</td>
    <td rowspan="2" align="center"  style="border: 1px solid black;">代码/名称</td>
    <td colspan="3" align="center" style="border: 1px solid black;">买</td>
    <td colspan="3" align="center" style="border: 1px solid black;">卖</td>
    <td rowspan="2" align="center" style="border: 1px solid black;">升/跌</td>
    <td rowspan="2" align="center" style="border: 1px solid black;">数量(手)</td>
    <td rowspan="2" align="center" style="border: 1px solid black;">手续费</td>
    <td rowspan="2" align="center" style="border: 1px solid black;">留仓费</td>
    <td rowspan="2" align="center" style="border: 1px solid black;">印花税</td>
    <td rowspan="2" align="center" style="border: 1px solid black;">盈亏</td>
  </tr>
  <tr >
    <td align="center"  style="border: 1px solid black;">委托号</td>
    <td align="center"  style="border: 1px solid black;"> 下单时间 </td>
    <td align="center"  style="border: 1px solid black;">成交价</td>
    <td align="center"  style="border: 1px solid black;">委托号</td>
    <td align="center"  style="border: 1px solid black;">下单时间 </td>
    <td align="center"  style="border: 1px solid black;">成交价</td>
  </tr>
  @if($sell_histories)
  @foreach($sell_histories as $index => $sell_history)
    <tr align="center"  onMouseOver="this.style.background='#3f4042';" onMouseOut="this.style.background='#3f4042';">
      <td style="border: 1px solid black;">{{ $sell_history->id }}</td>
      <td style="border: 1px solid black;">{{ $sell_history->stockType->code}} / {{ $sell_history->stockType->cn_name }}</td>
      <td style="border: 1px solid black;">{{ $sell_history->id }}</td>
      <td style="border: 1px solid black;">{{ $sell_history->buy_time }}</td>
      <td style="border: 1px solid black;">{{ $sell_history->buy_cost }}</td>
      <td style="border: 1px solid black;">{{ $sell_history->id }}</td>
      <td style="border: 1px solid black;">{{ $sell_history->created_at }}</td>
      <td style="border: 1px solid black;">{{ $sell_history->sell_cost }}</td>
      @if($sell_history->method =="1")
      <td style="border: 1px solid black;"><font color="red" >升</font></td>
      @else
      <td style="border: 1px solid black;"><font color="red" >跌</font></td>
      @endif
      <td style="border: 1px solid black;">{{ $sell_history->amount }}</td>
      <td style="border: 1px solid black;">{{ $sell_history->sell_fee * $sell_history->amount * $sell_history->sell_cost * 100 }}</td>
      <td style="border: 1px solid black;">{{ $sell_history->save_fee * $sell_history->amount * $sell_history->sell_cost * 100 }}</td>
      <td style="border: 1px solid black;">{{ $sell_history->state_fee * $sell_history->amount * $sell_history->sell_cost * 100 }}</td>
      <td style="border: 1px solid black;">{{ number_format($sell_history->fee, 2) }}</td>
    </tr>
  @endforeach
  @endif
  <tr align="center" >
    <td height="30" colspan="14" style="border: 1px solid black;"><span style="display:none;">0</span>平仓盈亏小计：<span  id="pcgain" class="money1"><font color=green>￥{{ number_format($sell_histories->sum('fee'), 2) }}</font></span></td>
  </tr>
</table>

<table width="99%"  border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC" class="mybox" style="margin-top:10px;">
  <tr>
    <th colspan="14" class="text-center">留仓和持仓单</th>
  </tr>
  <tr align="center" bgcolor="#C5E2FB">
    <td height="20" style="border: 1px solid black;">订单号</td>
    <td style="border: 1px solid black;">下单时间</td>
    <td style="border: 1px solid black;">代码/名称</td>
    <td style="border: 1px solid black;">升/跌</td>
    <td align="center" style="border: 1px solid black;">成交价格</td>
    <td align="center" style="border: 1px solid black;">数量(手)</td>
    <td align="center" style="border: 1px solid black;">成交金额</td>
    <td align="center" style="border: 1px solid black;">手续费</td>
    <td align="center" style="border: 1px solid black;">可卖数量(手)</td>
    <td align="center" style="border: 1px solid black;">留仓天数/费用</td>
    <td align="center" style="border: 1px solid black;">印花税</td>
    <td align="center" style="border: 1px solid black;"> 现价</td>
    <td align="center" style="border: 1px solid black;">盈亏</td>
    
  </tr>
  @if($buy_histories)
  @foreach($buy_histories as $index => $buy_history)
  <tr align="center"  onMouseOver="this.style.background='#3f4042';" onMouseOut="this.style.background='#3f4042';">
    <td height="33px" align="center" id="inf_{{ $index + 1 }}" style="display:none;" value="{{ $buy_history->cost }},{{ $buy_history->method }},{{ $buy_history->amount }},{{  $buy_history->fee * $buy_history->amount * $buy_history->cost *0.01 }},{{ $buy_history->fee * 0.0001 }},0, {{$buy_history->cost * 0.05 }}">00006420</td>
    <td style="border: 1px solid black;">{{ $buy_history->id }}</td>
    <td style="border: 1px solid black;">{{ $buy_history->created_at }}</td>
    <td style="border: 1px solid black;">{{ $buy_history->stockType->code}} / {{ $buy_history->stockType->cn_name}}</td>
    @if($buy_history->method =="1")
    <td style="border: 1px solid black;"><font color="red" >升</font></td>
    @else
    <td style="border: 1px solid black;"><font color="red" >跌</font></td>
    @endif
    <td style="border: 1px solid black;">{{ $buy_history->cost }}</td>
    <td style="border: 1px solid black;">{{ $buy_history->amount }}</td>
    <td style="border: 1px solid black;"> {{ $buy_history->cost  *  $buy_history->amount *100 }} </td>
    <td style="border: 1px solid black;">{{ $buy_history->fee * $buy_history->cost  *  $buy_history->amount  *100 }}</td>
    <td style="border: 1px solid black;"> {{ $buy_history->amount }} </td>
    <td style="border: 1px solid black;">{{ $setting->cost_save_day }} / {{ $setting->cost_save_max }}</td>
    <td style="border: 1px solid black;" > {{ $setting->cost_state_max * $buy_history->cost  *  $buy_history->amount  *100}}</td>
    <td style="border: 1px solid black;" id="cur_price_{{ $index + 1 }}"></td>
    <td style="border: 1px solid black;"id="gain_{{ $index + 1 }}"></td>
  </tr>
  @endforeach
  @endif
  <tr align="center" >
    <td height="30" colspan="10" align="center" style="border: 1px solid black;">留仓总金额：<span id="span_lcmoney" class="money1">￥0.00</span></td>
    <td height="30" colspan="2" align="center" style="border: 1px solid black;">留仓盈亏小计：<br /></td>
    <td height="30" colspan="2" align="left" style="border: 1px solid black;"><span id="span_lcgain" class="money1"></span><br /></td>
  </tr>
</table>

<p>&nbsp;</p>
<p>&nbsp;</p>
@endsection