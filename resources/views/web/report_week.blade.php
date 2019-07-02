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
	$("#txt_date").date_input();
});
</script>
@endsection

@section('content')
<table width="98%" align="center" cellpadding="3" cellspacing="1" bgcolor="#3f4042" style="margin-top:5px;border:1px solid #CCCCCC;">
  
</table>
<table width='98%' border='0' align="center" cellpadding='3' cellspacing='1' class="mybox">
  <tr align='center'>
    <th width="12%" class="text-center" style="border: 1px solid black;">星期</th>
    <th width="12%" class="text-center" style="border: 1px solid black;">结帐日期</th>
    <th width="12%" class="text-center" style="border: 1px solid black;">交易量</th>
    <th width="12%" class="text-center" style="border: 1px solid black;">留仓量</th>
    <th width="12%" class="text-center" style="border: 1px solid black;">手续费</th>
    <th width="12%" class="text-center" style="border: 1px solid black;">留仓费</th>
    <th width="12%" class="text-center" style="border: 1px solid black;">盈亏</th>
    <th width="12%" class="text-center" style="border: 1px solid black;">操作</th>
  </tr>
  <tr align='center' bgcolor="#3f4042" onMouseOver="this.style.background='#3f4042';" onMouseOut="this.style.background='#3f4042';">
    <td style="border: 1px solid black;">星期一</td>
    <td style="border: 1px solid black;">{{ $start_day->copy()->format('Y-m-d')  }}</td>
    <td style="border: 1px solid black;">{{ $data[0]['amount'] }}</td>
    <td style="border: 1px solid black;">{{ $data[0]['position'] }}</td>
    <td style="border: 1px solid black;">{{ $data[0]['fee'] }}</td>
    <td style="border: 1px solid black;">{{ $data[0]['position_fee'] }}</td>
    <td style='border: 1px solid black;'>{{ $data[0]['rise'] }}</td>
    <td style="border: 1px solid black;"><a href="/web/report_day">详情</a></td>
  </tr>
  <tr align='center' bgcolor="#3f4042" onMouseOver="this.style.background='#3f4042';" onMouseOut="this.style.background='#3f4042';">
    <td style="border: 1px solid black;">星期二</td>
    <td style="border: 1px solid black;"> {{ $start_day->copy()->addDay(1)->format('Y-m-d')  }}</td>
    <td style="border: 1px solid black;">{{ $data[1]['amount'] }}</td>
    <td style="border: 1px solid black;">{{ $data[1]['position'] }}</td>
    <td style="border: 1px solid black;">{{ $data[1]['fee'] }}</td>
    <td style="border: 1px solid black;">{{ $data[1]['position_fee'] }}</td>
    <td style='border: 1px solid black;'>{{ $data[1]['rise'] }}</td>
    <td style="border: 1px solid black;"><a href="/web/report_day">详情</a></td>
  </tr>
  <tr align='center' bgcolor="#3f4042" onMouseOver="this.style.background='#3f4042';" onMouseOut="this.style.background='#3f4042';">
    <td style="border: 1px solid black;">星期三</td>
    <td style="border: 1px solid black;">{{ $start_day->copy()->addDay(2)->format('Y-m-d') }}</td>
    <td style="border: 1px solid black;">{{ $data[2]['amount'] }}</td>
    <td style="border: 1px solid black;">{{ $data[2]['position'] }}</td>
    <td style="border: 1px solid black;">{{ $data[2]['fee'] }}</td>
    <td style="border: 1px solid black;">{{ $data[2]['position_fee'] }}</td>
    <td style='border: 1px solid black;'>{{ $data[2]['rise'] }}</td>
    <td style="border: 1px solid black;"><a href="/web/report_day">详情</a></td>
  </tr>
  <tr align='center' bgcolor="#3f4042" onMouseOver="this.style.background='#3f4042';" onMouseOut="this.style.background='#3f4042';">
    <td style="border: 1px solid black;">星期四</td>
    <td style="border: 1px solid black;">{{ $start_day->copy()->addDay(3)->format('Y-m-d') }}</td>
    <td style="border: 1px solid black;">{{ $data[3]['amount'] }}</td>
    <td style="border: 1px solid black;">{{ $data[3]['position'] }}</td>
    <td style="border: 1px solid black;">{{ $data[3]['fee'] }}</td>
    <td style="border: 1px solid black;">{{ $data[3]['position_fee'] }}</td>
    <td style='border: 1px solid black;'>{{ $data[3]['rise'] }}</td>
    <td style="border: 1px solid black;"><a href="/web/report_day">详情</a></td>
  </tr>
  <tr align='center' bgcolor="#3f4042" onMouseOver="this.style.background='#3f4042';" onMouseOut="this.style.background='#3f4042';">
    <td style="border: 1px solid black;">星期五</td>
    <td style="border: 1px solid black;">{{ $start_day->copy()->addDay(4)->format('Y-m-d') }}</td>
    <td style="border: 1px solid black;">{{ $data[4]['amount'] }}</td>
    <td style="border: 1px solid black;">{{ $data[4]['position'] }}</td>
    <td style="border: 1px solid black;">{{ $data[4]['fee'] }}</td>
    <td style="border: 1px solid black;">{{ $data[4]['position_fee'] }}</td>
    <td style='border: 1px solid black;'>{{ $data[4]['rise'] }}</td>
    <td style="border: 1px solid black;"><a href="/web/report_day">详情</a></td>
  </tr>
  <tr align='center' bgcolor="#3f4042" onMouseOver="this.style.background='#3f4042';" onMouseOut="this.style.background='#3f4042';">
    <td style="border: 1px solid black;"><font color=green>星期六<font></td>
    <td style="border: 1px solid black;">{{ $start_day->copy()->addDay(5)->format('Y-m-d') }}</td>
    <td style="border: 1px solid black;">{{ $data[5]['amount'] }}</td>
    <td style="border: 1px solid black;">{{ $data[5]['position'] }}</td>
    <td style="border: 1px solid black;">{{ $data[5]['fee'] }}</td>
    <td style="border: 1px solid black;">{{ $data[5]['position_fee'] }}</td>
    <td style='border: 1px solid black;'>{{ $data[5]['rise'] }}</td>
    <td style="border: 1px solid black;"><a href="/web/report_day">详情</a></td>
  </tr>
  <tr align='center' bgcolor="#3f4042" onMouseOver="this.style.background='#3f4042';" onMouseOut="this.style.background='#3f4042';">
    <td style="border: 1px solid black;"><font color=red>星期日</font></td>
    <td style="border: 1px solid black;">{{ $start_day->copy()->addDay(6)->format('Y-m-d') }}</td>
    <td style="border: 1px solid black;">{{ $data[6]['amount'] }}</td>
    <td style="border: 1px solid black;">{{ $data[6]['position'] }}</td>
    <td style="border: 1px solid black;">{{ $data[6]['fee'] }}</td>
    <td style="border: 1px solid black;">{{ $data[6]['position_fee'] }}</td>
    <td style='border: 1px solid black;'>{{ $data[6]['rise'] }}</td>
    <td style="border: 1px solid black;"><a href="/web/report_day">详情</a></td>
  </tr>
  <tr align='center' bgcolor="#3f4042" style="font-size:15px; font-weight:bold;">
    <td colspan="2" align="right" style="border: 1px solid black;">小计：</td>
    <td style="border: 1px solid black;">{{ $data[0]['amount'] + $data[1]['amount']+ $data[2]['amount']+ $data[3]['amount']+ $data[4]['amount']+ $data[5]['amount']+ $data[6]['amount'] }}</td>
    <td style="border: 1px solid black;">{{ $data[0]['position'] + $data[1]['position']+ $data[2]['position']+ $data[3]['position']+ $data[4]['position']+ $data[5]['position']+ $data[6]['position'] }}</td>
    <td style="border: 1px solid black;">{{ $data[0]['fee'] + $data[1]['fee']+ $data[2]['fee']+ $data[3]['fee']+ $data[4]['fee']+ $data[5]['fee']+ $data[6]['fee'] }}</td>
    <td style="border: 1px solid black;">{{ $data[0]['position_fee'] + $data[1]['position_fee']+ $data[2]['position_fee']+ $data[3]['position_fee']+ $data[4]['position_fee']+ $data[5]['position_fee']+ $data[6]['position_fee'] }}</td>
    <td style="border: 1px solid black;">{{ $data[0]['rise'] + $data[1]['rise']+ $data[2]['rise']+ $data[3]['rise']+ $data[4]['rise']+ $data[5]['rise']+ $data[6]['rise'] }}</td>
    <td style="border: 1px solid black;">-</td>
  </tr>
</table>
@endsection