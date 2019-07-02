<?php

use Illuminate\Database\Seeder;

class StockWalletsSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        \DB::table('stock_wallets')->truncate();

        \DB::table('stock_wallets')->insert([
            [
                'id'             => 1,
                'before_amount'     => 0,
                'after_amount'     => 90000,
                'created_at'     => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at'     => \Carbon\Carbon::now()->toDateTimeString(),
                
            ],
            [
                'id'             => 2,
                'before_amount'     => 0,
                'after_amount'     => 90000,
                'created_at'     => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at'     => \Carbon\Carbon::now()->toDateTimeString(),
                
            ],
            [
                'id'             => 3,
                'before_amount'     => 0,
                'after_amount'     => 90000,
                'created_at'     => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at'     => \Carbon\Carbon::now()->toDateTimeString(),
                
            ]
        ]);
    }
}