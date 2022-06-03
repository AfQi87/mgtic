<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEgresadoTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('egresado', function (Blueprint $table) {
      $table->string('ced_persona', 15);
      $table->string('programa', 15);

      $table->foreign('ced_persona')->references('ced_persona')->on('persona');
      $table->foreign('programa')->references('id_programa')->on('programa');

      $table->primary('ced_persona');
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
    Schema::dropIfExists('egresado');
  }
}
