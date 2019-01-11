<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Barangay;
use App\Summary;

class BarangaySummarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $barangays = Barangay::all();
        $summaries = Summary::all();

        foreach ($barangays as $barangay) {
        	foreach ($summaries as $summary) {
        		DB::table('barangay_summary')->insert([
        			'barangay_id' => $barangay->id,
        			'summary_id'  => $summary->id
        		]);
        	}
        }
    }
}
