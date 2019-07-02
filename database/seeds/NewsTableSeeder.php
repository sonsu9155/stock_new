<?php

use Illuminate\Database\Seeder;

class NewsTableSeeder extends Seeder
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
        \DB::table('news')->truncate();

        \DB::table('news')->insert([
            [
                'id'             => 1,
                'type'     => 1,
                'subject'     => 'welcome',
                'contents'     => '欢迎访问我们的网站',
                'created_at'     => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at'     => \Carbon\Carbon::now()->toDateTimeString(),
                
            ]
        ]);
    }
}
