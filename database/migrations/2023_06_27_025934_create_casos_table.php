<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCasosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('casos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo',120);
            $table->integer('numero');
            $table->string('corte',80);
            $table->unsignedBigInteger('juez_id');
            $table->foreign('juez_id')->references('id')->on('jueces');
            $table->string('estado',50); //abierto, cerrado, pendiente, en progreso
            $table->string('tipo',80); //asistencia familiar, divorcio
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
        Schema::dropIfExists('casos');
    }
}
