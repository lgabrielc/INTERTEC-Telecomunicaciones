<?php

namespace Database\Seeders;

use App\Models\Torre;
use Illuminate\Database\Seeder;

class TorreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Torre::create([
            'nombre' => 'Torre Arapa',
            'dueño' => 'Gabriel',
            'mensualidad' => '20',
            'direccion' => 'Ovalo Oasis',
            'telefono' => '987654321',
            'estado_id' => '1',
        ]);
        Torre::create([
            'nombre' => 'Torre Notredame',
            'dueño' => 'Luis',
            'mensualidad' => '192',
            'direccion' => 'Ovalo Oasis',
            'telefono' => '987654321',
            'estado_id' => '1',
        ]);
        Torre::create([
            'nombre' => 'Torre Ovalo',
            'dueño' => 'Abel',
            'mensualidad' => '168',
            'direccion' => 'Ovalo Oasis',
            'telefono' => '987654321',
            'estado_id' => '1',
        ]);
        Torre::create([
            'nombre' => 'Torre Oasis',
            'dueño' => 'Ana',
            'mensualidad' => '10',
            'direccion' => 'Ovalo Oasis',
            'telefono' => '987654321',
            'estado_id' => '1',
        ]);
        Torre::create([
            'nombre' => 'Torre Millas',
            'dueño' => 'Juan',
            'mensualidad' => '20',
            'direccion' => 'Ovalo Oasis',
            'telefono' => '987654321',
            'estado_id' => '1',
        ]);
    }
}
