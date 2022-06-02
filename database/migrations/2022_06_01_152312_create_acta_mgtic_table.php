<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActaMgticTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('acta_mgtic', function (Blueprint $table) {
      $table->increments('id_acta');
      $table->unsignedInteger('tipo');
      $table->string('proceso', 500);
      $table->date('fecha');
      $table->string('lugar', 200);
      $table->time('hora_inicio');
      $table->time('hora_fin');

      $table->foreign('tipo')->references('id_tipo')->on('tipo_reunion');
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
    Schema::dropIfExists('acta_mgtic');
  }
}
