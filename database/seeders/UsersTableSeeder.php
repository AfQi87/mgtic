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
    // DB::table('users')->delete();

    DB::table('users')->insert([
      'name' => 'Admin',
      'email' => 'admin@admin.com',
      'email_verified_at' => now(),
      'password' => Hash::make('secret'),
      'telefono' => '000000000',
      'foto' => null,
      'cargo_id' => 1,
      'rol_id' => 1,
      'estado_id' => 1,
      'created_at' => now(),
      'updated_at' => now()
    ]);
  }
}
