<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoSangreSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('tipo_sangre')->delete();
    $tipo_sangre = [
      [
        'descripcion' => 'A',
      ],
      [
        'descripcion' => 'AB',
      ],
      [
        'descripcion' => 'B',
      ],
      [
        'descripcion' => 'O',
      ]
    ];
    DB::table('tipo_sangre')->insert($tipo_sangre);
  }
}
