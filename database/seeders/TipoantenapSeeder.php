<?php

namespace Database\Seeders;

use App\Models\TipoAntena;
use Illuminate\Database\Seeder;

class TipoantenapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoAntena::create([
            'nombre' => 'Base Receptor',
            'estado_id' => '1',
        ]);
        TipoAntena::create([
            'nombre' => 'Base Emisor',
            'estado_id' => '1',
        ]);
    }
}
