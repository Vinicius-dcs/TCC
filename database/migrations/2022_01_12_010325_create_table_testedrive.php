<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableTestedrive extends Migration
{

    public function up()
    {
        Schema::create('testedrives', function (Blueprint $table) {
            $table->id();
            $table->date('data');
            $table->string('horario');
            $table->string('observacao');
            $table->unsignedBigInteger('idCliente');
            $table->unsignedBigInteger('idVeiculo');
            $table->unsignedBigInteger('idFuncionario');
        });

        Schema::table('testedrives', function (Blueprint $table) {
            $table->foreign('idCliente')->references('id')->on('clientes')->onDelete('restrict');
            $table->foreign('idVeiculo')->references('id')->on('veiculos')->onDelete('restrict');
            $table->foreign('idFuncionario')->references('id')->on('funcionarios')->onDelete('restrict');
        });
    }

    public function down()
    {
        Schema::dropIfExists('testedrive');
    }
}
