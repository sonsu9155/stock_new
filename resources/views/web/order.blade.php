@extends('layouts.web_template')
@section('script')
<script type="text/javascript" src="/js/jquery1.3.2.js"></script>
<script type="text/javascript" src="/js/me_function.js"></script>
<script type="text/javascript" src="/js/ymPrompt.js"></script>
<script type="text/javascript" src="/js/SuggestServer_3_0_16.js" charset="gb2312"></script>
<script type="text/javascript">
	var IsOpen = 1;
	$(document).ready(function() {
		$.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
		//股票查询事件
		var suggestServer = new SuggestServer();
		suggestServer.bind({
			"input": "buy_code",
			"value": "@2@",
			"type": "",
			"max": 10,
			"width": 250,
			"head": ["选项", "代码", "中文名称"],
			"body": [-1, 2, 4],
			"fix": { "ie6" : [0, - 1], "ie7" : [0, - 1], "firefox" : [1, 1]},
			"callback": null
		});
		var initStockCode='000001';
		if(IsOpen==0) //休市
		{
			$('#buybox').attr('disabled','true');
			$(':input').attr('disabled','true');
			$('#ordertitle').html("休市中，不能买入股票");
		}
		else if(initStockCode!='0') //下单
		{
			$('#buy_code').val(initStockCode);
			getstockname();
		}
		
		$("#btnOk").click(function(){
			$('#btnOk').attr('disabled','true');
			$('#btnCancel').attr('disabled','true');
			var bull_code=$('#buy_code').val();
			var bull_name=$('#buy_name').text();
			var price_type=$("input[name='price_type']:checked").val();  
			var buy_type=$(":radio[name='buy_type']:checked").val();
			var bull_price=$('#buys_price').val();
			var bull_num=$('#bull_num').val();
			if(bull_code=='' || bull_code=='代码/名称/拼音')
			{
				ymPrompt.errorInfo({title:'下单',message:"请输入要买入的股票代码.",handler:function(){$('#buy_code').focus();}});
				$('#btnOk').attr('disabled','');
				$('#btnCancel').attr('disabled','');
				return false;
			}
			if(typeof(buy_type)=='undefined')
			{
				ymPrompt.errorInfo({title:'下单',message:"请选择要买入做多(多)或借券做空(空)."});
				$('#btnOk').attr('disabled','');
				$('#btnCancel').attr('disabled','');
				return false;
			}
			if(bull_num<1)
			{
				ymPrompt.errorInfo({title:'下单',message:"请输入买入数量.",handler:function(){$('#bull_num').focus();}});
				$('#btnOk').attr('disabled','');
				$('#btnCancel').attr('disabled','');
				return false;
			}
			if(bull_num>0 && bull_code){
				submitok();
			}
			return false;
		});
		
	});

	var kstr = 'min';
	function ShowStocksPic() {
		getProductKImage(kstr);
	}
	//取产品K线图
	function getProductKImage(kkstr) {
		var area_str = "sh";
		if (kkstr == "") { kstr = "min"; }
		else { kstr = kkstr; }
		var code = $("#buy_code").val();
		if (code.substring(0, 1) == "6")
		{ area_str = "sh"; }
		if (code.substring(0, 1) == "0" || code.substring(0, 1) == "3")
			area_str = "sz";
		if (code != "" && code.length == 6) {
			if (area_str != "") {
				var picstr = "<table width='100%' border='0' cellpadding='0' style='border:1px solid #cccccc;'><tr><td><img id='pic_k_id' src='http://image2.sinajs.cn/newchart/" + kstr + "/n/" + area_str + code + ".gif?" + Math.random() * 100000 + "' border='0' width='590' /></td></tr></table>";
				document.getElementById("stock_pic_btn").style.display = "";
				document.getElementById("stock_index_pic").innerHTML = picstr;
			}
		}
	}

	//计算总股数
	function GetTotalHandqty() {
		var hands = Trim($("#bull_num").val());
		if(hands!='')
		{
			var handqty = "100";
			$("#tdtotalnum").html(hands * parseInt(handqty, 10) + "股");
		}
		else
		{
			$("#tdtotalnum").html('');
		}
	}

	//计算可买手数
	function GetCanNum()
	{
		//当前价
		var price = parseFloat($('#buys_price').val());
		//可用金额
		var cancash = parseFloat($('#spn_cancash').html());
		//最多可以买多少手
		var cannum = Math.floor(cancash / (100*price));
		$('#bull_num').val(cannum);
		GetTotalHandqty();
	}

	function Cancel()
	{
		//刷新本页面
		self.location.href=self.location.href + '?' + Math.random();
	}
	function submitok()
	{

		$("#orderfrm").submit();
	}
	function getstockname()
	{
		code=$('#buy_code').val();
		if(code.length==6)
		{
			$.ajax({
				type:'GET',
				url:'/web/getstock?stockcode=' + code,
				success:function(res){
					alert(res);
					if(res.indexOf(',')!=-1)
					{
						$('#rddirect1').attr('disabled','false');
						$('#rddirect2').removeAttr("disabled"); 
						$('#can_bull_up').removeAttr("disabled"); 
						$('#can_bull_down').removeAttr("disabled"); 
						$('#price_type1').removeAttr("disabled"); 
						$('#price_type2').removeAttr("disabled"); 
						$('#bull_num').removeAttr("disabled"); 
						$('#btnOk').removeAttr("disabled"); 
						$('#btnCancel').removeAttr("disabled"); 
						stock = res.split(',');
						//alert(stock[3]);
						$('#buy_name').html(stock[2]);
						$('#buy_dc').html(stock[9]+' ‰');
						if(stock[3]=='1' || stock[4]=='1') //停牌或关盘
						{
							$('#rddirect1').attr('disabled','true');
							$('#rddirect2').attr('disabled','true');
							$('#can_bull_up').attr('disabled','true');
							$('#can_bull_down').attr('disabled','true');
							$('#price_type1').attr('disabled','true');
							$('#price_type2').attr('disabled','true');
							$('#bull_num').attr('disabled','true');
							$('#btnOk').attr('disabled','true');
							$('#btnCancel').attr('disabled','true');
							if(stock[3]=='1' ){
								ymPrompt.errorInfo({title:'下单',message:"当前股票处于停牌状态，无法进行交易"});
							}else{

								ymPrompt.errorInfo({title:'下单',message:"当前股票不支持交易"});
							}
							return  false;
						}
						if(stock[7]=='0')
						{
							$('#can_bull_up').attr('disabled','true');
						}
						if(stock[8]=='0')
						{
							$('#can_bull_down').attr('disabled','true');
						}
						
						if(stock[3]!='1')
						{
							//显示行情K线图
							ShowStocksPic();
							//获取行情数据
							alert('test');
							GetQuote(code);
						}
					}
					
				}
			});
		}
	}
	function GetQuote(c)
	{
		$.ajax({
		type: 'GET',
		url: "/web/getstock?stockcode=" + c,
		success:function(res)
		{
			//alert(res);
			if(res.indexOf(',')!=-1)
			{
			
			quote = res.split(',');
			
			if(quote.length!=33)
			{
			}
			zt_rate = quote[1].toLowerCase().indexOf('st')!=-1 ? 1.05 : 1.1;
			dt_rate = quote[1].toLowerCase().indexOf('st')!=-1 ? 0.95 : 0.9;
			var cancash = parseFloat($('#spn_cancash').val());
			console.log(cancash);
			var cannum = Math.floor(cancash / (100*parseFloat(quote[3])));
			
			$('#canbuy').val(cannum);
			$('#buys_price').val(parseFloat(quote[3]).toFixed(2));
			$('#buy_price').html(parseFloat(quote[3]).toFixed(2));
			
			$('#buys_price').val(quote[3]);
			$('#cur_price').html('<font color="' + (parseFloat(quote[4])>parseFloat(quote[3]) ? '#ff0000' : '#287938') + '">' + parseFloat(quote[4]).toFixed(2) + '</font>');
			$('#kp_price').html('<font color="' + (parseFloat(quote[2])>parseFloat(quote[3]) ? '#ff0000' : '#287938') + '">' + parseFloat(quote[2]).toFixed(2) + '</font>');
			$('#hight_price').html('<font color="' + (parseFloat(quote[5])>parseFloat(quote[3]) ? '#ff0000' : '#287938') + '">' + parseFloat(quote[5]).toFixed(2) + '</font>');
			$('#lower_price').html('<font color="' + (parseFloat(quote[6])>parseFloat(quote[3]) ? '#ff0000' : '#287938') + '">' + parseFloat(quote[6]).toFixed(2) + '</font>');
			$('#yes_price').html(parseFloat(quote[3]).toFixed(2));
			cur_zd = parseFloat(quote[4]-quote[3]);
			cur_zdf = parseFloat(cur_zd*100 / quote[3]);
			cur_zd = '<font color="' + (cur_zd>0 ? '#ff0000' : '#287938') + '">' + cur_zd + '</font>';
			cur_zdf = '' + cur_zdf + '';
			$('#zd').html(cur_zd);
			$('#zdf').html(cur_zdf);
			$('#zcj_num').html(Math.floor(quote[9]/100));
			$('#zcj_price').html(parseFloat(quote[10]/10000));
			$('#zt_price').html('<font color="#ff0000">' + parseFloat(quote[3]*zt_rate).toFixed(2) + '</font>');
			$('#dt_price').html('<font color="#287938">' + parseFloat(quote[3]*dt_rate).toFixed(2) + '</font>');
			
			$('#sell_5_price').html('<font color="' + (parseFloat(quote[29])>parseFloat(quote[3]) ? '#ff0000' : '#287938') + '">' + quote[29] + '</font>');
			$('#sell_5_num').html(Math.floor(quote[28]/100));
			$('#sell_4_price').html('<font color="' + (parseFloat(quote[27])>parseFloat(quote[3]) ? '#ff0000' : '#287938') + '">' + quote[27] + '</font>');
			$('#sell_4_num').html(Math.floor(quote[26]/100));
			$('#sell_3_price').html('<font color="' + (parseFloat(quote[25])>parseFloat(quote[3]) ? '#ff0000' : '#287938') + '">' + quote[25] + '</font>');
			$('#sell_3_num').html(Math.floor(quote[24]/100));
			$('#sell_2_price').html('<font color="' + (parseFloat(quote[23])>parseFloat(quote[3]) ? '#ff0000' : '#287938') + '">' + quote[23] + '</font>');
			$('#sell_2_num').html(Math.floor(quote[22]/100));
			$('#sell_1_price').html('<font color="' + (parseFloat(quote[21])>parseFloat(quote[3]) ? '#ff0000' : '#287938') + '">' + quote[21] + '</font>');
			$('#sell_1_num').html(Math.floor(quote[20]/100));
			
			$('#buy_1_num').html(Math.floor(quote[10]/100));
			$('#buy_1_price').html('<font color="' + (parseFloat(quote[11])>parseFloat(quote[3]) ? '#ff0000' : '#287938') + '">' + quote[11] + '</font>');
			$('#buy_2_num').html(Math.floor(quote[12]/100));
			$('#buy_2_price').html('<font color="' + (parseFloat(quote[13])>parseFloat(quote[3]) ? '#ff0000' : '#287938') + '">' + quote[13] + '</font>');
			$('#buy_3_num').html(Math.floor(quote[14]/100));
			$('#buy_3_price').html('<font color="' + (parseFloat(quote[15])>parseFloat(quote[3]) ? '#ff0000' : '#287938') + '">' + quote[15] + '</font>');
			$('#buy_4_num').html(Math.floor(quote[16]/100));
			$('#buy_4_price').html('<font color="' + (parseFloat(quote[17])>parseFloat(quote[3]) ? '#ff0000' : '#287938') + '">' + quote[17] + '</font>');
			$('#buy_5_num').html(Math.floor(quote[18]/100));
			$('#buy_5_price').html('<font color="' + (parseFloat(quote[19])>parseFloat(quote[3]) ? '#ff0000' : '#287938') + '">' + quote[19] + '</font>');
			}
		}
		});
	}
