@extends('bsb.templates.admin')
@section('content')
<style>
    th, td {                
                padding:5px               
            } 
</style>
<div class="container-fluid">
<div class="block-header">
        <h2>
        系统设置
            <small>管理  >  系统设置</small>
        </h2>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                <a href="{!! url('/setting') !!}" class="pull-right"><i class="material-icons">add_box</i></a>
                    <h2>
                    系统设置
                    </h2>
                </div>
                <div class="body">
                <table width="98%" border="0" align="center" cellpadding="2" cellspacing="1" class="table1" id="regform"> 
                    <form id="form1" action="/setting/dosetting" method="post"> 
                    {{ csrf_field() }}
                        <tr class="row_title"> 
                            <td colspan="3">注册开关设置<div id="loadtxt"></div></td> 
                        </tr> 
                        <tr class="row_ls">
                            <td width="15%" align="right">1为开放0为关闭:</td> 
                            <td width="27%" class="row_ls"><input name="open_xitong" type="text" id="open_xitong" value="{{ $data->open_xitong }}" size="5" maxlength="5"  /></td>
                        </tr>
                        
                        <tr class="row_title"> 
                            <td colspan="3">开市和收市时间设定<div id="loadtxt"></div></td> 
                        </tr> 
                        <tr class="row_ls"> 
                            <td width="15%" align="right">上午开收市时间:</td> 
                            <td width="27%" class="row_ls">
                                <input name="open_AM_Start" type="text" id="open_AM_Start" value="{{ $data->open_AM_Start }}" size="5" maxlength="5"  /> 
                                ~
                                <input name="open_AM_End" type="text" id="open_AM_End" value="{{ $data->open_AM_End }}" size="5" maxlength="5"  /></td> 
                            <td width="58%" class="row_ls"><font color="#999999">开收市时间设定,允许或禁止买卖股票、委托 (格式例如: 09:30)</font></td> 
                        </tr> 
                        <tr class="row_ls"> 
                            <td align="right">下午开收市时间:</td> 
                            <td>
                                <input name="open_PM_Start" type="text" id="open_PM_Start" value="{{ $data->open_PM_Start }}" size="5" maxlength="5"  /> 
                                ~
                                <input name="open_PM_End" type="text" id="open_PM_End" value="{{ $data->open_PM_End }}" size="5" maxlength="5"  /></td> 
                            <td>&nbsp;</td> 
                        </tr> 
                        <tr class="row_title"> 
                             <td colspan="3">平仓时间设置</td> 
                        </tr> 
                        <tr class="row_ls"> 
                            <td width="15%" align="right">上午平仓时间:</td> 
                            <td width="27%" class="row_ls">
                                <input name="sell_AM_Start" type="text" id="sell_AM_Start" value="{{ $data->sell_AM_Start }}" size="5" maxlength="5"  /> 
                                ~
                                <input name="sell_AM_End" type="text" id="sell_AM_End" value="{{ $data->sell_AM_End }}" size="5" maxlength="5"  /></td> 
                            <td width="58%" class="row_ls"><font color="#999999">指定时间内允许会员平仓(卖出) (格式例如: 09:30)</font></td> 
                        </tr> 
                        <tr class="row_ls"> 
                            <td align="right">下午平仓时间:</td> 
                            <td>
                                <input name="sell_PM_Start" type="text" id="sell_PM_Start" value="{{ $data->sell_PM_Start }}" size="5" maxlength="5"  /> 
                                ~
                                <input name="sell_PM_End" type="text" id="sell_PM_End" value="{{ $data->sell_PM_End }}" size="5" maxlength="5"  /></td> 
                            <td>&nbsp;</td> 
                        </tr> 

                        <tr class="row_title"> 
                              <td colspan="3">提款时间设置</td> 
                        </tr> 
                        <tr class="row_ls"> 
                            <td width="15%" align="right">上午提款时间:</td> 
                            <td width="27%" class="row_ls">
                                <input name="atm_AM_Start" type="text" id="atm_AM_Start" value="{{ $data->atm_AM_Start }}" size="5" maxlength="5"  /> 
                                ~
                                <input name="atm_AM_End" type="text" id="atm_AM_End" value="{{ $data->atm_AM_End }}" size="5" maxlength="5"  /></td> 
                            <td width="58%" class="row_ls">
                                <font color="#999999">指定时间内允许会员提款 (格式例如: 09:30)</font></td> 
                        </tr> 
                        <tr class="row_ls"> 
                            <td align="right">下午提款时间:</td> 
                            <td>
                                <input name="atm_PM_Start" type="text" id="atm_PM_Start" value="{{ $data->atm_PM_Start }}" size="5" maxlength="5"  /> 
                                ~
                                <input name="atm_PM_End" type="text" id="atm_PM_End" value="{{ $data->atm_PM_End }}" size="5" maxlength="5"  /></td> 
                            <td>&nbsp;</td> 
                        </tr> 

                        <tr class="row_title"> 
                             <td colspan="3">基本设置</td> 
                        </tr> 
                        <tr class="row_ls"> 
                            <td align="right" class="row_ls">尝试登陆次数</td> 
                            <td><input name="max_tries" type="text" value="{{ $data->max_tries }}" size="5" maxlength="3"  /></td> 
                            <td><font color="#999999">当用户输入错误密码达到指定次数即锁定用户</font></td> 
                        </tr> 
                        <tr class="row_ls"> 
                            <td align="right" class="row_ls">委托交易数量</td> 
                            <td><input name="trust_num" type="text" id="trust_num" value="{{ $data->trust_num }}" size="5" maxlength="3"  /></td> 
                            <td><font color="#999999">会员委托买卖交易数量,此数值不能太大否则影响前台速度</font></td> 
                        </tr> 
                        <tr class="row_ls"> 
                            <td align="right" class="row_ls">系统维护开关</td> 
                            <td>
                                <select name="system_safeguard" id="system_safeguard"> 
                                    <option value="off" selected="selected">关闭</option> 
                                    <option value="on">开启</option>                             
                                </select> </td> 
                            <td><font color="#999999">开启系统维护后,前台和代理平台不接受用户登陆。</font></td> 
                        </tr> 
                        <tr class="row_ls"> 
                            <td align="right" class="row_ls">系统维护说明:</td> 
                            <td><textarea name="system_safeguard_direc" id="system_safeguard_direc" cols="30" rows="5">系统维护中...</textarea></td> 
                            <td><font color="#999999">系统维护时页面显示维护公告 (100字符内)</font></td> 
                        </tr> 
                        <tr class="row_title"> 
                         <td colspan="3">账号设置</td> 
                        </tr> 
                        <tr class="row_ls"> 
                            <td align="right" class="row_ls">账号限制规则</td> 
                            <td>
                                <input name="user_regex" type="text" id="user_regex" value="{{ $data->user_regex }}" size="35" style="width:250px;" /></td> 
                            <td><font color="#999999">新建用户时只能包含的字符和符号.</font></td> 
                        </tr> 
                        <tr class="row_ls"> 
                            <td align="right" class="row_ls">代理商账户:</td> 
                            <td>
                                上级账号的 
                                <input name="agent_prefix" type="text" id="agent_prefix" value="{{ $data->agent_prefix }}" size="5"  /> 
                                位,输入
                                <input name="agent_min" type="text" id="agent_min" value="{{ $data->agent_min }}" size="5"  /> 
                                位,至 
                                <input name="agent_max" type="text" id="agent_max" value="{{ $data->agent_max }}" size="5"  /> 
                                位</td> 
                            <td>&nbsp;</td> 
                        </tr> 
                        <tr class="row_ls"> 
                            <td align="right" class="row_ls">会员账号:</td> 
                            <td>上级账号的 
                                <input name="user_member_prefix" type="text" id="user_member_prefix" value="{{ $data->user_member_prefix }}" size="5"  /> 
                                位,输入
                                <input name="user_member_min" type="text" id="user_member_min" value="{{ $data->user_member_min }}" size="5"  /> 
                                位,至 
                                <input name="user_member_max" type="text" id="user_member_max" value="{{ $data->user_member_max }}" size="5"  /> 
                                位</td> 
                            <td>&nbsp;</td> 
                        </tr> 
                        <tr class="row_ls"> 
                            <td align="right" class="row_ls">密码限制</td> 
                            <td>
                                <input name="min_password" type="text" id="min_password" value="{{ $data->min_password }}" size="5"  /> 
                                至
                                <input name="max_password" type="text" id="max_password" value="{{ $data->max_password }}" size="5"  /> 
                                位</td> 
                            <td>&nbsp;</td> 
                        </tr> 
                        <tr class="row_ls"> 
                            <td align="right" class="row_ls">名称限制:</td> 
                            <td>
                                <input name="user_name_min" type="text" id="user_name_min" value="{{ $data->user_name_min }}" size="5"  /> 
                                至
                                <input name="user_name_max" type="text" id="user_name_max" value="{{ $data->user_name_max }}" size="5"  /> 
                                位</td> 
                            <td>&nbsp;</td> 
                        </tr> 
                        <tr class="row_ls"> 
                            <td align="right" class="row_ls">Ssssion时间:</td> 
                            <td>
                                <select name="cookie_length" id="cookie_length"> 
                                    <option value="600">10分钟</option> 
                                    <option value="1800">30分钟</option> 
                                    <option value="3600">1小时</option> 
                                    <option value="12000">2小时</option> 
                                    <option value="24000">3小时</option> 
                                    <option value="86400" selected="selected">1天</option>                             
                                </select> </td> 
                            <td><font color="#999999">这里的时间是用户登陆保持时间,超出这个时间无动作则自动踢出.</font></td> 
                        </tr> 
                        <tr class="row_title"> 
                            <td colspan="3">费用限制</td> 
                        </tr> 
                        <tr class="row_ls"> 
                            <td align="right" class="row_ls">买入手续费:</td> 
                            <td><input name="cost_bull_max" type="text" id="cost_bull_max" style="width:60px;" value="{{ $data->cost_bull_max }}" maxlength="6"/></td> 
                            <td><font color="#999999">设置买入手续费最大限制</font></td> 
                        </tr> 
                        <tr class="row_ls"> 
                            <td align="right" class="row_ls">卖出手续费:</td> 
                            <td><input name="cost_sell_max" type="text" id="cost_sell_max" style="width:60px;" value="{{ $data->cost_sell_max }}" maxlength="6"/></td> 
                            <td><font color="#999999">设置卖出手续费最大限制</font></td> 
                        </tr> 
                        <tr class="row_ls"> 
                            <td align="right" class="row_ls">留仓手续费:</td> 
                            <td>
                                <input name="cost_save_max" type="text" id="cost_save_max" style="width:60px;" value="{{ $data->cost_save_max }}" maxlength="6"/> 
                                最长留仓:
                                <input name="cost_save_day" type="text" id="cost_save_day" style="width:60px;" value="{{ $data->cost_save_day }}" maxlength="6"/> 
                                天</td> 
                            <td><font color="#999999">设置留仓费用最大限制以及最大天数</font></td> 
                        </tr> 
                        <tr class="row_ls"> 
                            <td align="right" class="row_ls">印花税:</td> 
                            <td><input name="cost_state_max" type="text" id="cost_state_max" style="width:60px;" value="{{ $data->cost_state_max }}" maxlength="6"/></td> 
                            <td><font color="#999999">设置印花税最大限制</font></td> 
                        </tr>
                        <tr class="row_ls"> 
                            <td align="right" class="row_ls">利息:</td> 
                            <td><input name="cost_daily_max" type="text" id="cost_daily_max" style="width:60px;" value="{{ $data->cost_daily_max }}" maxlength="6"/></td> 
                            <td><font color="#999999">设置利息最大限制</font></td> 
                        </tr>
                        <tr class="row_ls"> 
                            <td align="right" class="row_ls">代理商佣金:</td> 
                            <td>
                                <select name="cost_ret_max" id="cost_ret_max"> 
                                    <option value="10" selected="selected">10%</option> 
                                    <option value="15">15%</option> 
                                    <option value="20">20%</option> 
                                    <option value="25">25%</option> 
                                    <option value="30">30%</option> 
                                    <option value="35">35%</option> 
                                    <option value="40">40%</option> 
                                    <option value="45">45%</option> 
                                    <option value="50">50%</option> 
                                    <option value="55">55%</option> 
                                    <option value="60">60%</option> 
                                    <option value="65">65%</option> 
                                    <option value="70">70%</option> 
                                    <option value="75">75%</option> 
                                    <option value="80">80%</option> 
                                    <option value="85">85%</option> 
                                    <option value="90">90%</option>                             
                                </select></td> 
                            <td><font color="#999999">设置代理商佣金最大限制(<font color=red>您可以针对不同代理商设置不同的佣金比例</font>)</font></td> 
                        </tr> 
                        <tr class="row_ls"> 
                            <td align="right" class="row_ls">最小卖出时间:</td> 
                            <td>
                                <input name="sel_max_time" type="text" id="sel_max_time" style="width:40px;" value="{{ $data->sel_max_time }}" maxlength="6"/> 
                                &nbsp;分钟
                            </td> 
                            <td><font color="#999999">买入股票后间隔多少时间可以卖出</font></td> 
                        </tr> 
                        <tr class="row_ls">
                            <td align="right" class="row_ls">规定时间内卖出加收手续费:</td>
                            <td>
                                <input name="cost_sell_limit" type="text" id="cost_sell_limit" style="width:40px;" value="{{ $data->cost_sell_limit }}" maxlength="6"/>
                            </td>
                            <td><font color="#999999">在最小卖出时间内卖出股票加收手续费(如:0.2=20%)</font></td>
                        </tr>
                        <tr class="row_ls"> 
                        <td align="right" class="row_ls">留仓节假日:</td> 
                        <td>
                            <select name="rest_filter" id="rest_filter"> 
                                <option value="1">计算留仓费</option> 
                                <option value="0" selected="selected">不计算留仓费</option> 
                            </select>
                        </td> 
                        <td>&nbsp;</td> 
                        </tr> 
                        <tr class="row_ls"> 
                        <td align="right" class="row_ls">升跌买入限制:</td> 
                        <td>升跌
                            <input name="buy_sd" type="text" id="buy_sd" style="width:40px;" value="{{ $data->buy_sd }}" maxlength="6"/> 
                            %不许买入</td> 
                        <td>&nbsp;</td> 
                        </tr>
                        <tr class="row_ls">
                            <td align="right" class="row_ls">ST股升跌买入限制:</td>
                            <td>升跌
                                <input name="st_buy_sd" type="text" id="st_buy_sd" style="width:40px;" value="{{ $data->st_buy_sd }}" maxlength="6"/>
                                %不许买入</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr class="row_ls">
                            <td align="right" class="row_ls">成交额设置:</td>
                            <td><input name="turnover_min" type="text" id="turnover_min" style="width:40px;" value="{{ $data->turnover_min }}" maxlength="6"/>万元</td>
                            <td><font color="#999999">当成交额小于设定值后禁止买入</font></td>
                        </tr>
                        <tr class="row_ls">
                            <td align="right" class="row_ls">最低充值额度:</td>
                            <td><input name="minmoney" type="text" id="minmoney" style="width:40px;" value="{{ $data->minmoney }}" maxlength="6"/>
                            元</td>
                            <td><font color="#999999">必须为整数.</font></td>
                        </tr> 
                        <tr class="row_title"> 
                            <td colspan="3">其它设置</td> 
                        </tr> 
                        <tr class="row_ls">
                            <td align="right" class="row_ls">最小买入手数:</td>
                            <td><input name="num_min" type="text" id="num_min" style="width:40px;" value="{{ $data->num_min }}" maxlength="6"/></td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr class="row_ls">
                            <td align="right" class="row_ls">最大买入手数:</td>
                            <td><input name="num_max" type="text" id="num_max" style="width:40px;" value="{{ $data->num_max }}" maxlength="6"/></td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr class="row_ls"> 
                            <td align="right" class="row_ls">人民币与股币兑换:</td> 
                            <td>1人民币=
                                <input name="cost_exchange_rate" type="text" id="cost_exchange_rate" style="width:40px;" value="{{ $data->cost_exchange_rate }}" maxlength="6"/> 
                                股币</td> 
                            <td>建议数值在1-100之间</td> 
                        </tr>
                        <tr class="row_ls"> 
                            <td align="right" class="row_ls">单股可用额度百分比:</td> 
                            <td>
                                <input name="money_percent" type="text" id="money_percent" style="width:40px;" value="{{ $data->money_percent }}" maxlength="6"/> 
                                %</td> 
                            <td>百分比数值，在1-100之间</td> 
                        </tr>
                        <tr class="row_ls">
                        <td align="right" class="row_ls">保证金预警:</td>
                            <td>当可用保证金低于
                            <input name="lower_cash" type="text" id="lower_cash" style="width:40px;" value="{{ $data->lower_cash }}" maxlength="6"/>
                            时提示用户</td>
                            <td>建议数值在0-200之间</td>
                        </tr>
                        <tr class="row_ls">
                             <td align="right" class="row_ls">买卖滑价:</td>
                            <td>
                                    上涨<input name="up_float" type="text" id="up_float" style="width:40px;" value="{{ $data->up_float }}" maxlength="6"/>
                                    下跌<input name="down_float" type="text" id="down_float" style="width:40px;" value="{{ $data->down_float }}" maxlength="6"/></td>
                            <td>设置买卖滑价千分比数值</td>
                        </tr>

                        <tr class="row_ls">
                            <td align="right" class="row_ls">涨跌点差率:</td>
                            <td>
                                    5%<input name="dc5" type="text" id="dc5" style="width:30px;" value="{{ $data->dc5 }}" maxlength="6"/>
                                    6%<input name="dc6" type="text" id="dc6" style="width:30px;" value="{{ $data->dc6 }}" maxlength="6"/>
                                    7%<input name="dc7" type="text" id="dc7" style="width:30px;" value="{{ $data->dc7 }}" maxlength="6"/>
                                    8%<input name="dc8" type="text" id="dc8" style="width:30px;" value="{{ $data->dc8 }}" maxlength="6"/>
                                    9%<input name="dc9" type="text" id="dc9" style="width:30px;" value="{{ $data->dc9 }}" maxlength="6"/>
                            </td>
                            <td>设置涨跌自动点差率5%～10%之间, 大于0正数值</td>
                        </tr>
                        <tr class="row_ls">
                            <td align="right" class="row_ls">成交额大于5千万点差率:</td>
                            <td>
                                    <input name="dc_wan" type="text" id="dc_wan" style="width:40px;" value="{{ $data->dc_wan }}" maxlength="6"/></td>
                            <td>设置成交额大于5千万点差率, 大于0正数值</td>
                        </tr>
                        <tr class="row_ls">
                            <td align="right" class="row_ls">成交额大于8千万点差率:</td>
                            <td>
                                    <input name="dc_wan2" type="text" id="dc_wan2" style="width:40px;" value="{{ $data->dc_wan2 }}" maxlength="6"/></td>
                            <td>设置成交额大于8千万点差率, 大于0正数值</td>
                        </tr>
                        <tr class="row_ls">
                            <td align="right" class="row_ls">成交额大于1.2亿点差率:</td>
                            <td>
                                    <input name="dc_wan3" type="text" id="dc_wan3" style="width:40px;" value="{{ $data->dc_wan3 }}" maxlength="6"/></td>
                            <td>设置成交额大于1.2亿点差率, 大于0正数值</td>
                        </tr>

                        <tr class="row_ls">
                            <td align="right" class="row_ls">002开头300开头的点差率:</td>
                            <td>
                                    <input name="dc_tou" type="text" id="dc_tou" style="width:40px;" value="{{ $data->dc_tou }}" maxlength="6"/></td>
                            <td>设置002开头300开头的点差率, 大于0正数值</td>
                        </tr>
                        <tr class="row_ls">
                            <td align="right" class="row_ls">股价低于5元的股票点差率:</td>
                            <td>
                                    <input name="dc_di" type="text" id="dc_di" style="width:40px;" value="{{ $data->dc_di }}" maxlength="6"/></td>
                            <td>设置股票股价低于5元的股票点差率, 大于0正数值</td>
                        </tr>

                        <tr class="row_ls">
                            <td align="right" class="row_ls">会员爆仓百分比:</td>
                            <td>
                                    <input name="baocang_precent" type="text" id="baocang_precent" style="width:40px;" value="{{ $data->baocang_precent }}" maxlength="2"/></td>
                            <td>会员亏损达到保证金的该百分比时,将爆仓</td>
                        </tr>
                        
                        <tr class="row_ls">
                            <td height="50" align="right" class="row_ls">&nbsp;</td>
                            <td colspan="2"><input type="submit" id="submit" name="Submit" class="btn" form="form1" value="确认"/></td>
                        </tr> 
                    </form> 
                </table> 

                </div>
            </div>
        </div>
    </div>
</div>

@endsection