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
      $table->string('nom_tg', 300)->nullable();
      $table->string('num_acuerdo_jr', 45)->nullable();
      $table->string('acuerdo_js', 45)->nullable();
      $table->date('fecha_ins')->nullable();
      $table->string('num_acuerdo_apb', 45)->nullable();
      $table->string('acuerdo_apb')->nullable();
      $table->date('fecha_apb')->nullable();
      $table->date('fecha_ent')->nullable();
      $table->double('puntuacion')->nullable();
      $table->string('calificacion', 100)->nullable();
      $table->integer('estado')->nullable();
      $table->string('estudiante', 15)->nullable();
      $table->string('asesor', 15)->nullable();
      $table->string('jurado1', 15)->nullable();
      $table->string('jurado2', 15)->nullable();
      $table->string('jurado3', 15)->nullable();

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
