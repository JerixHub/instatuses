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
        $questions=array(
            'Total Population',
            'Total No. Leprosy cases(undergoing tx)',
            'No. of newly detected leprosy cases',
            '< 15y/o',
            'Grade 2 disability',
            'No. of Leprosy cases cured',
        );

        foreach ($questions as $question) {
        	DB::table('questions')->insert([
        		'name' => $question,
        		'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        		'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        	]);
        }

    }
}
