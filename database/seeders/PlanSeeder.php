<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Plan::create([
            'nombre' => 'Plan Básico',
            'descarga' => '8 MB',
            'subida' => '8 MB',
            'precio' => '60.00',
            'estado_id' => '1',
        ]);
        Plan::create([
            'nombre' => 'Plan Medio',
            'descarga' => '12 MB',
            'subida' => '12 MB',
            'precio' => '80.00',
            'estado_id' => '1',
        ]);
        Plan::create([
            'nombre' => 'Plan Premium',
            'descarga' => '15 MB',
            'subida' => '15 MB',
            'precio' => '100.00',
            'estado_id' => '1',
        ]);
    }
}
