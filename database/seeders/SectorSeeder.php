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
    DB::table('Sector')->delete();
    $sectores = [
      [
        'nom_sector' => 'Oficial'
      ],
      [
        'nom_sector' => 'Privado'
      ]
    ];
    DB::table('Sector')->insert($sectores);
  }
}
