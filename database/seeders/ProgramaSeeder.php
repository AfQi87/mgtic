<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgramaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Programa')->delete();
        $institucion = [
            [
                'id_programa' => '1',
                'nom_programa' => 'Ingeniería de sistemas',
                'nivel' => 1,
                'institucion' => '1'
            ]

        ];
        DB::table('Programa')->insert($institucion);
    }
}
