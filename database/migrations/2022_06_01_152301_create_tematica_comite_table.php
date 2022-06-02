<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTematicaComiteTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('tematica_comite', function (Blueprint $table) {
      $table->increments('id_tematica');
      $table->unsignedInteger('acta');
      $table->text('tematica');

      $table->foreign('acta')->references('id_acta')->on('acta_comite');
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
    Schema::dropIfExists('tematica_comite');
  }
}
