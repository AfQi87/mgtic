<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NivelSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('nivel')->delete();
    $nivel = [
      [
        'desc_nivel' => 'Técnico Profesional (relativo a programas Técnicos Profesionales)',
        'categoria' => 'Pregrado',
      ],
      [
        'desc_nivel' => 'Tecnológico (relativo a programas tecnológicos).',
        'categoria' => 'Pregrado',
      ],
      [
        'desc_nivel' => 'Profesional (relativo a programas profesionales universitarios)',
        'categoria' => 'Pregrado',
      ],
      [
        'desc_nivel' => 'Especializaciones (relativas a programas de Especialización Técnica Profesional, Tecnológica y Profesional).',
        'categoria' => 'Posgrado',
      ],
      [
        'desc_nivel' => 'Maestrías',
        'categoria' => 'Posgrado',
      ],
      [
        'desc_nivel' => 'Doctorados',
        'categoria' => 'Posgrado',
      ]
    ];
    DB::table('nivel')->insert($nivel);
  }
}
