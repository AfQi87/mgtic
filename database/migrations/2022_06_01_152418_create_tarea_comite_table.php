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

      $table->foreign('responsable')->references('persona')->on('participante_comite');
      $table->foreign('acta')->references('id_acta')->on('acta');

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
