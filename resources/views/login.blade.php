<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no"/>
	<title>财智通</title>
	<link rel="stylesheet" href="/css/base.css">
	<link rel="stylesheet" href="/css/style.css">
	<script type="text/javascript" src="/js/noright.js"></script>
	<script type="text/javascript">
		function changeImg(){
			var a=document.getElementById("validateImg");
			a.src='validate.php?'+Math.random();
		}
		function loginSub()
		{
            window.alert = function(name){
                var iframe = document.createElement("IFRAME");
                iframe.style.display="none";
                iframe.setAttribute("src", 'data:text/plain');
                document.documentElement.appendChild(iframe);
                window.frames[0].window.alert(name);
                iframe.parentNode.removeChild(iframe);
            }
			var username = document.loginForm.username.value;
			var password = document.loginForm.password.value;
			var validate = document.loginForm.validate.value;
			console.log(validate);
			if(username == null || username == '' || username.length ==0){
				alert("用户名不能为空");
				document.loginForm.username.select();
				return false;
			}
			else if(password == null || password == '' || password.length ==0){
				alert("密码不能为空");
				document.loginForm.password.select();
				return false;
			}
			else if(validate == null || validate == '' || validate.length ==0){
				alert("请输入验证码");
				document.loginForm.validate.select();
				return false;
			}	
			document.loginForm.submit();
		}
		function usernamechange() {
			var a=document.getElementById("username").value.slice(0,1);
			if(a == 'x'){
				document.getElementById('usertype2').checked=true;
			}else{
				document.getElementById('usertype1').checked=true;
			}
		}
	</script>
	<script language="JavaScript"> 
		if (window != top) 
			top.location.href = location.href; 
	</script>
</head>
<body>
	<div class="bg"></div>
	<div class="container">
		<div class="line bouncein">
			<div class="xs6 xm4 xs3-move xm4-move">
				<div style="height:150px;"></div>
				<div class="media media-y margin-big-bottom">
				</div>
				<form id="loginForm" name="loginForm" action="login_from.php?type=login" method="post">
					<div class="panel loginbox">
						<div class="text-center margin-big padding-big-top">
							<h1>财智通</h1>
						</div>
						<div class="panel-body" style="padding:30px; padding-bottom:10px; padding-top:10px;">
							<div class="form-group">
								<div class="field field-icon-right">
									<input type="text" class="input input-big" id="username" name="username"  value='' placeholder="交易账户">
									<span class="icon icon-user margin-small"></span>
								</div>
							</div>
							<div class="form-group">
								<div class="field field-icon-right">
									<input type="password" class="input input-big" id="password" name="password"  value='' placeholder="登录密码">

									<span class="icon icon-key margin-small"></span>
								</div>
							</div>
							<div class="form-group">
								<div class="field">
									<input name="client" type="hidden" id="client" value="false" /> </td>
									<input type="text" class="input input-big" id="validate" name="validate" placeholder="填写右侧的验证码">
									<img align="middle" id="validateImg" name="validateImg" src="validate.php" width="100" height="32" class="passcode" style="height:43px;cursor:pointer;"  onclick="changeImg();">
								</div>
							</div>
							<div class="form-group">
								<div class="field">
									<input style="display:inline-block;width:10%" type="checkbox" value="1" name="cookieuser">记住账号密码
								</div>
							</div>
						</div>
						<div style="padding:30px;">
							<input type="button" id="submitbutton" name="submitbutton"  onclick="loginSub();" class="button button-block bg-main text-big input-big" value="登录">
							
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</html>