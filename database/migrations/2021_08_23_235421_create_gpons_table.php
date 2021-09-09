<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gpons', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->integer('slots')->nullable();
            $table->unsignedBigInteger('tarjeta_id')->nullable();
            $table->foreign('tarjeta_id')->references('id')->on('tarjetas')->delete('cascade');
            
            $table->unsignedBigInteger('estado_id');
            $table->foreign('estado_id')->references('id')->on('estados');
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
        Schema::dropIfExists('gpons');
    }
}
