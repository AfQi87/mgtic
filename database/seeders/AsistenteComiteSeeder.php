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
    DB::table('participante_comite')->delete();
    $asistentes = [
      [
        'persona' => '1111111111',
        'cargo' => 2
      ],
      [
        'persona' => '222222222',
        'cargo' => 3
      ],
      [
        'persona' => '3333333333',
        'cargo' => 1
      ]

    ];
    DB::table('participante_comite')->insert($asistentes);
  }
}
