<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableMarcas extends Migration
{

    public function up()
    {
        Schema::create('marcas', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 256)->unique();
        });
    }

    public function down()
    {
        Schema::dropIfExists('marcas');
    }
}
