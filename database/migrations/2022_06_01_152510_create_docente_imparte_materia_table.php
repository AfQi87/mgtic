<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocenteImparteMateriaTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('docente_imparte_materia', function (Blueprint $table) {
      $table->string('docente', 15);
      $table->unsignedInteger('materia');
      $table->string('resolucion', 100);
      $table->unsignedInteger('cohorte');
      $table->date('fecha_inicio');
      $table->date('fecha_fin');


      $table->foreign('docente')->references('ced_persona')->on('docente');
      $table->foreign('materia')->references('id_materia')->on('materia');
      $table->foreign('cohorte')->references('id_cohorte')->on('cohorte');

      $table->primary(['docente', 'materia']);
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
    Schema::dropIfExists('docente_imparte_materia');
  }
}
