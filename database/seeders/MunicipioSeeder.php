<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MunicipioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Municipio')->delete();
        $municipio = [
            [
                'id_municipio' => '1',
                'nom_municipio' => 'Pasto',
                'departamento' => '1'
            ]

        ];
        DB::table('Municipio')->insert($municipio);
    }
}
