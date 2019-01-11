<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Program;

class SummarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $programs = Program::all();
        foreach ($programs as $program) {
        	DB::table('summaries')->insert([
        		'program_id' => $program->id,
        		'is_gender_activated' => false,
        		'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        		'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        	]);
        }
    }
}
