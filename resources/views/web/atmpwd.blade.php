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
     $("#pwdform").validate({
      rules: {
       oldpwd: { required:true },
       password_confirm: {
        required: true,
        rangelength: [6, 20],
        atmpwd: {required:true, number:true, rangelength:[4,4]},
        equalTo: "#password"
      }
    },
    messages: {
     oldpwd: { required: "[<b>旧密码</b>]:不能为空."},
     password_confirm: {
      required: "[<b>确认密码</b>]:不能为空.",
      rangelength:{required: "[<b>旧资金密码</b>]必须输入.",number:"[<b>旧资金密码</b>]必须是数字.",rangelength:"[<b>旧资金密码</b>]只能是4位."},
      atmpwd:{required: "[<b>资金密码</b>]必须输入.",number:"[<b>资金密码</b>]必须是数字.",rangelength:"[<b>资金密码</b>]只能是4位."},
      equalTo: "[<b>新密码</b>] 与 [<b>确认密码</b>] 不一致,请重新输入."

    }
  },
		submitHandler: function(form) {
			document.pwdform.submit();
		}
	});
   });
 </script>
@endsection
@section('content')
  <form id="pwdform" name="pwdform" action="/web/save_atmpwd" method="post">
  {{ csrf_field() }}
      <table width="99%"  border="0" align="center" cellpadding="3" cellspacing="1" class="mybox">
        <tr>
          <th colspan="2" class = " text-center">修改资金密码</th>
        </tr>
        <tr>
          <td width="20%" height="20" align="right" bgcolor="#3f4042">交易账户：</td>
          <td bgcolor="#3f4042" class="gray">{{ $user->username }}</td>
        </tr>
        <tr>
          <td height="20" align="right" bgcolor="#3f4042">旧资金密码：</td>
          <td bgcolor="#3f4042" class="gray"><input name="oldpwd" type="password" id="oldpwd" size="20">
          <span class="gray">(请输入旧资金密码)</span> </td>
        </tr>
        <tr>
          <td height="20" align="right" bgcolor="#3f4042">资金密码：</td>
          <td bgcolor="#3f4042" class="gray"><input name="atmpwd" type="password" id="atmpwd" value="" size="4" maxlength="4" />
          <span class="gray">(需4位数字)</span> </td>
        </tr> 
        <tr>
          <td height="20" align="right" bgcolor="#3f4042">&nbsp;</td>
          <td bgcolor="#3f4042" class="gray"><input type="submit" name="Submit" value="修改资金密码" class="button3"></td>
        </tr>
      </table>
    </form>
@endsection