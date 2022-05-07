<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonaTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('Persona', function (Blueprint $table) {
      $table->string('ced_persona', 15);
      $table->string('nom_persona', 100);
      $table->string('email_persona', 100);
      $table->string('tel_persona', 30);
      $table->string('programa', 15);
      $table->primary('ced_persona');

      $table->foreign('programa')->references('id_programa')->on('Programa');
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
    Schema::dropIfExists('persona');
  }
}
