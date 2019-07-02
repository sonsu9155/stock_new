<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::create('users', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('username');
            $table->string('password');
            $table->string('name');
            $table->string('idcard');
            $table->string('kh_bank');
            $table->string('bank_name');
            $table->string('bank_card');
            $table->string('phone');
            $table->string('atmpwd');
            $table->string('image_url');
            $table->integer('status');
            $table->integer('money_wallet_id')->unsigned();
            $table->integer('stock_wallet_id')->unsigned();
            $table->string('forgot_token', 100)->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('money_wallet_id')
                ->references('id')->on('money_wallets')
                ->onDelete('cascade');
            $table->foreign('stock_wallet_id')
                ->references('id')->on('stock_wallets')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table->dropForeign(['money_wallet_id' , 'stock_wallet_id']);
        Schema::drop('users');
    }
}
