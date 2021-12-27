<?php

namespace Database\Seeders;

use App\Models\Antena;
use Illuminate\Database\Seeder;

class AntenaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Antena::create([
            'nombre' => 'Antena Noveno',
            'ip' => '192.168.10.123',
            'mac' => 'FG:GT:5T:6Y:4T:U7',
            'frecuencia' => '5.8 GHZ',
            'canal' => '5800',
            'marca' => 'Huawei',
            'torre_id' => '1',
            'servidor_id' => '1',
            'tipoantena_id' => '1',
            'estado_id' => '1',
        ]);
        Antena::create([
            'nombre' => 'Antena Septimo',
            'ip' => '192.168.10.123',
            'mac' => 'FG:GT:5T:6Y:4T:U7',
            'frecuencia' => '5.8 GHZ',
            'canal' => '5800',
            'marca' => 'Huawei',
            'torre_id' => '2',
            'servidor_id' => '2',
            'tipoantena_id' => '1',
            'estado_id' => '1',
        ]);
        Antena::create([
            'nombre' => 'Antena Ovalo Oasis',
            'ip' => '192.168.10.123',
            'mac' => 'FG:GT:5T:6Y:4T:U7',
            'frecuencia' => '5.8 GHZ',
            'canal' => '5800',
            'marca' => 'Huawei',
            'torre_id' => '3',
            'servidor_id' => '3',
            'tipoantena_id' => '1',
            'estado_id' => '1',
        ]);
        Antena::create([
            'nombre' => 'Antena Capilla',
            'ip' => '192.168.10.123',
            'mac' => 'FG:GT:5T:6Y:4T:U7',
            'frecuencia' => '5.8 GHZ',
            'canal' => '5800',
            'marca' => 'Huawei',
            'torre_id' => '4',
            'servidor_id' => '4',
            'tipoantena_id' => '2',
            'estado_id' => '1',
        ]);
        Antena::create([
            'nombre' => 'Antena 200 Millas',
            'ip' => '192.168.10.123',
            'mac' => 'FG:GT:5T:6Y:4T:U7',
            'frecuencia' => '5.8 GHZ',
            'canal' => '5800',
            'marca' => 'Huawei',
            'torre_id' => '5',
            'servidor_id' => '5',
            'tipoantena_id' => '2',
            'estado_id' => '1',
        ]);
        Antena::create([
            'nombre' => 'Antena Roter',
            'ip' => '192.168.10.123',
            'mac' => 'FG:GT:5T:6Y:4T:U7',
            'frecuencia' => '5.8 GHZ',
            'canal' => '5800',
            'marca' => 'Huawei',
            'torre_id' => '2',
            'servidor_id' => '1',
            'tipoantena_id' => '1',
            'estado_id' => '1',
        ]);
    }
}
