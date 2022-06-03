<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstudianteHasEstudioTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('estudiante_has_estudio', function (Blueprint $table) {
      $table->string('estudiante', 15);
      $table->unsignedInteger('estudio');
      $table->string('institucion', 15);


      $table->foreign('estudiante')->references('ced_persona')->on('estudiante');
      $table->foreign('estudio')->references('id_estudio')->on('estudio');
      $table->foreign('institucion')->references('id_institucion')->on('institucion');

      $table->primary(['estudiante', 'estudio']);
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
    Schema::dropIfExists('estudiante_has_estudio');
  }
}
