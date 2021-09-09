<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('naps', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->integer('slots')->nullable();
            $table->unsignedBigInteger('gpon_id')->nullable();
            $table->foreign('gpon_id')->references('id')->on('gpons')->delete('cascade');
            
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
        Schema::dropIfExists('naps');
    }
}
