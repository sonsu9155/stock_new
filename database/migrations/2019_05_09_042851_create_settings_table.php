<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('open_xitong');
            $table->string('open_AM_Start');
            $table->string('open_AM_End');
            $table->string('open_PM_Start');
            $table->string('open_PM_End');
            $table->string('sell_AM_Start');
            $table->string('sell_AM_End');
            $table->string('sell_PM_Start');
            $table->string('sell_PM_End');
            $table->string('atm_AM_Start');
            $table->string('atm_AM_End');
            $table->string('atm_PM_Start');
            $table->string('atm_PM_End');
            $table->string('max_tries');
            $table->string('trust_num');
            $table->string('system_safeguard');
            $table->string('system_safeguard_direc');
            $table->string('user_regex');
            $table->string('agent_prefix');
            $table->string('agent_min');
            $table->string('agent_max');
            $table->string('user_member_prefix');
            $table->string('user_member_min');
            $table->string('user_member_max');
            $table->string('min_password');
            $table->string('max_password');
            $table->string('user_name_min');
            $table->string('user_name_max');
            $table->string('cookie_length');
            $table->string('cost_bull_max');
            $table->string('cost_sell_max');
            $table->string('cost_save_max');
            $table->string('cost_save_day');
            $table->string('cost_state_max');    ///인장비
            $table->string('cost_daily_max');    ///매일수수료
            $table->string('cost_ret_max');
            $table->string('sel_max_time');
            $table->string('cost_sell_limit');
            $table->string('rest_filter');
            $table->string('buy_sd');
            $table->string('st_buy_sd');
            $table->string('turnover_min');
            $table->string('minmoney');
            $table->string('num_max');
            $table->string('num_min');
            $table->string('cost_exchange_rate');
            $table->string('money_percent');
            $table->string('lower_cash');
            $table->string('up_float');
            $table->string('down_float');
            $table->string('dc5');
            $table->string('dc6');
            $table->string('dc7');
            $table->string('dc8');
            $table->string('dc9');
            $table->string('dc_wan');
            $table->string('dc_wan2');
            $table->string('dc_wan3');
            $table->string('dc_tou');
            $table->string('dc_di');
            $table->string('baocang_precent');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
