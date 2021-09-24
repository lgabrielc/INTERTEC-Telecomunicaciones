<?php

namespace Database\Seeders;

use App\Models\Olt;
use Illuminate\Database\Seeder;

class OltSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Olt::create([
            'nombre' => 'Olt 1',
            'slots' => '7',
            'modelo' => 'ERDW24WE',
            'marca' => 'Huawei',
            'centrodato_id' => '1',
            'estado_id' => '1',
        ]);
        Olt::create([
            'nombre' => 'Olt 1',
            'slots' => '7',
            'modelo' => 'SDU7UJWD',
            'marca' => 'Huawei',
            'centrodato_id' => '2',
            'estado_id' => '1',
        ]);
        Olt::create([
            'nombre' => 'Olt 1',
            'slots' => '7',
            'modelo' => 'DWIKFE78',
            'marca' => 'Huawei',
            'centrodato_id' => '3',
            'estado_id' => '1',
        ]);
        Olt::create([
            'nombre' => 'Olt 2',
            'slots' => '7',
            'modelo' => 'WDKJU8Y7',
            'marca' => 'Huawei',
            'centrodato_id' => '1',
            'estado_id' => '1',
        ]);
        Olt::create([
            'nombre' => 'Olt 2',
            'slots' => '7',
            'modelo' => 'FDJUGTY7',
            'marca' => 'Huawei',
            'centrodato_id' => '2',
            'estado_id' => '1',
        ]);
        Olt::create([
            'nombre' => 'Olt 2',
            'slots' => '6',
            'modelo' => 'SDJIU8Y7',
            'marca' => 'Huawei',
            'centrodato_id' => '3',
            'estado_id' => '1',
        ]);
        Olt::create([
            'nombre' => 'Olt 3',
            'slots' => '6',
            'modelo' => 'GFT4R3WE',
            'marca' => 'Huawei',
            'centrodato_id' => '1',
            'estado_id' => '1',
        ]);
        Olt::create([
            'nombre' => 'Olt 3',
            'slots' => '7',
            'modelo' => '2FGKJTRY',
            'marca' => 'Huawei',
            'centrodato_id' => '2',
            'estado_id' => '1',
        ]);
        Olt::create([
            'nombre' => 'Olt 3',
            'slots' => '7',
            'modelo' => 'SDKIU823',
            'marca' => 'Huawei',
            'centrodato_id' => '3',
            'estado_id' => '1',
        ]);
    }
}
