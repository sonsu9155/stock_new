@extends('layouts.web_template')

@section('css')
<link href="/css/tip-violet.css" rel="stylesheet" type="text/css" />
<link href="/css/style2.css" rel="stylesheet" type="text/css" />
@endsection

@section('script')
  <script type="text/javascript" src="/js/jquery-1.4.2.min.js"></script>
  <script type="text/javascript" src="/js/jquery.poshytip.js"></script>
  <script type="text/javascript" src="/js/jquery.validate.js"></script>
  <script type="text/javascript" src="/js/noright.js"></script>
  <script type="text/javascript"> 
    $(document).ready(function() {
        $('#tips_cancash,#tips_frozencash,#tips_realname,#tips_atmpwd,#tips_saveday,.tips_class').poshytip({
          className: 'tip-violet',
          bgImageFrameSize: 9
        });
        $("#regform").validate({
            rules: {
              mobile: {required:true, number:true, maxlength:11},
              atmpwd: {required:true, number:true, rangelength:[4,4]},
              id_card: {required:true, maxlength:11},
              bank_card: {required:true}
            },
            messages: {
              mobile:{required: "[<b>手机号码</b>]必须输入.", number:"[<b>手机号码</b>]必须是数字.",maxlength:"[<b>手机号码</b>]只能是11位."},
              atmpwd:{required: "[<b>资金密码</b>]必须输入.",number:"[<b>资金密码</b>]必须是数字.",rangelength:"[<b>资金密码</b>]只能是4位."},
              id_card:{required: "[<b>身份证号码</b>]必须输入.",maxlength:"[<b>身份证号码</b>]只能是18位."}, 
              bank_card:{required: "[<b>银行卡号码</b>]必须输入." },
            submitHandler: function(form) {
              document.regform.submit();
            }
          };
        });
    });
