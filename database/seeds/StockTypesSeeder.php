<?php

use Illuminate\Database\Seeder;

class StockTypesSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        \DB::table('stock_types')->truncate();

        \DB::table('stock_types')->insert([
            [
                'id'             => 1,
                'option'     => '0',
                'code'     => '600111',
                'cn_name'     => '北方稀土',
                'created_at'     => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at'     => \Carbon\Carbon::now()->toDateTimeString(),
                
            ]
        ]);
    }
}