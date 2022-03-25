<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CargoTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('cargo')->delete();
    $cargo = [
      [
        'id' => '1',
        'cargo' => 'Presidente'
      ],
      [
        'id' => '2',
        'cargo' => 'Secretaria'
      ],
      [
        'id' => '3',
        'cargo' => 'Administrativo'
      ]

    ];
    DB::table('cargo')->insert($cargo);
  }
}
