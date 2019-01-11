<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('superadmin'),
            'barangay_id' => 1,
            'is_verified' => 1,
            'is_admin' => 1,
            'is_superadmin' => 1,
        ]);
    }
}
