<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstudianteTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('estudiante', function (Blueprint $table) {
      $table->string('ced_persona', 15);
      $table->string('codigo', 15);
      $table->integer('semestre');
      $table->unsignedInteger('cohorte');
      $table->unsignedInteger('beca');

      $table->foreign('ced_persona')->references('ced_persona')->on('persona');
      $table->foreign('cohorte')->references('id_cohorte')->on('cohorte');
      $table->foreign('beca')->references('id_beca')->on('beca');

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
    Schema::dropIfExists('estudiante');
  }
}
