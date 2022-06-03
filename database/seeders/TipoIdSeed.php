<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoIdSeed extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('tipo_id')->delete();
    $tipo = [
      [
        'nom_tipo' => 'CC',
        'descripcion' => 'Cedula de ciudadanía'
      ],
      [
        'nom_tipo' => 'CE',
        'descripcion' => 'Cedula de extranjería'
      ],
      [
        'nom_tipo' => 'TI',
        'descripcion' => 'Tarjeta de identidad'
      ],
      [
        'nom_tipo' => 'PAP',
        'descripcion' => 'Pasaporte'
      ]

    ];
    DB::table('tipo_id')->insert($tipo);
  }
}
