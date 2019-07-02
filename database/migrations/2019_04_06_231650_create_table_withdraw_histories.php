<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableWithdrawHistories extends Migration
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
        Schema::create('withdraw_histories', function (Blueprint $table) {
           
                $table->increments('id');
                $table->integer('user_id')->unsigned();
                $table->double('amount');
                $table->string('bank');
                $table->string('bank_name');
                $table->string('status');
                $table->double('before_amount');
                $table->timestamps();
    
                $table->foreign('user_id')
                    ->references('id')->on('users')
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
        $table->dropForeign(['user_id']);
        Schema::drop('withdraw_histories');
    }
}
