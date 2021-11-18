<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableClientes extends Migration
{

    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 256);
            $table->date('dataNascimento');
            $table->string('endereco', 256);
            $table->string('cpf', 11);
            $table->string('cep', 8);
            $table->string('cidade', 100);
            $table->string('estado', 2);
        });
    }

    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}
