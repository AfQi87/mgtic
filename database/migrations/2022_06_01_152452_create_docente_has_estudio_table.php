<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocenteHasEstudioTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('docente_has_estudio', function (Blueprint $table) {
      $table->string('docente', 15);
      $table->unsignedInteger('estudio');
      $table->string('institucion', 15);


      $table->foreign('docente')->references('ced_persona')->on('docente');
      $table->foreign('estudio')->references('id_estudio')->on('estudio');
      $table->foreign('institucion')->references('id_institucion')->on('institucion');

      $table->primary(['docente', 'estudio']);
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
    Schema::dropIfExists('docente_has_estudio');
  }
}
