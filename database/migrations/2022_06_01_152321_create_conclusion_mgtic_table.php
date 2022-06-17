<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConclusionMgticTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('conclusion', function (Blueprint $table) {
      $table->increments('id_conclusion');
      $table->unsignedInteger('acta');
      $table->text('conclusion');

      $table->foreign('acta')->references('id_acta')->on('acta');
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
    Schema::dropIfExists('conclusion_mgtic');
  }
}
