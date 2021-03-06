<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableUsuarios extends Migration
{

    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 256);
            $table->string('email', 256);
            $table->string('senha');
        });
    }

    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
}
