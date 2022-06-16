<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonaSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('persona')->delete();
    $persona = [
      [
        'ced_persona' => '1111111111',
        'tipo_doc' => 1,
        'nom_persona' => 'persona seeder 1',
        'email_persona' => 'persona1@gmail.com',
        'tel_persona' => '1111111111',
        'cel_persona' => '1111111111',
        'sexo' => 1,
        'estado_civil' => 1,
        'tipo_sangre' => 1,
        'fecha_nac' => '1999-01-01',
        'lugar_nac' => 1,
        'direccion' => 'direccion persona 1',
        'barrio' => 1,
        'foto' => ''
      ],
      [
        'ced_persona' => '222222222',
        'tipo_doc' => 1,
        'nom_persona' => 'persona seeder 2',
        'email_persona' => 'persona2@gmail.com',
        'tel_persona' => '222222222',
        'cel_persona' => '222222222',
        'sexo' => 1,
        'estado_civil' => 1,
        'tipo_sangre' => 1,
        'fecha_nac' => '1999-01-01',
        'lugar_nac' => 1,
        'direccion' => 'direccion persona 2',
        'barrio' => 1,
        'foto' => ''
      ],
      [
        'ced_persona' => '3333333333',
        'tipo_doc' => 1,
        'nom_persona' => 'persona seeder 3',
        'email_persona' => 'persona3@gmail.com',
        'tel_persona' => '3333333333',
        'cel_persona' => '3333333333',
        'sexo' => 1,
        'estado_civil' => 1,
        'tipo_sangre' => 1,
        'fecha_nac' => '1999-01-01',
        'lugar_nac' => 1,
        'direccion' => 'direccion persona 3',
        'barrio' => 1,
        'foto' => ''
      ]

    ];
    DB::table('persona')->insert($persona);
  }
}
