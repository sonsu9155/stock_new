
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>股票代码列表</title>
<meta http-equiv="X-UA-Compatible" content="IE=7" />
<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no"/>
<link href="./style/style.css" rel="stylesheet" type="text/css" />
<style>
.mybox th {font-size:12px; font-weight:normal; color:#fff;}
.mybox td {padding:3px; line-height:18px; font-size:12px;}
DIV.sabrosus {
PADDING-RIGHT: 3px; PADDING-LEFT: 3px; PADDING-BOTTOM: 3px; MARGIN: 3px; PADDING-TOP: 3px; TEXT-ALIGN: center
}
DIV.sabrosus A {
BORDER-RIGHT: #9aafe5 1px solid; PADDING-RIGHT: 5px; BORDER-TOP: #9aafe5 1px solid; PADDING-LEFT: 5px; PADDING-BOTTOM: 2px; BORDER-LEFT: #9aafe5 1px solid; COLOR: #2e6ab1; MARGIN-RIGHT: 2px; PADDING-TOP: 2px; BORDER-BOTTOM: #9aafe5 1px solid; TEXT-DECORATION: none
}   
DIV.sabrosus A:hover {
BORDER-RIGHT: #2b66a5 1px solid; BORDER-TOP: #2b66a5 1px solid; BORDER-LEFT: #2b66a5 1px solid; COLOR: #000; BORDER-BOTTOM: #2b66a5 1px solid; BACKGROUND-COLOR: lightyellow
}   
DIV.pagination A:active {
BORDER-RIGHT: #2b66a5 1px solid; BORDER-TOP: #2b66a5 1px solid; BORDER-LEFT: #2b66a5 1px solid; COLOR: #000; BORDER-BOTTOM: #2b66a5 1px solid; BACKGROUND-COLOR: lightyellow
}
DIV.sabrosus SPAN.current {
BORDER-RIGHT: navy 1px solid; PADDING-RIGHT: 5px; BORDER-TOP: navy 1px solid; PADDING-LEFT: 5px; FONT-WEIGHT: bold; PADDING-BOTTOM: 2px; BORDER-LEFT: navy 1px solid; COLOR: #fff; MARGIN-RIGHT: 2px; PADDING-TOP: 2px; BORDER-BOTTOM: navy 1px solid; BACKGROUND-COLOR: #990000
}
DIV.sabrosus SPAN.disabled {
BORDER-RIGHT: #929292 1px solid; PADDING-RIGHT: 5px; BORDER-TOP: #929292 1px solid; PADDING-LEFT: 5px; PADDING-BOTTOM: 2px; BORDER-LEFT: #929292 1px solid; COLOR: #929292; MARGIN-RIGHT: 2px; PADDING-TOP: 2px; BORDER-BOTTOM: #929292 1px solid
}
</style>
<link href="../adm/skin/ymPrompt.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="./js/ymPrompt.js"></script>
<script type="text/javascript" src="./js/autostocks.js"></script>
<script type="text/javascript" src="./js/jquery1.3.2.js"></script>
<script type="text/javascript" src="./js/me_function.js"></script>
<script type="text/javascript" src="./js/SuggestServer_3_0_16.js" charset="gb2312"></script>
<script type="text/javascript">
var curpage = 1;
var pagesize = 30;
var totalrecord = 0;
var pagecount = 1;
var stype = '';
var stockcode = '';
var bkname = '';
var IsOpen = 0;
$(document).ready(function(){
	var suggestServer = new SuggestServer();
	suggestServer.bind({
		"input": "stockcode",
		"value": "@2@",
		"type": "",
		"max": 10,
		"width": 250,
		"head": ["选项", "代码", "中文名称"],
		"body": [-1, 2, 4],
	    "fix": { "ie6" : [0, - 1], "ie7" : [0, - 1], "firefox" : [1, 1]},
		"callback": null
	});
	$('#btnsearch1').bind('click',function(){
		stype = 'code';
		curpage = 1;
		stockcode = $('#stockcode').val();
		if(stockcode=='' || stockcode=='代码/名称/拼音')
		{
			alert('请输入股票代码!');
			$('#stockcode').focus();
			return false;
		}
		LoadStockList();
	});
	
	$('#btnsearch2').bind('click',function(){
		stype = 'bk';
		curpage = 1;
		bkname = $('#ddlstocksbktypename').val();
		if(bkname=='')
		{
			alert('请选择要查询的板块!');
			$('#ddlstocksbktypename').focus();
			return false;
		}
		LoadStockList();
	});
	$('#btnShowAll').bind('click',function(){
		stype = '';
		curpage = 1;
		LoadStockList();
	});
	
	$('#btnStopPai').bind('click',function(){
		stype = 'stop';
		curpage = 1;
		LoadStockList();
	});
	
	$('#btnFull').bind('click',function(){
		stype = 'full';
		curpage = 1;
		LoadStockList();
	});
	stype = 'empty';
	LoadStockList();
	parent.document.all("marinframe").style.height = document.body.scrollHeight;
});

function ShowOtherpage(page)
{
	curpage = page;
	LoadStockList();
}

function getpage()
{
	if(totalrecord==0)
	{ 
	$("#tdpage").html('');
	return;
	}
	if (totalrecord % pagesize == 0)
		pagecount = totalrecord / pagesize;
	else
		pagecount = parseInt(totalrecord / pagesize, 10) + 1;
	var spage = "";
	var first; 
	var pre;  
	var next; 
	var end;
	var currentlever,pvalue;	
	if (curpage > 1) {
		pvalue = curpage - 1;
		pre = "<a href=\"javascript:void(0);\" onclick=\"ShowOtherpage(" + pvalue + ")\"> < </a>";
		first = "<a href=\"javascript:void(0);\" onclick=\"ShowOtherpage(1)\"> << </a>";
	}
	else {
		pre = "<span class=\"disabled\"> < </span>";
		first = "<span class=\"disabled\"> << </span>";
	}
	if (curpage == pagecount) {
		next = "<span class=\"disabled\"> > </span>";
		end = "<span class=\"disabled\"> >> </span>";
	}
	else {
		pvalue = curpage + 1;
		next = "<a href=\"javascript:void(0);\" onclick=\"ShowOtherpage(" + pvalue + ")\"> > </a>";
		end = "<a href=\"javascript:void(0);\" onclick=\"ShowOtherpage(" + pagecount + ")\"> >> </a>";
	}
	if (Math.floor(curpage / 10) == 0) {
		currentlever = Math.floor(curpage / 10);
	}
	else {
		if (curpage % 10 == 0) {
			currentlever = Math.floor(curpage / 10) - 1;
		}
		else {
			currentlever = Math.floor(curpage / 10);
		}
	}
	spage = "";
	if (curpage <= pagecount) {
		for (p = 1; p <= 10; p++) {
			value = p + currentlever * 10;
			if (value > pagecount)
				break;
			if (curpage == value) {
				spage += "<span class=\"current\">" + value + "</span>"
			}
			else {
				spage += "<a href=\"javascript:void(0);\" onclick=\"ShowOtherpage(" + value + ")\">" + value + "</a>";
			}
		}
	}
	var countstr = "&nbsp;共&nbsp;" + totalrecord + " 条&nbsp;&nbsp;第&nbsp;" + curpage + "/" + pagecount + "&nbsp;页&nbsp;&nbsp;";
	var pagestr = "<div class=\"sabrosus\"><span>" + countstr + "</span>" + first + pre + spage + next + end + "</div>";
	$("#tdpage").html(pagestr);
}

function LoadStockList()
{
	var loading = '<span style="text-align:center; height:50px; line-height:50px; color:gray;"><img src="" border="0" align="absmiddle" hspace="3" />加载中…</span>';
	totalrecord = 0;
	var nothing = '<tr bgcolor="#ffffff"><td height="50" align="center" class="gray" colspan="9">暂无符合条件的记录！</td></tr>';
	var res = '<table width="100%" cellspacing="1" cellpadding="3" class="mybox" bgcolor="#cccccc">';
	res += '<tr align="center"><th width="3%">序号</th>'+
	'<th width="5%">代码</th>'+
	'<th>名称</th><th>最新价</th><th>成交量(手)</th><th>涨跌</th><th>买价</th><th>卖价</th><th>开盘价</th><th>最高价</th><th>最低价</th><th>昨收价</th>'	
	+'<th width="8%">状态</th><th>机构通道费</th><th width="15%">操作</th></tr>';

	$('#tdstocklist').html(loading);
	getpage();
	goUrl = 'ajax.php?type=stocklist&stype=' + stype + '&page=' + curpage + '&pagesize=' + pagesize + '&stockcode=' + stockcode + '&bkname=' + bkname;
        console.log(goUrl );
	$.ajax({
		type: 'GET',
		url: goUrl,
		success:function(html)
		{
    
			data = html.split('^');
			if(data.length==3)
			{
				totalrecord = parseInt(data[0]);
				curtotalrecord = parseInt(data[1]);
				if(curtotalrecord>0)
				{
					stocklist = data[2].split('$');
					for(i=0;i<stocklist.length;i++)
					{
						stock = stocklist[i].split('|');
						bk_list =stock[10];
						stop_pai = stock[4]=='1' ? '<font color=red>停牌</font>' : '正常';
						if(bk_list && bk_list.substring(0,1)==',')
						{
							bk_list = bk_list.substring(1);
						}
						bgcolor = (i+1) % 2 ==0 ? '#3f4042' : '#57595d';
						res += '<tr align="center" bgcolor="' + bgcolor + '" onMouseOver="this.style.background=\'#152950\';" onMouseOut="this.style.background=\'' + bgcolor + '\';"><td>' + ((curpage-1)*pagesize + i+1) + '</td><td>' + stock[0] + '</td>'+
							stock[11]+ '<td>' + stop_pai + '</td>'+'<td style="color:red">' + stock[7] + '‰</td>'+
							'<td><input type="button" name="collect" value="加入自选" class="button3" onClick="return AddStock1(\'' + stock[0] + '\');" />&nbsp;<input type="button" name="order" value="下单" onClick="location.href=\'order.php?do=order&stockcode=' + stock[0] + '\';" class="button3"' + (IsOpen==0 ? ' disabled':'') + ' /></td></tr>';
					}			
					getpage();
				}
				else
				{
					res += nothing;
					getpage();
				}
			}
			else
			{
				res += nothing;
				getpage();
			}
			res += '</table>';
			$('#tdstocklist').html(res);
			parent.document.all("marinframe").style.height = document.body.scrollHeight;
		}
	});
}
</script>
</head>
<style>
	#tdstocklist tr td:nth-child(3){
		color: #F0F888;
	}
	#tdstocklist tr td:nth-child(2){
		color: #F0F888;
	}
	#tdstocklist tr td:nth-child(4){
		color: #01DAEB;
	}
	#tdstocklist tr td:nth-child(6){
		color: red;
	}
