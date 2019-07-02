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
      <th colspan="7" class="text-center">公告大厅</th> 
    </tr> 
    <tr bgcolor="#3f4042">
      <td width="10%" align="center" style="border: 1px solid black;">公告编号</td>
      <td width="16%" align="center" style="border: 1px solid black;">公告日期</td>
      <td width="74%" align="center" style="border: 1px solid black;">公告内容</td>
    </tr>
    @if($news)
    @foreach($news as $new)
    <tr bgcolor="#3f4042">
      <td align="center">{{ $new->subject }}</td>
      <td align="center">{{ $new->created_at }}</td>
      <td align="center">{{ $new->contents }}</td>
    </tr>
    @endforeach
    @endif
  </table>
@endsection