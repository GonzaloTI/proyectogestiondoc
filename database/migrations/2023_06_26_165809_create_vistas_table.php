<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVistasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vistas', function (Blueprint $table) {
            $table->id();
            $table->integer('ci');
            $table->string('nombre',30);
            $table->string('a_paterno',30);
            $table->string('a_materno',30);
            $table->string('sexo',1);
            $table->integer('telefono');
            $table->string('direccion',80);
            $table->string('estado',1)->nullable();
            
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
        Schema::dropIfExists('vistas');
    }
}
