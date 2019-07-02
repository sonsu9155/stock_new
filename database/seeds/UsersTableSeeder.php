<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class UsersTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        \DB::table('users')->truncate();

        \DB::table('users')->insert([
            [
                'id'             => 1,
                'username'           => 'superadmin',
                'password'       => Hash::make(123456),
                'name'       => 'admin',  
                'idcard'         => '12345678932165478',     
                'kh_bank'         => '1233445',               
                'bank_name'       =>'丹东银行',
                'bank_card'      =>'111111111111',
                'phone'       => '12345678902',
                'atmpwd'       => '1523',
                'image_url'   =>'/images/upload/superadmin12345678932165478/1.png',
                'status' => 1,
                'money_wallet_id' => 1,
                'stock_wallet_id' => 1,
                'forgot_token' => null,
                'created_at'   => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at'   => \Carbon\Carbon::now()->toDateTimeString(),               
                
            ],
            [
                'id'             => 2,
                'username'           => 'test1',
                'password'       => Hash::make(123456),
                'name'       => 'test_user1',  
                'idcard'         => '5869874',     
                'kh_bank'         => '2222222',               
                'bank_name'       =>'丹东银行',
                'bank_card'      =>'222222222',
                'phone'       => '98765432101',
                'atmpwd'       => '3698',
                'image_url'   =>'/images/upload/test15869874/1.png',
                'status' => 1,
                'money_wallet_id' => 2,
                'stock_wallet_id' => 2,
                'forgot_token' => null,
                'created_at'   => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at'   => \Carbon\Carbon::now()->toDateTimeString(),               
                
            ],
            [
                'id'             => 3,
                'username'           => 'test2',
                'password'       => Hash::make(123456),
                'name'       => 'test_user2',  
                'idcard'         => '33333333',     
                'kh_bank'         => '33333333',               
                'bank_name'       =>'丹东银行',
                'bank_card'      =>'333333333',
                'phone'       => '33333333333',
                'atmpwd'       => '3333',
                'image_url'   =>'/images/upload/test233333333/1.png',
                'status' => 1,
                'money_wallet_id' => 3,
                'stock_wallet_id' => 3,
                'forgot_token' => null,
                'created_at'   => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at'   => \Carbon\Carbon::now()->toDateTimeString(),               
                
            ]
        ]);
    }
}
