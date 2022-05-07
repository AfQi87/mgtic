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
        'id' => 1,
        'estado' => 'Activo'
      ],
      [
        'id' => 2,
        'estado' => 'Inactivo'
      ]

    ];
    DB::table('estado')->insert($estado);
  }
}
