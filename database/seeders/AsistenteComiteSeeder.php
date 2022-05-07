<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AsistenteComiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('asistente_comite')->delete();
        $asistentes = [
            [
                'nombre' => 'ESTRADA LUIS OBEYMAR',
                'cargo' => 'Presidente Comité Curricular MGTIC',
                'dependencia' => 'Comité Curricular Maestrías Departamento de Sistemas'
            ],
            [
                'nombre' => 'TIMARAN PEREIRA RICARDO',
                'cargo' => 'Coordinador MGTIC',
                'dependencia' => 'Comité Curricular Maestrías Departamento de Sistemas'
            ],
            [
                'nombre' => 'REVELO SANCHEZ OSCAR ',
                'cargo' => 'Coordinador MISC',
                'dependencia' => 'Comité Curricular Maestrías Departamento de Sistemas'
            ],
            [
                'nombre' => 'BURGOS CESAR ESTEBAN',
                'cargo' => 'Representante Profesoral MGTIC',
                'dependencia' => 'Comité Curricular Maestrías Departamento de Sistemas'
            ],
            [
                'nombre' => 'ROSERO MAURICIO',
                'cargo' => 'Representante estudiantil Segunda Promoción MISC',
                'dependencia' => 'Comité Curricular Maestrías Departamento de Sistemas'
            ],
            [
                'nombre' => 'JURADO PAREDES MELISA',
                'cargo' => 'Asistente MISC',
                'dependencia' => 'Comité Curricular Maestrías Departamento de Sistemas'
            ],
            [
                'nombre' => 'GUERRERO CALVACHE SANDRA MARCELA',
                'cargo' => 'Asistente MGTIC',
                'dependencia' => 'Comité Curricular Maestrías Departamento de Sistemas'
            ]

        ];
        DB::table('asistente_comite')->insert($asistentes);
    }
}
