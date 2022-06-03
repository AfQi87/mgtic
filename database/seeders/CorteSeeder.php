<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CorteSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('cohorte')->delete();
    $cohorte = [
      [
        'desc_cohorte' => 'Corte seeder 1',
        'fecha_inicio' => now(),
        'fecha_fin' => now()
      ],
      [
        'desc_cohorte' => 'Corte seeder 2',
        'fecha_inicio' => now(),
        'fecha_fin' => now()
      ],
      [
        'desc_cohorte' => 'Corte seeder 3',
        'fecha_inicio' => now(),
        'fecha_fin' => now()
      ],
      [
        'desc_cohorte' => 'Corte seeder 4',
        'fecha_inicio' => now(),
        'fecha_fin' => now()
      ]

    ];
    DB::table('cohorte')->insert($cohorte);
  }
}
