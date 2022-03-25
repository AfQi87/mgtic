<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EstadoTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('estado')->delete();
    $estado = [
      [
        'id' => 0,
        'estado' => 'Inactivo'
      ],
      [
        'id' => 1,
        'estado' => 'Activo'
      ]

    ];
    DB::table('estado')->insert($estado);
  }
}
