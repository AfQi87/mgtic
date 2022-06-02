<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTareaMgticTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('tarea_mgtic', function (Blueprint $table) {
      $table->increments('id_tarea');
      $table->text('tarea');
      $table->unsignedInteger('acta');
      $table->string('participante', 15);

      $table->foreign('participante')->references('participante')->on('acta_mgtic_has_participante');
      $table->foreign('acta')->references('acta_mgtic')->on('acta_mgtic_has_participante');

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
    Schema::dropIfExists('tarea_mgtic');
  }
}
