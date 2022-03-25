<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acta', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('reunion_id');
            $table->string('proceso');
            $table->string('lugar');
            $table->time('hora_inicio');
            $table->date('fecha');
            $table->time('hora_fin');

            $table->foreign('reunion_id')->references('id')->on('reunion');
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
        Schema::dropIfExists('acta');
    }
}
