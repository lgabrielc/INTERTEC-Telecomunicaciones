<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicios', function (Blueprint $table) {
            $table->id();
            $table->date('fechaInicio');
            $table->date('fechaVencimiento');
            $table->date('fechaCorte');
            $table->string('tiposervicio');
            //Por ver nullable
            $table->string('condicionAntena')->nullable();
            $table->string('mac')->nullable();
            $table->string('ip')->nullable();
            $table->string('frecuencia')->nullable();
            //Por cambiar
            $table->string('clientegpon')->nullable();
            $table->string('gponrelacionado')->nullable();
            $table->unsignedBigInteger('estado_id');
            $table->unsignedBigInteger('cliente_id');
            $table->unsignedBigInteger('antena_id')->nullable();
            $table->unsignedBigInteger('plan_id');
            $table->foreign('estado_id')->references('id')->on('estados');
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->foreign('antena_id')->references('id')->on('antenas');
            $table->foreign('plan_id')->references('id')->on('planes');
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
        Schema::dropIfExists('servicios');
    }
}
