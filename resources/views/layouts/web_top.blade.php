	<div id="sound_msg" style="display:none"></div>
	<div id="sound_bc" style="display:none;"></div>
	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
		<tr>
            <td height="25" background="/images/topbar.gif">
                <div id="all_count">
                    <div id="load_text"></div>
                    <table border="0" cellpadding="0" cellspacing="0" >
                        <tr>
                            <td height="22" nowrap="nowrap"><span id="open" style="color:#FF0000;"></span>&nbsp;&nbsp;</td>
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
                </div>
            </td>
            <td background="/images/topbar.gif">
                <div id="news"> 
                    <ul> 
                        <li>[{{ $new_latest->created_at }}] {{ $new_latest->contents }}</li> 
                    </ul> 
                </div> 
			</td>
		</tr>
	</table>
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="top" style="background-color: #9d1618;"> 
		<tr>
			<td width="280px" style='margin-right: 100px;'><img src="/images/stock_web_logo.png" style='width: 280px; margin-left: 20px;margin-right: 100px;'/></td>
            <td >
                <table class="nav_ico" >
                    <tr>
                        <td align="center">
                            <a href="/web/operate" target="_self"><img src="/images/10.jpg" /><br>银证转账</a>
                        </td>
                        <td align="center">
                            <a href="/web/index" target="_self"><img src="/images/1.png" /><br>沪深A股</a>
                        </td>							
                        <td align="center" id="top1">
                            <a href="javascript:void(0);" target="_self" onclick="if(confirm('下载应用程序并尝试.')){location.href='/dow/index';return false;}else{return false;}"><img src="/images/3.png" /><br>自选股票</a>
                        </td>
                        <td align="center">
                            <a href="javascript:void(0);" target="_self" onclick="if(confirm('下载应用程序并尝试.')){location.href='/dow/index';return false;}else{return false;}"><img src="/images/4.png" /><br>快速下单</a>
                        </td>
                        <td align="center">
                            <a href="/web/deal" target="_self" ><img src="/images/7.png" /><br>持仓单</a>
                        </td>
                        <td align="center">
                            <a href="/web/user" target="_self"><img src="/images/9.png" /><br>交易账户</a>
                        </td>
                        <td align="center">
                            <a href="javascript:void(0);" target="_top" onclick="if(confirm('确定要退出登录吗？')){location.href='/logout';return false;}else{return false;}"><img src="/images/6.png" /><br>退出登录</a>
                        </td>
                        <td >
                            <div  style='margin-left: 40px;'>
                            </div>
                        </td>
                        <td >
                            <div >
                                <div id="clock" style="margin-left: 50px;">  
                                    <p class="date" id="date" onload="showTime()" ></p>  
                                    <p class="time" id="MyClockDisplay" onload="showTime()"></p>  
                                </div> 
                            </div>
                        </td>
                    </tr>
                </table>
            </td> 
			</tr> 
		</table> 




