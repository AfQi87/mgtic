<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AsistenteSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('asistente')->delete();
    $asistentes = [
      [
        'nombre' => 'ESTRADA LUIS OBEYMAR',
        'cargo' => 'Presidente Comité Curricular MGTIC',
        'dependencia' => 'Comité Curricular MGTIC'
      ],
      [
        'nombre' => 'TIMARAN PEREIRA RICARDO',
        'cargo' => 'Coordinador MGTIC',
        'dependencia' => 'Comité Curricular MGTIC'
      ],
      [
        'nombre' => 'BURGOS CESAR ESTEBAN',
        'cargo' => 'Representante Profesoral',
        'dependencia' => 'Comité Curricular MGTIC'
      ],
      [
        'nombre' => 'ROSERO IBARRA JESUS',
        'cargo' => 'Representante estudiantil Segunda Promoción MGTIC',
        'dependencia' => 'Comité Curricular MGTIC'
      ],
      [
        'nombre' => 'GUERRERO CALVACHE SANDRA MARCELA',
        'cargo' => 'Asistente MGTIC',
        'dependencia' => 'Comité Curricular MGTIC'
      ]

    ];
    DB::table('asistente')->insert($asistentes);
  }
}
