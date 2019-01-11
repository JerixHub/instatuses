<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $questions_array=array(
        	array(
        		'name' 			=> 'Total Population',
        		'program_id' 	=> 8
        	),
        	array(
        		'name' 			=> 'Total No. Leprosy cases(undergoing tx)',
        		'program_id' 	=> 8
        	),
        	array(
        		'name' 			=> 'No. of newly detected leprosy cases',
        		'program_id' 	=> 8
        	),
        	array(
        		'name' 			=> '< 15y/o',
        		'program_id' 	=> 8
        	),
        	array(
        		'name' 			=> 'Grade 2 disability',
        		'program_id' 	=> 8
        	),
        	array(
        		'name' 			=> 'No. of Leprosy cases cured',
        		'program_id' 	=> 8
        	),
        );

        foreach ($questions_array as $questions) {
        	DB::table('questions')->insert([
        		'name' => $questions['name'],
        		'program_id' => $questions['program_id'],
        		'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        		'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        	]);
        }

    }
}
