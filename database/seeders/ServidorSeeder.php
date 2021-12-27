<?php

namespace Database\Seeders;

use App\Models\Servidor;
use Illuminate\Database\Seeder;

class ServidorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Servidor::create([
            'nombre' => 'Servidor Lizeth',
            'ipEntrada' => '192.168.10.123',
            'ipSalida' => '192.168.10.20',
            'estado_id' => '1',
        ]);
        Servidor::create([
            'nombre' => 'Servidor Ruben',
            'ipEntrada' => '192.168.10.123',
            'ipSalida' => '192.168.10.20',
            'estado_id' => '1',
        ]);
        Servidor::create([
            'nombre' => 'Servidor Eduardo',
            'ipEntrada' => '192.168.10.123',
            'ipSalida' => '192.168.10.20',
            'estado_id' => '1',
        ]);
        Servidor::create([
            'nombre' => 'Servidor Terma',
            'ipEntrada' => '192.168.10.123',
            'ipSalida' => '192.168.10.20',
            'estado_id' => '1',
        ]);
        Servidor::create([
            'nombre' => 'Servidor Roster',
            'ipEntrada' => '192.168.10.123',
            'ipSalida' => '192.168.10.20',
            'estado_id' => '1',
        ]);

    }
}
