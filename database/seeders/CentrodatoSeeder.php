<?php

namespace Database\Seeders;

use App\Models\Centrodato;
use Illuminate\Database\Seeder;

class CentrodatoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Centrodato::create([
            'nombre' => 'Datacenter Villa Oasis',
            'ubicacion' => 'Villa el Salvador',
            'direccion' => 'AH ST.10 GR.4 LT.10 MZ.P',
            'encargado' => 'Gladis Enciso Calloapaza',
            'estado_id' => '1',
        ]);
        Centrodato::create([
            'nombre' => 'Datacenter Villa Maria del Triunfo',
            'ubicacion' => 'Villa Maria del Triunfo',
            'direccion' => 'AH ST.2 GR.1 LT.2 MZ.A',
            'encargado' => 'Rafael Torres',
            'estado_id' => '1',
        ]);
        Centrodato::create([
            'nombre' => 'Datacenter San Juan de Miraflores',
            'ubicacion' => 'San Juan de Miraflores',
            'direccion' => 'AH ST.3 GR.6 LT.32 MZ.B',
            'encargado' => 'Juan Alberto',
            'estado_id' => '1',
        ]);
    }
}
