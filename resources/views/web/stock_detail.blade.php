
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>股票代码列表</title>
	<meta http-equiv="X-UA-Compatible" content="IE=7" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no"/>
	<script type="text/javascript" src="/js/autostocks.js"></script>
	<script type="text/javascript" src="/js/jquery1.3.2.js"></script>
	<script type="text/javascript" src="/js/jquery-1.10.2.min.js"></script>
	<script type="text/javascript" src="/js/me_function.js"></script>
	<script type="text/javascript" src="/js/SuggestServer_3_0_16.js" charset="gb2312"></script>
	<link href="/css/style2.css" rel="stylesheet" type="text/css" />
</head>
<body >

<script>
	$(function(){
		
		rz();
		
		$('.sxsx,img').fadeTo(0,0);
		
		$('img').fadeTo(3000,1);
		$('.loading').fadeOut(3000);
		setTimeout("$('.sxsx').fadeTo(1000,1);",1200);
		var id = getUrlParam('id');
	
		var furl = 'https://quotes.sina.cn/hs/company/quotes/view/'+id+'/?from=wap';
		$('.sxsx').attr('src',furl);
		var furl = 'https://image.sinajs.cn/newchart/min/n/'+id+'.gif';
		$('.k1').attr('src',furl);
		var furl = 'https://image.sinajs.cn/newchart/daily/n/'+id+'.gif';
		$('.k2').attr('src',furl);
		var furl = 'https://image.sinajs.cn/newchart/weekly/n/'+id+'.gif';
		$('.k3').attr('src',furl);
		var furl = 'https://image.sinajs.cn/newchart/monthly/n/'+id+'.gif';
		$('.k4').attr('src',furl);

	});

	$(window).resize(function(){
		rz();
	});

	function rz(){
		$('.sxsx').height( $('.sxsx').width() / 2 );
	}
	function getUrlParam(name) {
		var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"); 
		var r = window.location.search.substr(1).match(reg); 
		if (r != null) return unescape(r[2]); return null; 
	}

</script>

<style>
	.img_ddd{
		float: left;
	}
</style>

<br>

<br>
<br>
<div class="loading" style="position: absolute; top: 20%; left: 48%">K线加载中...</div>
<iframe scrolling="no" width="100%" class="sxsx"></iframe>
<div class="img_ddd">
	分时线：<br>
	<img class="k1">
</div>
<div class="img_ddd">
	日K线：<br>
	<img class="k2">
</div>
<div class="img_ddd">
	月K线：<br>
	<img class="k3">
</div>
<div class="img_ddd">
	周K线：<br>
	<img class="k4">
</div>
</body>
</html>

