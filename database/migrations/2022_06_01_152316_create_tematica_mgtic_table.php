<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTematicaMgticTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('tematica', function (Blueprint $table) {
      $table->increments('id_tematica');
      $table->text('tematica');
      $table->unsignedInteger('acta');

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
    Schema::dropIfExists('tematica_mgtic');
  }
}
