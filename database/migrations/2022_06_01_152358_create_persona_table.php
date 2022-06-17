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
    Schema::create('persona', function (Blueprint $table) {
      $table->string('ced_persona', 15);
      $table->unsignedInteger('tipo_doc');
      $table->string('nom_persona');
      $table->string('email_persona');
      $table->string('tel_persona')->nullable();
      $table->string('cel_persona');
      $table->unsignedInteger('sexo')->nullable();
      $table->unsignedInteger('estado_civil')->nullable();
      $table->unsignedInteger('tipo_sangre')->nullable();
      $table->date('fecha_nac')->nullable();
      $table->string('lugar_nac', 15)->nullable();
      $table->string('direccion', 100)->nullable();
      $table->string('foto', 100)->nullable();

      $table->foreign('tipo_doc')->references('id_tipo')->on('tipo_id');
      $table->foreign('sexo')->references('id_sexo')->on('sexo');
      $table->foreign('estado_civil')->references('id_estado')->on('estado_civil');
      $table->foreign('tipo_sangre')->references('id_tipo')->on('tipo_sangre');
      $table->foreign('lugar_nac')->references('id_municipio')->on('municipio');

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
    Schema::dropIfExists('persona');
  }
}
