<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfesionEstudianteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profesion_estudiante', function (Blueprint $table) {
            $table->increments('id');
            $table->string('estudios');
            $table->unsignedInteger('estudiante_id');

            $table->foreign('estudiante_id')->references('id')->on('Estudiante');
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
        Schema::dropIfExists('profesion_estudiante');
    }
}
