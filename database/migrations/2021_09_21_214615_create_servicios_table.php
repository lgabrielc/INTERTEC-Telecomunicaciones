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
            $table->date('fechainicio')->nullable();
            $table->date('fechavencimiento')->nullable();
            $table->date('fechacorte')->nullable();
            $table->date('fechacorteejecutado')->nullable();
            $table->string('tiposervicio');
            //Por ver nullable
            $table->string('condicionAntena')->nullable();
            $table->string('mac')->nullable();
            $table->string('ip')->nullable();
            $table->string('frecuencia')->nullable();
            //Por cambiar  
            $table->float('deuda')->nullable();
            $table->string('clientegpon')->nullable();
            $table->unsignedBigInteger('cliente_id');
            $table->unsignedBigInteger('antena_id')->nullable();
            $table->unsignedBigInteger('plan_id');
            $table->unsignedBigInteger('nap_id')->nullable();
            $table->foreign('nap_id')->references('id')->on('naps');
            $table->unsignedBigInteger('estado_id');
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
