<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SectorSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('sector')->delete();
    $sectores = [
      [
        'descripcion' => 'Oficial'
      ],
      [
        'descripcion' => 'Privado'
      ]
    ];
    DB::table('sector')->insert($sectores);
  }
}
