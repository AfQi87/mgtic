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
            $table->increments('id');
            $table->string('nombre', 100);
            $table->string('correo', 150);
            $table->string('telefono', 20);
            $table->string('foto', 100);
            $table->unsignedInteger('campo_id');
            $table->unsignedInteger('estado_id');

            $table->foreign('campo_id')->references('id')->on('campo');
            $table->foreign('estado_id')->references('id')->on('estado');

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
