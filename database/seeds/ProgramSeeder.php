<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $programs = array(
        	'Maternal Care',
        	'Family Planning',
        	'Child Care',
        	'Dental Health',
        	'Malaria',
        	'Tuberculosis',
        	'Filariasis',
        	'Leprosy',
        	'Schitosomiasis',
        	'Morbidity Disease',
        	'Natality',
        	'Environmental Health',
        	'Mortality'
        );

        foreach ($programs as $program) {
        	DB::table('programs')->insert([
        		'name'	=> $program,
        		'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        		'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        	]);
        }
    }
}
