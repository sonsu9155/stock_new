<?php

use Illuminate\Database\Seeder;

class MoneyWalletsSeeder extends Seeder
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
        \DB::table('money_wallets')->truncate();

        \DB::table('money_wallets')->insert([
            [
                'id'             => 1,
                'before_amount'     => 0,
                'after_amount'     => 100000,
                'created_at'   => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at'   => \Carbon\Carbon::now()->toDateTimeString(),    
            ],
            [
                'id'             => 2,
                'before_amount'     => 0,
                'after_amount'     => 100000,
                'created_at'   => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at'   => \Carbon\Carbon::now()->toDateTimeString(),    
            ],
            [
                'id'             => 3,
                'before_amount'     => 0,
                'after_amount'     => 100000,
                'created_at'   => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at'   => \Carbon\Carbon::now()->toDateTimeString(),    
            ]
        ]);
    }
}
