<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAntenasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('antenas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('ip');
            $table->string('mac');
            $table->string('frecuencia');
            $table->string('canal');
            $table->string('marca');
            $table->unsignedBigInteger('torre_id');
            $table->unsignedBigInteger('servidor_id');
            $table->unsignedBigInteger('tipoantena_id');
            $table->foreign('torre_id')->references('id')->on('torres')->onDelete('cascade');
            $table->foreign('servidor_id')->references('id')->on('servidores')->onDelete('cascade');
            $table->foreign('tipoantena_id')->references('id')->on('tipoantena')->onDelete('cascade');
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
        Schema::dropIfExists('antenas');
    }
}
