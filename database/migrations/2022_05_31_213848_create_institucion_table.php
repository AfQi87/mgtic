<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstitucionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('institucion', function (Blueprint $table) {
            $table->string('id_institucion', 15);
            $table->string('nom_institucion', 100);
            $table->string('pais', 15);
            $table->unsignedInteger('sector');
            $table->unsignedInteger('tipo');

            $table->primary('id_institucion');
            $table->foreign('pais')->references('id_pais')->on('pais');
            $table->foreign('sector')->references('id_sector')->on('sector');
            $table->foreign('tipo')->references('id_tipo')->on('tipo_inst');
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
        Schema::dropIfExists('institucion');
    }
}
