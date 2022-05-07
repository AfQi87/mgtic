<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaisSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('Pais')->delete();
    $pais = [
      [
        'id_pais' => '1',
        'nom_pais' => 'Colombia'
      ]

    ];
    DB::table('Pais')->insert($pais);
  }
}
