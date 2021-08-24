<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOltsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('olts', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->integer('slots');
            $table->string('modelo');
            $table->string('marca');
            $table->unsignedBigInteger('datacenter_id');
            $table->foreign('datacenter_id')->references('id')->on('datacenters');
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
        Schema::dropIfExists('olts');
    }
}