</script>
@endsection
@section('content')
<form id="regform" name="regform" action="user.php?type=save" method="post">
    <table width="99%"  border="0" align="center" cellpadding="3" cellspacing="1" class="mybox">
      <tr>
        <th colspan="4" style="text-align: center;border: 1px solid black;">账户信息</th>
      </tr>
      <tr>
        <td width="20%" height="20" align="right" bgcolor="#3f4042" style="text-align: center;border: 1px solid black;">交易账户：</td>
        <td width="30%" bgcolor="#3f4042" class="gray" style="text-align: center;border: 1px solid black;">{{ $user->username }}</td>
        <td height="20" align="right" bgcolor="#3f4042" style="text-align: center;border: 1px solid black;">资金密码：</td>
        <td bgcolor="#3f4042" class="gray" style="text-align: center;border: 1px solid black;">****</td>
      </tr>
      <tr>
        <td height="20"  bgcolor="#3f4042" style="text-align: center; border: 1px solid black;">保 证 金：</td>
        <td bgcolor="#3f4042" class="gray" style="text-align: center;"><span class="money" >￥{{number_format($stock_wallet->before_amount -$fund_amount, 2) }}</span></td>
        <td align="right" bgcolor="#3f4042" style="text-align: center;border: 1px solid black;">可用保证金：</td>        
        <td bgcolor="#3f4042" class="gray" style="text-align: center;border: 1px solid black;">
          <span class="money">
            @if($money_wallet->before_amount >  $money_wallet->after_amount + $money_wallet->before_amount - $stock_wallet->after_amount -$fund_amount)
              ￥ 0
            @else
              ￥ {{ $money_wallet->after_amount - $stock_wallet->after_amount - $fund_amount}}
            @endif
          </span>
        </td>
      </tr>
      <tr>
        <td height="20" align="right" bgcolor="#3f4042" style="text-align: center;border: 1px solid black;">出金冻结金额：</td>
        <td bgcolor="#3f4042" class="gray" style="text-align: center;border: 1px solid black;">
          <span class="money">
            @if($money_wallet->before_amount > $money_wallet->after_amount + $money_wallet->before_amount - $stock_wallet->after_amount - $fund_amount)
              ￥ {{ $stock_wallet->after_amount + $fund_amount - $money_wallet->after_amount   }}
            @else
              ￥ 0
            @endif
          </span>
        </td>
        <td align="right" bgcolor="#3f4042" style="text-align: center;border: 1px solid black;">可买股票资金：</td>
        <td bgcolor="#3f4042" class="gray" style="text-align: center;border: 1px solid black;">
          <span class="money" style="float:center">
          @if(($money_wallet->after_amount + $money_wallet->before_amount)>($stock_wallet->after_amount+$stock_wallet->before_amount))          
          ￥{{ number_format( $money_wallet->after_amount - $fund_amount, 2) }}
          @else
          ￥{{ number_format( $money_wallet->after_amount - 10*$fund_amount, 2) }}
          @endif
          </span>
        </td>
      </tr>
      <tr>
        <td height="20" align="right" bgcolor="#3f4042" style="text-align: center;border: 1px solid black;">买入手续费：</td>
        <td bgcolor="#3f4042" class="gray" style="text-align: center;border: 1px solid black;">{{ $setting->cost_bull_max * 100 }} ‰</td>
        <td align="right" bgcolor="#3f4042" style="text-align: center;border: 1px solid black;">卖出手续费：</td>
        <td bgcolor="#3f4042" class="gray" style="text-align: center;border: 1px solid black;">{{ $setting->cost_sell_max  * 100 }}‰</td>
      </tr>
      <tr>
        <td height="20" align="right" bgcolor="#3f4042" style="text-align: center;border: 1px solid black;">留仓费：</td>
        <td bgcolor="#3f4042" class="gray" style="text-align: center;border: 1px solid black;">{{ $setting->cost_save_max * 100 }} ‰/ 天</td>
        <td align="right" bgcolor="#3f4042" style="text-align: center;border: 1px solid black;">最大留仓天数：</td>
        <td bgcolor="#3f4042" class="gray" style="text-align: center;border: 1px solid black;"><span style="line-height:22px;">{{ $setting->cost_save_day }}天</span></td>
      </tr>
      <tr>
        <td height="20" align="right" bgcolor="#3f4042" style="text-align: center;border: 1px solid black;">印花税：</td>
        <td bgcolor="#3f4042" class="gray" style="text-align: center;border: 1px solid black;">{{ $setting->cost_state_max * 100 }} ‰</td>
        <td align="right" bgcolor="#3f4042" style="text-align: center;border: 1px solid black;">利息：</td>
        <td bgcolor="#3f4042" class="gray" style="text-align: center;border: 1px solid black;"><span style="line-height:22px;">{{ $setting->cost_daily_max * 100 }} ‰/ 天</span></td>
      </tr>
      <tr>
        <td height="20" align="right" bgcolor="#3f4042" style="text-align: center;border: 1px solid black;">姓　名：</td>
        <td bgcolor="#3f4042" class="gray" style="text-align: center;border: 1px solid black;"><span style=" line-height:22px;">{{ $user->name }}</span></td>
        <td height="20" align="right" bgcolor="#3f4042" style="text-align: center;border: 1px solid black;">身份证号码：</td>
        <td bgcolor="#3f4042" class="gray" style="text-align: center;border: 1px solid black;">{{ $user->idcard }}</td>
      </tr>
      <tr>
        <td height="20" align="right" bgcolor="#3f4042" style="text-align: center;border: 1px solid black;">银行名称：</td>
        <td bgcolor="#3f4042" class="gray" style="text-align: center;border: 1px solid black;">{{ $user->bank_name }}</td>
        <td align="right" bgcolor="#3f4042" style="text-align: center;border: 1px solid black;">银行卡号:</td>
        <td bgcolor="#3f4042" class="gray" style="text-align: center;border: 1px solid black;">{{ $user->bank_card }}</td>
      </tr>
      <tr>
        <tr>
          <td align="right" bgcolor="#3f4042" style="text-align: center;border: 1px solid black;">手机号码：</td>
          <td bgcolor="#3f4042" class="gray" style="text-align: center;border: 1px solid black;">{{ $user->phone }}</td>
          <td align="right" bgcolor="#3f4042" style="text-align: center;border: 1px solid black;"></td>
          <td bgcolor="#3f4042" class="gray" style="text-align: center;border: 1px solid black;"></td>
        </tr>
      </tr>
    </table>
  </form>
@endsection