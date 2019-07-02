@extends('layouts.web_template')

@section('script')
	<script type="text/javascript" src="/js/jquery-1.4.2.min.js"></script>
	<script type="text/javascript" src="/js/jquery.min.js"></script>
	<script type="text/javascript" src="/js/js_admin.js"></script>
	<script type="text/javascript" src="/js/thickbox.js"></script>
	<script>
	$(document).ready(function(){
		$('#button').click(function(){
			console.log('here');
			var path;
			var obj=$('.checkbox'); 
			var s=''; 
			for(var i=0; i<obj.length; i++){ 
			if(obj[i].checked) s+=obj[i].value; 
			} 
			if(s==""){
				alert('请选择类型');
			}
			window.location.href=s;
		});
	
		$("#awesomes").click(function(){
			$("#awesome").removeAttr("checked");
			$(this).attr('checked','checked');
		});
		$("#awesome").click(function(){
			$("#awesomes").removeAttr("checked");
			$(this).attr('checked','checked');
		});

	});

	
	
	</script>
@endsection
@section('css')
	<link href="/css/thickbox.css" rel="stylesheet" type="text/css" />
	<link href="/css/tip-violet.css" rel="stylesheet" type="text/css" />
	<link href="/css/style2.css" rel="stylesheet" type="text/css" />
	<style>
		.mybox td{
			font-size:18px;
			height: 40px;
			background-color: #c4ffff;
			color: black;
		}
		input[type="checkbox"] + label::before {
			content: "\a0";  
			display: inline-block;
			vertical-align: .2em;
			width: 1em;
			height:1em;
			margin-right: .2em;
			border-radius: .2em;
			background-color: silver;
			text-indent: .15em;
			line-height: .65;  
		}
		input[type="checkbox"]:checked + label::before {
			content: "\2713";
			background-color: yellowgreen;
		}
		input {
			position: absolute;
			clip: rect(0, 0, 0, 0);
		}
		input[type="checkbox"]:focus + label::before {
			box-shadow: 0 0 .1em .1em #58a;
		}
		input[type="checkbox"]:disabled + label::before {
			background-color: gray;
			box-shadow: none;
			color: #555;
		}       
	</style>
@endsection

@section('content')
	<form name='fm1' id='fm1' method=post action="" target=_blank >
		<table width="25%"  border="0"  cellpadding="3" cellspacing="1"  class="mybox" style='margin-left: 260px;border: 1px solid black;'>
			<tr>
				<td height="26" align="center" class="fb12"  style="text-align: left;border: 1px solid black;" colspan="2">
					<input type="checkbox" id="awesomes" class='checkbox'  value='/web/payment'/>
					<label for="awesomes">银行转证券（入金）</label>
				</td>
			</tr>
			<tr>
				<td height="26" align="center" class="fb12"  style="text-align: left;border: 1px solid black;" colspan="2">
					<input type="checkbox" id="awesome"  class='checkbox' value='/web/atm' />
					<label for="awesome">证券转银行（出金）</label>
				</td>
			</tr>
			<tr>
				<td height="26" align="center" class="fb12"  style="text-align: right;border: 1px solid black;" colspan="2">
					<button type="button" id="button" style='height: 30px;'>下一步</button>
				</td>
			</tr>
		</table>
	</form>
	<br><br>
@endsection



