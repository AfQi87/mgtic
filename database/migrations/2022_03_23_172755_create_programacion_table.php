<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programacion', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tematica', 400);
            $table->unsignedInteger('asistente_id');
            $table->unsignedInteger('acta_id');

            $table->foreign('acta_id')->references('id')->on('acta');
            $table->foreign('asistente_id')->references('id')->on('asistente');
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
        Schema::dropIfExists('programacion');
    }
}
