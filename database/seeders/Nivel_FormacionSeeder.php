<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class Nivel_FormacionSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('Nivel_Formacion')->delete();
    $sectores = [
      [
        'nom_nivel' => 'Pregrado'
      ],
      [
        'nom_nivel' => 'Posgrado'
      ]
    ];
    DB::table('Nivel_Formacion')->insert($sectores);
  }
}
