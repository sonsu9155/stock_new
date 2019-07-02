<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSellHistories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::enableForeignKeyConstraints();
        Schema::create('sell_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('stock_type_id')->unsigned();
            $table->string('buy_cost');
            $table->string('buy_fee');
            $table->string('sell_fee');
            $table->string('state_fee');
            $table->timestamp('buy_time');
            $table->string('amount');
            $table->string('sell_cost');
            $table->string('method');
            $table->string('before_amount');
            $table->string('save_fee');
            $table->string('fee');
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->foreign('stock_type_id')
                ->references('id')->on('stock_types')
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
        //
        $table->dropForeign(['user_id' , 'stock_type_id']);
        Schema::drop('sell_histories');
    }
}
