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
        DB::table('programa')->delete();
        $institucion = [
            [
                'id_programa' => '1',
                'nom_programa' => 'Ingeniería de sistemas',
                'nivel' => 7,
                'institucion' => '1'
            ],
            [
                'id_programa' => '2',
                'nom_programa' => 'Ingeniería civil',
                'nivel' => 8,
                'institucion' => '1'
            ]

        ];
        DB::table('programa')->insert($institucion);
    }
}
