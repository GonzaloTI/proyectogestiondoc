<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetallecasosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detallecasos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('caso_id')->nullable();
            $table->foreign('caso_id')->references('id')->on('casos');
            $table->string('rol',50); //demandante o demandado
            
            $table->unsignedBigInteger('vista_id');
            $table->foreign('vista_id')->references('id')->on('vistas');
            $table->unsignedBigInteger('abogado_id');
            $table->foreign('abogado_id')->references('id')->on('abogados');
           
            
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
        Schema::dropIfExists('detallecasos');
    }
}
