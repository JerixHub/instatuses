<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BarangaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $barangays = array(
            'Brillante (Poblacion)',
            'Bulawan',
            'Calao',
            'Carayat',
            'Diamante',
            'Gogon',
            'Lupi',
            'Maningcay De Oro',
            'Manlabong',
            'Perlas',
            'Quidolog',
            'Rizal',
            'San Antonio',
            'San Fernando',
            'San Isidro',
            'San Juan',
            'San Rafael',
            'San Ramon',
            'Santa Lourdes',
            'Santo Domingo',
            'Talisayan',
            'Tupaz',
            'Ulag'
        );

        foreach ($barangays as $barangay) {
        	DB::table('barangays')->insert([
        		'name'	=> $barangay,
        		'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        		'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        	]);
        }
    }
}
