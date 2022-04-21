<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCorteTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('Corte', function (Blueprint $table) {
      $table->increments('id');
      $table->string('nombre', 100);
      $table->bigInteger('numEstudiantes');
      $table->date('fecha_ini');
      $table->date('fecha_fin');
      $table->unsignedInteger('estado_id');

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
    Schema::dropIfExists('Corte');
  }
}
