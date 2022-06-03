<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrabajoGradoTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('trabajo_grado', function (Blueprint $table) {
      $table->increments('id_tg');
      $table->string('nom_tg', 300);
      $table->integer('num_acuerdo_jr');
      $table->string('acuerdo_js', 45);
      $table->date('fecha_ins');
      $table->string('num_acuerdo_apb', 45);
      $table->string('acuerdo_apb');
      $table->date('fecha_apb');
      $table->date('fecha_ent');
      $table->double('puntuacion');
      $table->string('calificacion', 100);
      $table->integer('estado');
      $table->string('estudiante', 15);
      $table->string('asesor', 15);
      $table->string('jurado1', 15);
      $table->string('jurado2', 15);
      $table->string('jurado3', 15);

      $table->foreign('estudiante')->references('ced_persona')->on('estudiante');
      $table->foreign('asesor')->references('ced_persona')->on('docente');
      $table->foreign('jurado1')->references('ced_persona')->on('docente');
      $table->foreign('jurado2')->references('ced_persona')->on('docente');
      $table->foreign('jurado3')->references('ced_persona')->on('docente');

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
    Schema::dropIfExists('trabajo_grado');
  }
}
