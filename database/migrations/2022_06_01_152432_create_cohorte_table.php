<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCohorteTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('cohorte', function (Blueprint $table) {
      $table->increments('id_cohorte');
      $table->string('desc_cohorte', 100);
      $table->date('fecha_inicio');
      $table->date('fecha_fin');

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
    Schema::dropIfExists('cohorte');
  }
}
