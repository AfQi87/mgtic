<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MunicipioSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('municipio')->delete();
    $municipio = [
      [
        'id_municipio' => '1',
        'nom_municipio' => 'Pasto',
        'departamento' => '1'
      ],[
        'id_municipio' => '2',
        'nom_municipio' => 'Ipiales',
        'departamento' => '1'
      ],[
        'id_municipio' => '3',
        'nom_municipio' => 'Tuquerres',
        'departamento' => '1'
      ]

    ];
    DB::table('municipio')->insert($municipio);
  }
}
