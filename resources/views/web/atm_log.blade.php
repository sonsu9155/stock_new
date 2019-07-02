@extends('layouts.web_template')

@section('css')
<link href="/css/style2.css" rel="stylesheet" type="text/css" />
@endsection

@section('script')
<script type="text/javascript" src="/js/noright.js"></script>
@endsection

@section('content')
<div style="color: #010000;">
  <table width="99%"  border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC" class="mybox" > 
    <tr> 
      <th colspan="8" class="text-center" style="border: 1px solid black;">出金记录</th> 
    </tr> 
    <tr align="center" bgcolor="#C5E2FB" style="border: 1px solid black;"> 
      <td style="border: 1px solid black;">提交日期</td> 
      <td style="border: 1px solid black;">金额</td> 
      <td style="border: 1px solid black;">银行</td> 
      <td style="border: 1px solid black;">开户行</td>
      <td style="border: 1px solid black;">帐号/姓名</td> 
      <td style="border: 1px solid black;">状态</td> 
      <td style="border: 1px solid black;">处理时间</td>
    </tr> 
    @if($withdraw_histories)
    @foreach($withdraw_histories as $index => $withdraw_history)
      <tr align="center" bgcolor="#ffffff" onMouseOver="this.style.background='#FDF0D7';" onMouseOut="this.style.background='#FFFFFF';"> 
        <td style="border: 1px solid black;">{{ $withdraw_history->created_at }}</td> 
        <td style="border: 1px solid black;">￥{{ $withdraw_history->amount }}</td> 
        <td style="border: 1px solid black;">{{ $withdraw_history->bank }}</td> 
        <td style="border: 1px solid black;">{{ $withdraw_history->bank_name }}</td> 
        <td style="border: 1px solid black;">{{ $withdraw_history->user->bank_card }}&nbsp;{{ $withdraw_history->user->name }}</td> 
        <td style="border: 1px solid black;"><font color=red>{{ $withdraw_history->status }}</font></td> 
        <td style="border: 1px solid black;">{{ $withdraw_history->updated_at }}</td>
      </tr> 
    @endforeach
    @endif
  </table> 
</div>
@endsection