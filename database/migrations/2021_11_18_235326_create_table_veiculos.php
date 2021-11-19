<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableVeiculos extends Migration
{

    public function up()
    {
        Schema::create('veiculos', function (Blueprint $table) {
            $table->id();
            $table->string('modelo');
            $table->string('cor');
            $table->integer('anoFabricacao');
            $table->integer('anoModelo');
            $table->string('placa');
            $table->unsignedBigInteger('idCliente');
            $table->unsignedBigInteger('idMarca');
        });

        Schema::table('veiculos', function (Blueprint $table) {
            $table->foreign('idCliente')->references('id')->on('clientes')->onDelete('restrict');
            $table->foreign('idMarca')->references('id')->on('marcas')->onDelete('restrict');
        });
    }

    public function down()
    {
        Schema::dropIfExists('Veiculos');
    }
}
