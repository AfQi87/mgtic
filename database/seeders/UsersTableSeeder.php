<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('users')->insert([
      'name' => 'Admin Admin',
      'email' => 'admin@material.com',
      'email_verified_at' => now(),
      'password' => Hash::make('secret'),
      'telefono' => '1234567890',
      'foto' => 'aaaaaaaaaaa',
      'cargo_id' => 1,
      'rol_id' => 1,
      'estado_id' => 1,
      'created_at' => now(),
      'updated_at' => now()
    ]);
  }
}
