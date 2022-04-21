<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('Tipo')->delete();
    $tipos = [
      [
        'nom_tipo' => 'Institución Técnica Profesional'
      ],
      [
        'nom_tipo' => 'Institución Tecnológica'
      ],
      [
        'nom_tipo' => 'Institución Universitaria'
      ],
      [
        'nom_tipo' => 'Universidad'
      ]
    ];
    DB::table('Tipo')->insert($tipos);
  }
}
