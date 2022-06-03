<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocenteHasAreaConocimientoTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('docente_has_area_conocimiento', function (Blueprint $table) {
      $table->string('docente', 15);
      $table->unsignedInteger('area_con');


      $table->foreign('docente')->references('ced_persona')->on('docente');
      $table->foreign('area_con')->references('id_area')->on('area_conocimiento');

      $table->primary(['docente', 'area_con']);
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
    Schema::dropIfExists('docente_has_area_conocimiento');
  }
}
