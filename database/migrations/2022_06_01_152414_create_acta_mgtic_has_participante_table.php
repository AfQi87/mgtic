<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActaMgticHasParticipanteTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('acta_mgtic_has_participante', function (Blueprint $table) {
      $table->unsignedInteger('acta_mgtic');
      $table->string('participante', 15);


      $table->foreign('acta_mgtic')->references('id_acta')->on('acta_mgtic');
      $table->foreign('participante')->references('persona')->on('participante_mgtic');

      $table->primary(['acta_mgtic', 'participante']);

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
    Schema::dropIfExists('acta_mgtic_has_participante');
  }
}
