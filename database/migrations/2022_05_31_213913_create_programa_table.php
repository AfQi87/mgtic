<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programa', function (Blueprint $table) {
            $table->string('id_programa', 15);
            $table->string('nom_programa', 100);
            $table->unsignedInteger('nivel');
            $table->string('institucion', 15);

            $table->primary('id_programa');
            $table->foreign('nivel')->references('id_nivel')->on('nivel');
            $table->foreign('institucion')->references('id_institucion')->on('institucion');
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
        Schema::dropIfExists('programa');
    }
}
