<?php

namespace Database\Seeders;
use App\Models\Estado;
use Illuminate\Database\Seeder;

class EstadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $estado = new Estado;
        $estado->nombre='Activo';
        $estado->save();
        $estado = new Estado;
        $estado->nombre='Deshabilitado';
        $estado->save();
        $estado = new Estado;
        $estado->nombre='Deuda Vencida';
        $estado->save();
        $estado = new Estado;
        $estado->nombre='Corte Sin Ejecutar';
        $estado->save();
        $estado = new Estado;
        $estado->nombre='Corte Ejecutado';
        $estado->save();
        $estado = new Estado;
        $estado->nombre='Retiro de Equipos';
        $estado->save();
        $estado = new Estado;
        $estado->nombre='Retirado';
        $estado->save();
        $estado = new Estado;
        $estado->nombre='Congelado';
        $estado->save();
    }
}
