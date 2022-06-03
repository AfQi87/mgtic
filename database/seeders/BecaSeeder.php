<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BecaSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('beca')->delete();
    $beca = [
      [
        'desc_beca' => 'Egresado Distinguido',
      ],
      [
        'desc_beca' => 'Beca Trabajador Sintraunicol',
      ],
      [
        'desc_beca' => 'Beca Icetex (Un Ticket para el futuro)',
      ]

    ];
    DB::table('beca')->insert($beca);
  }
}
