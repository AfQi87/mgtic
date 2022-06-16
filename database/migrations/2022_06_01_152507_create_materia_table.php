<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMateriaTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('materia', function (Blueprint $table) {
      $table->increments('id_materia');
      $table->string('nom_materia', 200);
      $table->integer('num_creditos');
      $table->integer('semestre');
      $table->string('foa', 100);
      $table->unsignedInteger('area_form');

      $table->foreign('area_form')->references('id_area')->on('area_formacion');

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
    Schema::dropIfExists('materia');
  }
}
