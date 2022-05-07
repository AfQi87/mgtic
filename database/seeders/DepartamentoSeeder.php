<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Departamento')->delete();
        $depto = [
            [
                'id_departamento' => '1',
                'nom_departamento' => 'nariño',
                'pais' => '1'
            ]

        ];
        DB::table('Departamento')->insert($depto);
    }
}
