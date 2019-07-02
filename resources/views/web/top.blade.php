
<!DOCTYPE html >
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>顶部</title>
	<meta http-equiv="X-UA-Compatible" content="IE=7" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no"/>
	<link href="./style/style.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript">
		var stocksVal,stocksCookieVal,mid,freeID,freeNAME,buylistID,st;
		var stockType=0;
		var stockOpen=0;
		var num_min=10;
		var news_s,userinf_s,get_stock,get_buy,show_s,user_cs;
		var sverDATE= new Date("Sun May 12 17:01:02 HKT 2019"); 
	</script>
	<script type="text/javascript" src="./js/jquery1.3.2.js"></script>
	<script type="text/javascript" src="./js/ymPrompt.js"></script>
	<script type="text/javascript" src="./js/me_function.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			news("#news");
			refresh_index();
		});
	</script>
	<base target="mainFrame" />
</head>
<body>
	<div id="sound_msg" style="display:none"></div>
	<div id="sound_bc" style="display:none;"></div>


	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td height="25" background="images/topbar.gif"><div id="all_count"><div id="load_text"></div>
				<table border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td height="22" nowrap="nowrap">
							<span id="open" style="color:#FF0000;"></span>&nbsp;&nbsp;</td>
							<td height="22" nowrap="nowrap"><div id="dpName_0"></div></td>
							<td height="22" align="right" nowrap="nowrap"><div id="dpCurr_0">..</div></td>
							<td height="22" align="right" nowrap="nowrap"><div id="dpDiff_0">..</div></td>
							<td height="22" align="right" nowrap="nowrap"><div id="dbPoint_0">..</div></td>
							<td height="22" align="center" nowrap="nowrap"><div id="dp_turnover_0">..</div></td>
							<td height="22" nowrap="nowrap"><div id="dpName_1"></div></td>
							<td height="22" align="right" nowrap="nowrap"><div id="dpCurr_1">..</div></td>
							<td height="22" align="right" nowrap="nowrap"><div id="dpDiff_1">..</div></td>
							<td height="22" align="right" nowrap="nowrap"><div id="dbPoint_1">..</div></td>
							<td height="22" align="center" nowrap="nowrap"><div id="dp_turnover_1">..</div></td>
						</tr>
					</table>
				</div></td>
				<td background="images/topbar.gif">	<div id="news"> 
					<ul> 
						<li>[2018-10-16 10:00:26]两市股票均可正常交易</li> 
					</ul> 
				</div> 
			</td>
		</tr>
	</table>



	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="top"> 
		<tr>
			<td width="280px" style='margin-right: 100px;'><img src="./images/stock_buy.png" style='width: 280px; margin-left: 20px;
			margin-right: 100px;
			'/></td>
				<td >
					<table class="nav_ico">
						<tr>

							<td align="center">
								<a href="operate.php" target="stockMain"><img src="./images/10.jpg" /><br>银证转账</a>
							</td>
							<td align="center">
								<a href="stock_lists2.php" target="stockMain"><img src="./images/1.png" /><br>沪深A股</a>
							</td>
							<td align="center">
								<a href="selforder.php" target="stockMain"><img src="./images/3.png" /><br>自选股票</a>
							</td>
							<td align="center">
								<a href="order.php" target="stockMain"><img src="./images/4.png" /><br>快速下单</a>
							</td>
							<td align="center">
								<a href="entrust.php" target="stockMain"><img src="./images/5.png" /><br>委托单</a>
							</td>
							<td align="center">
								<a href="deal.php" target="stockMain"><img src="./images/7.png" /><br>持仓单</a>
							</td>
							<td align="center">
								<a href="entrust_search.php" target="stockMain"><img src="./images/8.png" /><br>当日委托</a>
							</td>
							<td align="center">
								<a href="user.php" target="stockMain"><img src="./images/9.png" /><br>交易账户</a>
							</td>
							<td align="center">
								<a href="javascript:void(0);" target="_top" onclick="if(confirm('确定要退出登录吗？')){top.location.href='login_from.php?type=logout&client=false';return false;}else{return false;}"><img src="./images/6.png" /><br>退出登录</a>
							</td>
							<td >
								<div  style='margin-left: 40px;'>
									
								</div>
							</td>
							<td >
								<div >
									<div id="clock">  
										<p class="date">{{ date }}</p>  
										<p class="time">{{ time }}</p>  
									</div> 
								</div>
							</td>
						</tr>
					</table>
				</td> 
			</tr> 
		</table> 

	</body>
	</html>
	<style type="text/css">  
	#clock {  
		font-family: 'Microsoft YaHei','Lantinghei SC','Open Sans',Arial,'Hiragino Sans GB','STHeiti','WenQuanYi Micro Hei','SimSun',sans-serif;  
		color: #ffffff;  
		text-align: center;  
		color: #daf6ff;  
		text-shadow: 0 0 20px #0aafe6, 0 0 20px rgba(10, 175, 230, 0);  
	}  
	#clock .time {  
		letter-spacing: 0.05em;  
		font-size: 20px;  
		padding: 5px 0;  
	}  
	#clock .date {  
		letter-spacing: 0.1em;  
		font-size: 20px;  
	}  
	#clock .text {  
		letter-spacing: 0.1em;  
		font-size: 12px;  
		padding: 20px 0 0;  
	}  
</style>  


<body>  
	<script type="text/javascript" src="./js/vue.js"></script>  
	<script type="text/javascript">  
		var clock = new Vue({  
			el: '#clock',  
			data: {  
				time: '',  
				date: ''  
			}  
		});  
		var week = ['星期日', '星期一', '星期二', '星期三', '星期四', '星期五', '星期六'];  
		var timerID = setInterval(updateTime, 1000);  
		updateTime();  
		function updateTime() {  
			var cd = new Date();  
			clock.time = zeroPadding(cd.getHours(), 2) + ':' + zeroPadding(cd.getMinutes(), 2) + ':' + zeroPadding(cd.getSeconds(), 2);  
			clock.date =  week[cd.getDay()];  
		};  
		function zeroPadding(num, digit) {  
			var zero = '';  
			for(var i = 0; i < digit; i++) {  
				zero += '0';  
			}  
			return (zero + num).slice(-digit);  
		}  
	</script>  
	<style>
	#time_new{
		margin:0px auto;
		text-align:center;
		box-shadow:5px 5px 2px 2px #abcdef inset;
		border:none;
	}
	.nav_ico img{
		width:50px;
	}

	.nav_ico a{
		color:#fff;
		display:block;
		margin-left:30px;
	}

	.nav_ico a:hover{
		color:red;
	}
</style>


