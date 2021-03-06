@extends('layouts.web_template')

@section('css')
<link href="/css/thickbox.css" rel="stylesheet" type="text/css" />
<link href="/css/style2.css" rel="stylesheet" type="text/css" />
<style>
  .mybox th {
    font-size:12px; font-weight:normal; color:#fff;
    padding:3px;  line-height:18px; font-size:12px;
  }
  .topth th{

  }
</style>
@endsection
@section('script')
<script type="text/javascript" src="/js/jquery1.3.2.js"></script>
<script type="text/javascript" src="/js/me_func_mob.js"></script>
<script type="text/javascript" src="/js/SuggestServer_3_0_16.js" charset="gb2312"></script>
<script type="text/javascript">
$(document).ready(function(){
	//股票查询事件
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

	GetUserFav();
	var interveltime = "3";
	var refresh = null;
	window.setInterval(function() {
		if (refresh == null)
		refresh = window.setInterval(function() { GetUserFav(); }, parseInt(interveltime, 10) * 1000);
	}, 10000);
});
</script>
@endsection
@section('content')
<form name="frmselforder" method="post" action="selforder.php" id="frmselforder"> 
    <table width="99%" align="center" cellpadding="3" cellspacing="1" style="margin-top:5px; border:1px solid #CCCCCC; height:35px;"> 
      <tr>
        <td align="left"><table cellpadding="0" cellspacing="0" style="font-size:12px; color:#fff; line-height:35px;">
          <tr>
            <td width="100" align="center"><input type="button" name="btn_delete" onClick="productDelete()" value="删除自选" class="button3" />
        &nbsp;&nbsp;</td>
            <td style="padding-right:5px;">类别：</td>
            <td id="tdstockstypename" style=" padding-right:5px;">
              <select name="select" id="ddlstockstypename" onchange="ChangeStocksbktypename(this.value)">
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
            <td style="padding-right:5px;">&nbsp;股票代码：</td>
            <td id="tdstocksname" style=" padding-right:5px;"><select name="select" id="ddlstocksno">
                <option value="">请选择</option>
            </select></td>
          <td width="80" align="right" id="tdstocksname" style=" padding-right:5px;">股票查询：</td>
            <td id="tdstocksname" style=" padding-right:5px;"><input name="stockcode" type="text" id="stockcode" value="代码/名称/拼音" size="20" maxlength="12" style="position:relative; " autocomplete="off" />
              <input name="button" id="btnAdd" type="button" class="button3" onclick="AddStock();" value="加入自选股" /></td>
          </tr>
        </table></td> 
      </tr> 
  </table> 
    <div id="divstockslist"> 
	  <span class="loading"><img src="" border="0" align="absmiddle" hspace="3" />加载中...</span>
    </div> 
  <div id="divstocks" style="display:none;"></div> 
</form> 
@endsection