@extends('layouts.web_template')
@section('css')
<link href="/css/style2.css" rel="stylesheet" type="text/css" />
<link href="/css/ymPrompt.css" rel="stylesheet" type="text/css">
@endsection
@section('script')
    <script type="text/javascript" src="/js/jquery1.3.2.js"></script>  
    <script type="text/javascript" src="/js/SuggestServer_3_0_16.js" charset="gb2312"></script>
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
            
            showTime();
            showDate();			
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

        function getpage() {
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
            var res = '<table width="100%" cellspacing="1" cellpadding="3" class="mybox" bgcolor="#cccccc" style="border: 1px solid black;">';
            res += '<tr align="center">'+
                        '<th width="3%" class="text-center" style="border: 1px solid black;">序号</th>'+
                        '<th width="5%" class="text-center" style="border: 1px solid black;">代码</th>'+
                        '<th class="text-center" style="border: 1px solid black;">名称</th>'+
                        '<th class="text-center" style="border: 1px solid black;">最新价</th>'+
                        '<th class="text-center" style="border: 1px solid black;">成交量(手)</th>'+
                        '<th class="text-center" style="border: 1px solid black;">涨跌</th>'+
                        '<th class="text-center" style="border: 1px solid black;">买价</th>'+
                        '<th class="text-center" style="border: 1px solid black;">卖价</th>'+
                        '<th class="text-center" style="border: 1px solid black;">开盘价</th>'+
                        '<th class="text-center" style="border: 1px solid black;">最高价</th>'+
                        '<th class="text-center" style="border: 1px solid black;">最低价</th>'+
                        '<th class="text-center" style="border: 1px solid black;">昨收价</th>'+	
                        '<th width="8%" class="text-center" style="border: 1px solid black;">状态</th>'+
                        '<th class="text-center" style="border: 1px solid black;">机构通道费</th>'+
                        
                    '</tr>';
            $('#tdstocklist').html(loading);
            getpage();
            goUrl = '/web/stockdata?type=stocklist&stype=' + stype + '&page=' + curpage + '&pagesize=' + pagesize + '&stockcode=' + stockcode + '&bkname=' + bkname;
            console.log(goUrl );
            $.ajax({
                type: 'GET',
                url: goUrl,
                success:function(html)
                {
                    console.log(JSON.parse(html));
                    contents =JSON.parse(html);
                    if(contents.list.length)
                    {
                        totalrecord = contents.total; 
                        curtotalrecord = contents.current;
                        if(curtotalrecord>0) 
                        {
                            for(i=0;i<curtotalrecord;i++)
                            {		
                                content = contents.list[i];	
                                if(content.code.substring(0,1)=="6"){
                                    stock_code ="sh" + content.code;
                                }else{
                                    stock_code ="sz" + content.code;
                                }
                                console.log(content.data[3]);
                                rise = (parseFloat(content.data[3])*1000 -parseFloat(content.data[1])*1000)/1000;
                                bgcolor = (i+1) % 2 ==0 ? '#3f4042' : '#57595d';
                                res +=' <tr align="center" onmouseover="this.style.background=\'#152950\';" onmouseout="this.style.background=\'' + bgcolor + '\';"bgcolor="'+ bgcolor +'" style="border: 1px solid black;">' +
                                            '<td style="border: 1px solid black;">'+ ((curpage-1)*pagesize + i+1)+'</td>'+
                                             '<td style="border: 1px solid black;">'+ content.code +'</td>'+                       
                                             '<td style="border: 1px solid black;"><a href="/web/stock_detail?id=' + stock_code + '">' + content.data[0] + '</a></td>'+  
                                             '<td style="color:red">' + content.data[3] + '</td>'+          
                                             '<td style="border: 1px solid black;">' + content.data[8] + '</td>'+         
                                             '<td style="border: 1px solid black;">' + rise + '</td>'+         
                                             '<td style="border: 1px solid black;">' + content.data[6] + '</td>'+        
                                             '<td style="border: 1px solid black;">' + content.data[7] + '</td>'+         
                                             '<td style="border: 1px solid black;">' + content.data[1] + '</td>'+          
                                             '<td style="color:#FF0000; border: 1px solid black;">' + content.data[4] + '</td>'+          
                                             '<td style="color:#008000; border: 1px solid black;">' + content.data[5] + '</td>'+          
                                             '<td style="color:#999999; border: 1px solid black;">' + content.data[2] + '</td>'+         
                                             '<td style="border: 1px solid black;">' + '正常' + '</td>'+
                                             '<td style="color:red">'+ '0' + '‰</td>'+                                            
                                        '</tr>';
            
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
@endsection 
@section('content')
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
                    <td id="tdstockstypename" style=" padding-right:5px;" >
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
@endsection