<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReunionSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('reunion')->delete();
    $reunion = [
      [
        'tipo' => 'Ordinaria'
      ],
      [
        'tipo' => 'Extraordinaria'
      ],
      [
        'tipo' => 'Obligatoria'
      ]
    ];
    DB::table('reunion')->insert($reunion);
  }
}
