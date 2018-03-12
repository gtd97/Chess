<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partidas', function (Blueprint $table) {
            $table->integer('id_partida')->index()->unsigned();
            $table->string('estado');
            $table->integer('jugador_1')->references('id')->on('users')->onDelete('cascade');
            $table->integer('jugador_2')->references('id')->on('users')->onDelete('cascade');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('fichas', function (Blueprint $table) {
            $table->string('ficha');
            $table->integer('id_partida')->references('id_partida')->on('partidas')->onDelete('cascade');
            $table->string('fila');
            $table->string('columna');
            $table->integer('jugador')->references('id')->on('users')->onDelete('cascade');
            $table->timestamp('created_at')->nullable();
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
