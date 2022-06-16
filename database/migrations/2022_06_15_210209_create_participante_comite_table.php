<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipanteComiteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participante_comite', function (Blueprint $table) {
            $table->string('persona', 15);
            $table->unsignedInteger('cargo');

            $table->foreign('persona')->references('ced_persona')->on('persona');
            $table->foreign('cargo')->references('id_cargo')->on('cargo');


            $table->primary('persona');
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
        Schema::dropIfExists('participante_comite');
    }
}
