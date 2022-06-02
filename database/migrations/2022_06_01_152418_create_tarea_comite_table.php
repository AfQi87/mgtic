<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTareaComiteTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('tarea_comite', function (Blueprint $table) {
      $table->increments('id_tarea');
      $table->text('tarea');
      $table->unsignedInteger('acta');
      $table->string('responsable', 15);


      $table->foreign('responsable')->references('participante')->on('acta_comite_has_participante');
      $table->foreign('acta')->references('acta_comite')->on('acta_comite_has_participante');

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
    Schema::dropIfExists('tarea_comite');
  }
}
