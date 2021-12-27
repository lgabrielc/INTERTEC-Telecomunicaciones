<?php

namespace Database\Seeders;

use App\Models\Cliente;
use Illuminate\Database\Seeder;

class ClientesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cliente::create([
            'nombre' => 'Luis Gabriel',
            'apellido' => 'Coaquira Calloapaza',
            'dni' => '75895474',
            'direccion' => 'Ovalo Oasis',
            'telefono' => '985652652',
            'correo' => '',
        ]);
        Cliente::create([
            'nombre' => 'Ana Maria',
            'apellido' => 'Calloapaza Vilca',
            'dni' => '75895474',
            'direccion' => 'Ovalo Oasis',
            'telefono' => '985652652',
            'correo' => '',
        ]);
        Cliente::create([
            'nombre' => 'Juan',
            'apellido' => 'Quispe Torres',
            'dni' => '75895474',
            'direccion' => 'Ovalo Oasis',
            'telefono' => '985652652',
            'correo' => ' ',
        ]);
        Cliente::create([
            'nombre' => 'Lili',
            'apellido' => 'Shoal',
            'dni' => '75895474',
            'direccion' => 'Ovalo Oasis',
            'telefono' => '985652652',
            'correo' => ' ',
        ]);
        Cliente::create([
            'nombre' => 'Rosa',
            'apellido' => 'Quicksand',
            'dni' => '75895474',
            'direccion' => 'Ovalo Oasis',
            'telefono' => '985652652',
            'correo' => ' ',
        ]);
        Cliente::create([
            'nombre' => 'Robert',
            'apellido' => 'Albert',
            'dni' => '75895474',
            'direccion' => 'Ovalo Oasis',
            'telefono' => '985652652',
            'correo' => ' ',
        ]);
        Cliente::create([
            'nombre' => 'Hebert',
            'apellido' => 'Santiago',
            'dni' => '75895474',
            'direccion' => 'Ovalo Oasis',
            'telefono' => '985652652',
            'correo' => ' ',
        ]);
        Cliente::create([
            'nombre' => 'Kati',
            'apellido' => 'Soperan',
            'dni' => '75895474',
            'direccion' => 'Ovalo Oasis',
            'telefono' => '985652652',
            'correo' => ' ',
        ]);
        Cliente::create([
            'nombre' => 'Eduardo',
            'apellido' => 'Dientedraco',
            'dni' => '75895474',
            'direccion' => 'Ovalo Oasis',
            'telefono' => '985652652',
            'correo' => ' ',
        ]);
        Cliente::create([
            'nombre' => 'Louzu',
            'apellido' => 'Daffy',
            'dni' => '75895474',
            'direccion' => 'Ovalo Oasis',
            'telefono' => '985652652',
            'correo' => ' ',
        ]);
    }
}
