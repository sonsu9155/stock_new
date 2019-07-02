<?php

use Illuminate\Database\Seeder;

class SettingTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        \DB::table('settings')->truncate();

        \DB::table('settings')->insert([
            [
                'open_xitong'        => '1',
                'open_AM_Start'      => '09:31',
                'open_AM_End'      => '11:25',
                'open_PM_Start'      => '13:01',
                'open_PM_End'      => '14:55',
                'sell_AM_Start'      => '09:31',
                'sell_AM_End'      => '11:25',
                'sell_PM_Start'      => '13:01',
                'sell_PM_End'      => '14:55',
                'atm_AM_Start'      => '9:00',
                'atm_AM_End'      => '12:00',
                'atm_PM_Start'      => '12:00',
                'atm_PM_End'      => '23:30',
                'max_tries'      => '60',
                'trust_num'      => '6',
                'system_safeguard'      => 'off',
                'system_safeguard_direc'      => '系统维护中...',
                'user_regex'      => '/^[a-zA-Z0-9_x7f-xff]*$/',
                'agent_prefix'      => '0',
                'agent_min'      => '4',
                'agent_max'      => '12',
                'user_member_prefix'      => '1',
                'user_member_min'      => '3',
                'user_member_max'      => '15',
                'min_password'      => '4',
                'max_password'      => '12',
                'user_name_min'      => '1',
                'user_name_max'      => '12',
                'cookie_length'      => '86400',
                'cost_bull_max'      => '0.0015',
                'cost_sell_max'      => '0.0015',
                'cost_save_max'      => '0',
                'cost_save_day'      => '999',
                'cost_state_max'    => '0.002',    ////인장비
                'cost_daily_max'    => '0.003',    ////매일 리자
                'cost_ret_max'      => '10',
                'sel_max_time'      => '15',
                'cost_sell_limit'      => '0.008',
                'rest_filter'      => '0',
                'buy_sd'      => '7.5',
                'st_buy_sd'      => '3.5',
                'turnover_min'      => '1',
                'minmoney'      => '1',
                'num_max'      => '10000',
                'num_min'      => '1',
                'cost_exchange_rate'      => '10',
                'money_percent'      => '90',
                'lower_cash'      => '800',
                'up_float'      => '0.001',
                'down_float'      => '0.001',
                'dc5'      => '0',
                'dc6'      => '0',
                'dc7'      => '0',
                'dc8'      => '0',
                'dc9'      => '0',
                'dc_wan'      => '0',
                'dc_wan2'      => '0',
                'dc_wan3'      => '0',
                'dc_tou'      => '0',
                'dc_di'      => '0',
                'baocang_precent'      => '80',
                'created_at'     => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at'     => \Carbon\Carbon::now()->toDateTimeString(),
                
            ]
        ]);
    }
}
