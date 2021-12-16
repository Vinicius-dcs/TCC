<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableManutencao extends Migration
{

    public function up()
    {
        Schema::create('manutencoes', function (Blueprint $table) {
            $table->id();
            $table->date('data');
            $table->string('horario');
            $table->string('descricao');
            $table->double('valor');
            $table->string('tipoManutencao');
            $table->unsignedBigInteger('idVeiculo');
            $table->unsignedBigInteger('idFuncionario');
        });

        Schema::table('manutencoes', function (Blueprint $table) {
            $table->foreign('idVeiculo')->references('id')->on('veiculos')->onDelete('restrict');
            $table->foreign('idFuncionario')->references('id')->on('funcionarios')->onDelete('restrict');
        });
    }

    public function down()
    {
        Schema::dropIfExists('manutencoes');
    }
}
