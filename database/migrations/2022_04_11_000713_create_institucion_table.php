<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstitucionTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('Institucion', function (Blueprint $table) {
      $table->string('id_institucion', 15);
      $table->string('nom_institucion', 100);
      $table->unsignedInteger('tipo');
      $table->string('municipio', 15);
      $table->unsignedInteger('sector');
      $table->primary('id_institucion');


      $table->foreign('tipo')->references('id_tipo')->on('Tipo');
      $table->foreign('municipio')->references('id_municipio')->on('Municipio');
      $table->foreign('sector')->references('id_sector')->on('Sector');

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
    Schema::dropIfExists('Institucion');
  }
}
