<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InstitucionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('institucion')->delete();
        $institucion = [
            [
                'id_institucion' => '1',
                'nom_institucion' => 'Universidad de Nariño',
                'tipo' => 4,
                'municipio' => '1',
                'sector' => 1,
            ]

        ];
        DB::table('institucion')->insert($institucion);
    }
}
