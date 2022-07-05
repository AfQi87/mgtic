<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('telefono', 25);
            $table->string('foto')->nullable();
            $table->unsignedInteger('cargo_id');
            $table->unsignedInteger('rol_id');
            $table->unsignedInteger('estado_id');
            $table->rememberToken();

            $table->foreign('rol_id')->references('id')->on('rol');
            $table->foreign('cargo_id')->references('id')->on('cargoUser');
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
        Schema::dropIfExists('users');
    }
}
