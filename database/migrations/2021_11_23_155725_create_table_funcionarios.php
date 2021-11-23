<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableFuncionarios extends Migration
{

    public function up()
    {
        Schema::create('funcionarios', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('dataNascimento');
            $table->string('dataAdmissao');
            $table->string('email');
            $table->string('sexo');
            $table->string('cpf');
            $table->string('telefone');
        });
    }

    public function down()
    {
        Schema::dropIfExists('funcionarios');
    }
}
