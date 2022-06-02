<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstudioTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('estudio', function (Blueprint $table) {
      $table->increments('id_estudio');
      $table->string('nom_estudio', 100);
      $table->unsignedInteger('nivel_estudio');

      $table->foreign('nivel_estudio')->references('id_nivel')->on('nivel');
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
    Schema::dropIfExists('estudio');
  }
}