</script>

@endsection
@section('css')
<style>
	#TB_window {min-height:100px;}
	html, body, div, h1, h2, h3, h4, h5, h6, ul, ol, dl, li, dt, dd, p, blockquote, pre, form, fieldset, table, th, td{
		font-size: 16px !important;
	}
</style>
<link href="/css/thickbox.css" rel="stylesheet" type="text/css" />
<link href="/css/tip-violet.css" rel="stylesheet" type="text/css" />
<link href="/css/style2.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0"> 
	<form name="orderfrm" id="orderfrm" action="/web/buy" method="post">
	{{ csrf_field() }}
	<tr> 
		<td width="230"  class="xd" valign="top">
		<table width="230" border="0" cellpadding="3" cellspacing="1" class="mybox table-bordered" id="buybox"> 
			<tr>
			<th height="30" colspan="2" style="text-align:center"><span id='ordertitle'>买入股票</span></th>
			</tr>
			<tr bgcolor="#3f4042"> 
			<td width="100" height="20" align="right">交易账户：</td> 
			<td align="left">{{ $user->name }}</td> 
			</tr> 
			<tr bgcolor="#3f4042"> 
				<td height="20" align="right"> 可用保证金：</td> 
			<td align="left" id="tdusrremain">
			<span class="money">
				@if($money_wallet->before_amount >  $money_wallet->after_amount + $money_wallet->before_amount - $stock_wallet->after_amount -$fund_amount)
				￥ 0
				@else
				￥ {{ $money_wallet->after_amount - $stock_wallet->after_amount - $fund_amount}}
				@endif
			</span>
			<span id='spn_cancash' style='display:none;'></span>
			</td> 
			</tr> 
			<tr bgcolor="#3f4042"> 
			<td height="20" align="right"> 股票代码：</td> 
			<td align="left">
			<input name="buy_code" type="text" id="buy_code" style="width:90px; position:relative;" value="代码/名称/拼音" size="10" maxlength="12" onBlur="getstockname();" /> </td> 
			</tr> 
			<tr bgcolor="#3f4042"> 
			<td height="20" align="right"> 股票名称：</td> 
			<td align="left" id="buy_name" style="color:#ff0000">--</td> 
			</tr> 
			<tr bgcolor="#3f4042" id="TR_dcjg"  > 
			<td height="20" align="right"> 当前价格：</td> 
			<td align="left" id="price">--</td> 
			</tr> 
			<tr bgcolor="#3f4042" style="display:none;"> 
			<td height="20" align="right">交易方向：</td> 
			<td align="left"> <input id="rddirect1" type="radio" name="direct" value="1" checked /> 
				买
				<input id="rddirect2" type="radio" name="direct" value="2" disabled /> 
				卖 </td> 
			</tr> 
			<tr bgcolor="#3f4042">
			<td height="20" align="right">升跌类型：</td>
			<td align="left" valign="middle" style='font-size:17px;'>
				<input name="buy_type" type="radio" id="can_bull_up" value="1" checked />
			<font color="#ff0000">信用买入↑</font>
				<br>
				<input type="radio" id="can_bull_down" name="buy_type" value="2" /><font color="#006600">借票卖出↓</font></td>
			</tr>
			<tr bgcolor="#3f4042"> 
			<td height="20" align="right">委托方式：</td> 
			<td align="left" valign="middle"> 
				<input id="price_type1" type="radio" name="price_type" value="1" checked  onclick="if(this.checked==true){$('#spnprice').css('display','none');}" />市价
			</td> 
			</tr> 
			<tr bgcolor="#3f4042"> 
			<td height="20" align="right">委托手数：</td> 
			<td align="left"><input id="bull_num" name="bull_num" type="text" size="12" onChange="GetTotalHandqty();" maxlength="5" style="width:60px;" /> 
				手<br>
				(1手＝100股)</td> 
			</tr>
			<tr bgcolor="#3f4042">
			<td height="20" align="right">总股数：</td>
			<td align="left" id="tdtotalnum">--</td>
			</tr> 
			<tr bgcolor="#3f4042"> 
			<td colspan="2" align="center"> 
				<input type="button" name="btnOk" id="btnOk" value="确定" class="button3"  />&nbsp;&nbsp; 
				<input type="button" name="btnCancel" id="btnCancel" value="取消" onclick="Cancel();" class="button3" /> 
			</td> 
			</tr> 
		</table>
		</td> 
		<td width="10"></td> 
		<td valign="top">
			<table width="595px" border="0" align="left" cellpadding="0" cellspacing="0"> 
				<tr> 
					<td valign="top" id="tdstockslist">
						<table  width="100%" cellpadding="3" cellspacing="1" bgcolor="#cccccc" id="tbadd" class="mybox table-bordered">
							<tr class="title_small" align="center" >
							<th width="20%" class="title_TD">&nbsp;</th>
							<th width="20%" class="title_TD" style="text-align:center" >价格</th>
							<th width="20%" class="title_TD" style="text-align:center" >数量</th>
							<th width="20%" class="title_TD">&nbsp;</th>
							<th  class="title_TD" style="text-align:center">
								<a href="javascript:getstockname();">
									<img src="/images/btn_refresh.gif" border="0" alt="刷新行情" />
								</a>
							</th>
							</tr>
							<tr align="center" bgcolor="#3f4042">
							<td>卖五</td>
							<td class='message_data' style="width: 87px" id='sell_5_price'>--</td>
							<td class='message_data' id='sell_5_num'>0</td>
							<td>开盘价</td>
							<td class='message_data' id='kp_price'>0</td>
							</tr>
							<tr  align="center" bgcolor="#3f4042" >
							<td>卖四</td>
							<td class='message_data' style="width: 87px" id='sell_4_price'>--</td>
							<td class='message_data' id='sell_4_num'>0</td>
							<td>最高价</td>
							<td class='message_data' id='hight_price'>0</td>
							</tr>
							<tr  align="center" bgcolor="#3f4042" >
							<td>卖三</td>
							<td class='message_data' style="width: 87px" id='sell_3_price'>--</td>
							<td class='message_data' id='sell_3_num'>0</td>
							<td>最低价</td>
							<td class='message_data' id='lower_price'>0</td>
							</tr>
							<tr  align="center" bgcolor="#3f4042"  >
							<td>卖二</td>
							<td class='message_data' style="width: 87px" id='sell_2_price'>--</td>
							<td class='message_data' id='sell_2_num'>0</td>
							<td>昨收价</td>
							<td class='message_data' id='yes_price'>0</td>
							</tr>
							<tr  align="center" bgcolor="#3f4042" >
							<td>卖一</td>
							<td class='message_data' style="width: 87px" id='sell_1_price'>--</td>
							<td class='message_data' id='sell_1_num'>0</td>
							<td>涨跌</td>
							<td class='message_data' id='zd'>0</td>
							</tr>
							<tr  align="center" bgcolor="#3f4042" >
							<td>最新价</td>
							<td class='message_data' style="width: 87px" id="cur_price">--</td>
							<td class='message_data'>--</td>
							<td>涨跌%</td>
							<td class='message_data' id='zdf'>0</td>
							</tr>
							<tr  align="center" bgcolor="#3f4042"  >
							<td>买一</td>
							<td class='message_data' style="width: 87px" id='buy_1_price'>--</td>
							<td class='message_data' id='buy_1_num'>0</td>
							<td>总成交量</td>
							<td class='message_data' id='zcj_num'>0</td>
							</tr>
							<tr  align="center" bgcolor="#3f4042" >
							<td style="height: 18px">买二</td>
							<td class='message_data' style="width: 87px; height: 18px" id='buy_2_price'>--</td>
							<td class='message_data' style="height: 18px" id='buy_2_num'>0</td>
							<td style="height: 18px">总金额（万）</td>
							<td class='message_data' style="height: 18px" id='zcj_price'>0</td>
							</tr>
							<tr  align="center" bgcolor="#3f4042" >
							<td>买三</td>
							<td class='message_data' style="width: 87px" id='buy_3_price'>--</td>
							<td class='message_data' id='buy_3_num'>0</td>
							<td>涨停价</td>
							<td class='message_data' id='zt_price'>0</td>
							</tr>
							<tr  align="center" bgcolor="#3f4042" >
							<td>买四</td>
							<td class='message_data' style="width: 87px" id='buy_4_price'>--</td>
							<td class='message_data' id='buy_4_num'>0</td>
							<td>跌停价</td>
							<td class='message_data' id='dt_price'>0</td>
							</tr>
							<tr  align="center" bgcolor="#3f4042" >
							<td height='25'>买五</td>
							<td class='message_data' style="width: 87px" id='buy_5_price'>--</td>
							<td  class='message_data' id='buy_5_num'>0</td>
							<td  class='message_data'>&nbsp;</td>
							<td  class='message_data'>&nbsp;</td>
							</tr>
						</table>
					</td> 
				</tr> 
				<tr> 
				<td height="3px"> </td> 
				</tr> 
				<tr> 
					<td height="12px" align="center" id="stock_pic_btn" style='display:none'> 
						&nbsp;&nbsp;&nbsp;&nbsp; <input type="button" value="分时线" class="button3" onclick='getProductKImage("min");' /> 
						&nbsp;&nbsp;&nbsp;&nbsp; <input type="button" value="日K线" class="button3" onclick='getProductKImage("daily");' /> 
						&nbsp;&nbsp;&nbsp;&nbsp; <input type="button" value="周K线" class="button3" onclick='getProductKImage("weekly");' /> 
						&nbsp;&nbsp;&nbsp;&nbsp; <input type="button" value="月K线" class="button3" onclick='getProductKImage("monthly");' /> 
					</td> 
				</tr> 
				<tr> 
				<td height="3px"> </td> 
				</tr> 
				<tr> 
				<td id="stock_index_pic" valign="top"> </td> 
				</tr> 
			</table>
		</td> 
	</tr>
	</form> 
</table> 
@endsection