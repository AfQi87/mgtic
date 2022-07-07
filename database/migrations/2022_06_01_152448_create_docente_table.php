<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocenteTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('docente', function (Blueprint $table) {
      $table->string('ced_persona', 15);
      $table->text('descripcion')->nullable();
      $table->string('cvlac', 250)->nullable();
      $table->unsignedInteger('tipo');


      $table->foreign('ced_persona')->references('ced_persona')->on('persona');
      $table->foreign('tipo')->references('id_tipo')->on('tipo_docente');

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
    Schema::dropIfExists('docente');
  }
}
