<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstudianteTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('Estudiante', function (Blueprint $table) {
      $table->increments('id');
      $table->string('nombre', 150);
      $table->string('codigo', 15);
      $table->string('correo', 100);
      $table->string('telefono', 30);
      $table->string('foto', 100);
      $table->string('profesion', 100);
      $table->unsignedInteger('corte_id');
      $table->unsignedInteger('estado_id');

      $table->foreign('corte_id')->references('id')->on('Corte');
      $table->foreign('estado_id')->references('id')->on('estado');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('Estudiante');
  }
}
