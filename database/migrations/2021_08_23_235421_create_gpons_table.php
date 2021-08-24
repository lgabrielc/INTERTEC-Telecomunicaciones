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
            $table->unsignedBigInteger('tarjeta_id');
            $table->foreign('tarjeta_id')->references('id')->on('tarjetas');
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
