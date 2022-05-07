<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTareaComiteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tarea_comite', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tarea', 400);
            $table->unsignedInteger('asistente_id');
            $table->unsignedInteger('acta_id');

            $table->foreign('acta_id')->references('id')->on('acta');
            $table->foreign('asistente_id')->references('id')->on('asistente_comite');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tarea_comite');
    }
}
