<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConclusionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conclusion', function (Blueprint $table) {
            $table->increments('id');
            $table->string('conclusion', 5000);
            $table->unsignedInteger('acta_id');

            $table->foreign('acta_id')->references('id')->on('acta');
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
        Schema::dropIfExists('conclusion');
    }
}