</style>
<body > 
	<form name="form1" method="post" action="">
  <table width="98%" align="center" cellpadding="1" cellspacing="1" style="margin-top:5px;">
    <tr>
      <td align="left" style="border:1px solid #3f4042; height:35px;">&nbsp;股票代码查询：
          <input name="stockcode" type="text" id="stockcode" value="代码/名称/拼音" size="20" maxlength="12" style="position:relative; " autocomplete="off" />
          <input name="button" type="button" id="btnsearch1" value="查 询" class="button3" />          
          <input name="btnShowAll" type="button" id="btnShowAll" value="显示全部" class="button3" />
          <input name="btnStopPai" type="button" id="btnStopPai" value="停牌股" class="button3">
          <input name="btnFull" type="button" id="btnFull" value="满仓股" class="button3"> 
      </td>
    </tr>
    <tr>
      <td align="left" style="padding-left:5px; height:35px; border:1px solid #3f4042;" hidden="hidden">
        <table cellpadding="0" cellspacing="0" style="font-size:12px;">
          <tr>
            <td style="padding-right:5px;">按板块查询</td>
            <td style="padding-right:5px;">类别：</td>
            <td id="tdstockstypename" style=" padding-right:5px;">
              <select name="select" id="ddlstockstypename" onChange="ChangeStocksbktypename(this.value)">
                <option value="">请选择</option>
                <option value="地域">地域</option>
                <option value="概念">概念</option>
                <option value="其它板块">其它板块</option>
                <option value="行业">行业</option>
                <option value="证监会行业">证监会行业</option>
                <option value="指数板块">指数板块</option>
              </select>
            </td>
            <td style=" padding-right:5px;">&nbsp;板块：</td>
            <td id="tdstocksbktypename" style=" padding-right:5px;"><select name="select" id="ddlstocksbktypename">
                <option value="">请选择</option>
            </select></td>
          <td id="tdstocksbktypename" style=" padding-right:5px;"><input type="button" name="btnsearch2" id="btnsearch2" value="查 询" class="button3" /></td>
          </tr>
      </table>
	  
	  </td>
    </tr>
  </table>
  <table width="98%"  border="0" align="center" cellpadding="1" cellspacing="1">
    <tr align="center" >
      <td colspan="9" id="tdstocklist">加载中…</td>
    </tr>
    <tr align="center" >
      <td colspan="9" id="tdpage">&nbsp;</td>
    </tr>
  </table>
<p>&nbsp;</p>
<p>&nbsp;</p>
</form>
</body>
</html>
<link href="./style/style2.css" rel="stylesheet" type="text/css" />