<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActaComiteHasParticipanteTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('acta_comite_has_participante', function (Blueprint $table) {
      $table->unsignedInteger('acta_comite');
      $table->string('participante', 15);


      $table->foreign('acta_comite')->references('id_acta')->on('acta_comite');
      $table->foreign('participante')->references('persona')->on('participante');

      $table->primary(['acta_comite', 'participante']);
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
    Schema::dropIfExists('acta_comite_has_participante');
  }
}
