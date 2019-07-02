<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('roles')->truncate();
        $roles = [
            [
                'name' => 'super_admin',
                'display_name' => 'Super Admin',
                'description' => 'Super Admin',
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            ],
            [
                'name' => 'pabrik_admin',
                'display_name' => 'Admin Pabrik',
                'description' => 'Admin Pabrik',
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            ],
            [
                'name' => 'pabrik_admin_timbangan',
                'display_name' => 'Admin Timbangan Pabrik',
                'description' => 'Admin Timbangan Pabrik',
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            ],
            [
                'name' => 'texcare_runner',
                'display_name' => 'Runner',
                'description' => 'Texcare Runner',
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            ],
            [
                'name' => 'texcare_zona_leader',
                'display_name' => 'Zona Leader',
                'description' => 'Zona Leader',
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            ],
            [
                'name' => 'hotel_supervisor',
                'display_name' => 'Hotel Supervisor PIC',
                'description' => '',
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            ],
            [
                'name' => 'hotel_employee',
                'display_name' => 'Hotel Employee',
                'description' => '',
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            ],
        ];
        DB::table('roles')->insert($roles);
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
