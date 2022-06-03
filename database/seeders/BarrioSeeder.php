<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarrioSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('barrio')->delete();
    $barrio = [
      [
        'nom_barrio' => 'Palermo',
        'municipio' => '1'
      ],
      [
        'nom_barrio' => 'San Vicente',
        'municipio' => '2'
      ],
      [
        'nom_barrio' => 'San Jose',
        'municipio' => '3'
      ],

    ];
    DB::table('barrio')->insert($barrio);
  }
}
