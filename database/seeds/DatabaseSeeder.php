<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	$this->call(BarangaySeeder::class);
        $this->call(SuperAdminSeeder::class);
        $this->call(ProgramSeeder::class);
        $this->call(QuestionSeeder::class);
    }
}
