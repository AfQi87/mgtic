<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadoCivilSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('estado_civil')->delete();
    $estado_civil = [
      [
        'descripcion' => 'Soltero',
      ],
      [
        'descripcion' => 'Casado',
      ],
      [
        'descripcion' => 'Viudo',
      ],
      [
        'descripcion' => 'Unión Libre',
      ],
      [
        'descripcion' => 'Separado',
      ]
    ];
    DB::table('estado_civil')->insert($estado_civil);
  }
}
