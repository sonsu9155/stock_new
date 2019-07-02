<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(RoleSeeder::class);
        // $this->call(RoleUserSeeder::class);
        $this->call(StockTypesSeeder::class);
        $this->call(MoneyWalletsSeeder::class);
        $this->call(StockWalletsSeeder::class);
        $this->call(BuyHistoriesSeeder::class);
        $this->call(NewsTableSeeder::class);
        $this->call(SettingTableSeed::class);
        $this->call(LaratrustSeeder::class);
    }
}
