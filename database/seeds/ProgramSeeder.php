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
            array(
                'name' => 'Maternal Care',
                'header_type' => 'date',
                'with_gender' => false,
                'with_trans' => false,
                'with_target' => true,
                'with_total' => true,
                'with_ico_code' => false,
            ),
            array(
                'name' => 'Family Planning',
                'header_type' => 'date',
                'with_gender' => false,
                'with_trans' => false,
                'with_target' => true,
                'with_total' => true,
                'with_ico_code' => false,
            ),
            array(
                'name' => 'Child Care',
                'header_type' => 'date',
                'with_gender' => true,
                'with_trans' => false,
                'with_target' => true,
                'with_total' => true,
                'with_ico_code' => false,
            ),
            array(
                'name' => 'Dental Health',
                'header_type' => 'date',
                'with_gender' => true,
                'with_trans' => false,
                'with_target' => true,
                'with_total' => true,
                'with_ico_code' => false,
            ),
            array(
                'name' => 'Malaria',
                'header_type' => 'date',
                'with_gender' => true,
                'with_trans' => true,
                'with_target' => false,
                'with_total' => true,
                'with_ico_code' => false,   
            ),
            array(
                'name' => 'Tuberculosis',
                'header_type' => 'quarterly',
                'with_gender' => true,
                'with_trans' => true,
                'with_target' => false,
                'with_total' => true,
                'with_ico_code' => false,
            ),
            array(
                'name' => 'Filariasis',
                'header_type' => 'date',
                'with_gender' => true,
                'with_trans' => true,
                'with_target' => false,
                'with_total' => true,
                'with_ico_code' => false,
            ),
            array(
                'name' => 'Leprosy',
                'header_type' => 'date',
                'with_gender' => true,
                'with_trans' => true,
                'with_target' => false,
                'with_total' => true,
                'with_ico_code' => false,
            ),
            array(
                'name' => 'Schitosomiasis',
                'header_type' => 'date',
                'with_gender' => true,
                'with_trans' => true,
                'with_target' => false,
                'with_total' => true,
                'with_ico_code' => false,
            ),
            array(
                'name' => 'Morbidity Disease',
                'header_type' => 'age_monthly',
                'with_gender' => true,
                'with_trans' => false,
                'with_target' => false,
                'with_total' => true,
                'with_ico_code' => true,
            ),
            array(
                'name' => 'Natality',
                'header_type' => 'date',
                'with_gender' => true,
                'with_trans' => false,
                'with_target' => true,
                'with_total' => true,
                'with_ico_code' => false,
            ),
            array(
                'name' => 'Environmental Health',
                'header_type' => 'date',
                'with_gender' => false,
                'with_trans' => false,
                'with_target' => true,
                'with_total' => true,
                'with_ico_code' => false,
            ),
            array(
                'name' => 'Mortality',
                'header_type' => 'date',
                'with_gender' => true,
                'with_trans' => false,
                'with_target' => true,
                'with_total' => true,
                'with_ico_code' => false,
            ),
        );

        foreach ($programs as $program) {
        	DB::table('programs')->insert([
        		'name'            => $program['name'],
                'header_type'     => $program['header_type'],
                'with_gender'     => $program['with_gender'],
                'with_trans'      => $program['with_trans'],
                'with_target'     => $program['with_target'],
                'with_total'      => $program['with_total'],
                'with_ico_code'   => $program['with_ico_code'],
        		'created_at'      => Carbon::now()->format('Y-m-d H:i:s'),
        		'updated_at'      => Carbon::now()->format('Y-m-d H:i:s')
        	]);
        }
    }
}
