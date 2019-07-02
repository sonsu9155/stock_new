@extends('layouts.web_template')

@section('css')
<link href="/css/style2.css" rel="stylesheet" type="text/css" />

@endsection

@section('script')
<script type="text/javascript" src="/js/noright.js"></script>
<script type="text/javascript">
$(document).ready(function(){

	if($.browser.msie&&$.browser.version=="6.0"&&$("html")[0].scrollHeight>$("html").height())
		$("html").css("overflowY","scroll");
});
</script>
@endsection
@section('content')
	<table width="98%"  border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#CCCCCC" class="mybox">
	<tr>
		<th class="text-center"><strong>规则</strong></th>
	</tr>
	
	</table>
	<p style="font-size:16px; margin-left:2%;color: black;">
	<br />
	开设注册账户前，请详细阅读客户须知；股市有风险，投资需谨慎；<br />
	财智通资产融资融券交易须知：<br />
	1、 交易融资比例为1:10,即最大资金使用量为客户可用保证金（即本金）的10倍；<br />
	2、 每笔交易均以交易金额为准下单即时扣除交易费用（其中包括：千分之三印花税，千分之一手续费（单边），千分之三融资利息））；<br />
	3、 留仓股票最多持仓时间为五个交易日（留仓天数到期日以当日收盘价，系统将自动进行平仓）；<br />
	4、 留仓股票均以交易总金额扣除万分之八为当天留仓过夜费；<br />
	5、 交易熔断阈值为交易股票每日涨（跌）幅达到百分之七，或前一日涨（跌）幅达到百分之八时,系统将停止当日该交易股票多（空）新单的购买；系统并有权修正熔断期间任何异常下单； <br />
	6、 个股盘中任一时点（含开盘、收盘）触及涨跌停板,跳空等异常情况下单,为保证共同利益，系统将有权自动止盈止损，均以涨跌停板价或建仓价自动平仓结算。<br />
	7、 以股票买入的成本价计算，赢/亏额达到百分之七十时，系统将自动平仓；因为股票是撮合制交易，会出现无法在预期价格交易，如急速拉升或买卖量不足等，会将自动平仓比例放大所以自动平仓70%-85%都属于正常范围。<br />
	8、单股每笔持仓最低交易金额为一万元以上，单仓或多仓集合竞买不超过五十万元人民币（单向同时持仓）；<br />
	9、每支股票单笔买入后不可分批卖出，故建议客户同一支股票可分次购入；<br />
	10、为保证客户下单交易的及时和有效性，系统对每笔下单均为及时成交价,系统代为委托下单；<br />
	11、新建仓之股票15分钟内系统不允许平仓，平仓时会自动扣除相应之手续费用；<br />
	12、系统交易时间为：A股正常交易日内的上午09:32-11:30，下午13:02-14:57；系统出金时间为A股正常交易时间；<br />
	13、当日有留仓的客户端不支持出金；<br />
	14、客户提现T+1到账；<br />
	15、本交易规则如有未尽事宜，可视状况随时调整。本公司保留规则和条款的最终解释权
	</p>
@endsection