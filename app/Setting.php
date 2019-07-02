<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    //
    protected $table = 'settings';
    protected $fillable = [
        'open_xitong',
        'open_AM_Start',
        'open_AM_End',
        'open_PM_Start',
        'open_PM_End',
        'sell_AM_Start',
        'sell_AM_End',
        'sell_PM_Start',
        'sell_PM_End',
        'atm_AM_Start',
        'atm_AM_End',
        'atm_PM_Start',
        'atm_PM_End',
        'max_tries',
        'trust_num',
        'system_safeguard',
        'system_safeguard_direc',
        'user_regex',
        'agent_prefix',
        'agent_min',
        'agent_max',
        'user_member_prefix',
        'user_member_min',
        'user_member_max',
        'min_password',
        'max_password',
        'user_name_min',
        'user_name_max',
        'cookie_length',
        'cost_bull_max',
        'cost_sell_max',
        'cost_save_max',
        'cost_save_day',
        'cost_state_max',
        'cost_daily_max',               ////////매일 리자  
        'cost_ret_max',
        'sel_max_time',
        'cost_sell_limit',
        'rest_filter',
        'buy_sd',
        'st_buy_sd',
        'turnover_min',
        'minmoney',
        'num_max',
        'num_min',
        'cost_exchange_rate',
        'money_percent',
        'lower_cash',
        'up_float',
        'down_float',
        'dc5',
        'dc6',
        'dc7',
        'dc8',
        'dc9',
        'dc_wan',
        'dc_wan2',
        'dc_wan3',
        'dc_tou',
        'dc_di',
        'baocang_precent',
        ];
    
}
