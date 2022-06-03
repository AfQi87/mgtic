<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SexoSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('sexo')->delete();
    $sexo = [
      [
        'descripcion' => 'Femenino',
      ],
      [
        'descripcion' => 'Masculino',
      ]

    ];
    DB::table('sexo')->insert($sexo);
  }
}
