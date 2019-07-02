@extends('layouts.web_template')
@section('css')
<link href="/css/style2.css" rel="stylesheet" type="text/css" />
@endsection
@section('script')
<script type="text/javascript" src="/js/noright.js"></script>
@endsection
@section('content')
<table width="99%"  border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC" class="mybox">
  <tr> 
    <th colspan="8" class="text-center" style="border: 1px solid black;">入金记录</th> 
  </tr> 
  <tr align="center" bgcolor="#3f4042"> 
    <td width="15%" style="text-align: center;border: 1px solid black;">日期</td> 
    <td width="15%" style="text-align: center;border: 1px solid black;">订单号</td> 
    <td width="8%" style="text-align: center;border: 1px solid black;">类型</td> 
    <td width="15%" style="text-align: center;border: 1px solid black;">流水号</td> 
    <td width="15%" style="text-align: center;border: 1px solid black;">通道</td> 
    <td width="10%" style="text-align: center;border: 1px solid black;">金额</td> 
    <td width="10%" align="center" style="text-align: center;border: 1px solid black;">状态</td> 
    <td style="text-align:center; border: 1px solid black;">备注</td>
  </tr> 
  @if($deposite_histories)
    @foreach($deposite_histories as $index => $deposite_history)
      <tr align="center" bgcolor="#3f4042" onMouseOver="this.style.background='#3f4042';" onMouseOut="this.style.background='#3f4042';"> 
        <td style="text-align: center;border: 1px solid black;">{{ $deposite_history->created_at }}</td> 
        <td style="text-align: center;border: 1px solid black;">{{ $deposite_history->id }}</td> 
        <td style="text-align: center;border: 1px solid black;">入金</td> 
        <td style="text-align: center;border: 1px solid black;">-</td> 
        <td style="text-align: center;border: 1px solid black;">-</td> 
        <td style="text-align: center;border: 1px solid black;">￥{{ $deposite_history->amount }}&nbsp;</td> 
        <td align="center" style="text-align: center;border: 1px solid black;"><font color="gray">{{ $deposite_history->status }}</font></td> 
        <td style="text-align: center;border: 1px solid black;">-</td>
      </tr>
    @endforeach
  @endif
</table>
@endsection