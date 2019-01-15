<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Question;

class ProgramAnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $questions = Question::all();
        foreach ($questions as $question) {
        	DB::table('program_question')->insert([
        		'program_id' => 8,
        		'question_id' => $question->id,
        		'gender'	=> 'M',
        		'answer' 	=> '3',
        		'created_at'=> Carbon::now()->format('Y-m-d H:i:s'),
        		'updated_at'=> Carbon::now()->format('Y-m-d H:i:s'),
        	]);
        	DB::table('program_question')->insert([
        		'program_id' => 8,
        		'question_id' => $question->id,
        		'gender'	=> 'F',
        		'answer' 	=> '6',
        		'created_at'=> Carbon::now()->format('Y-m-d H:i:s'),
        		'updated_at'=> Carbon::now()->format('Y-m-d H:i:s'),
        	]);
        	DB::table('program_question')->insert([
        		'program_id' => 8,
        		'question_id' => $question->id,
        		'gender'	=> 'T',
        		'answer' 	=> '2',
        		'created_at'=> Carbon::now()->format('Y-m-d H:i:s'),
        		'updated_at'=> Carbon::now()->format('Y-m-d H:i:s'),
        	]);
        }
    }
}
