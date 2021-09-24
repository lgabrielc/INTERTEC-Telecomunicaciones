<?php

namespace Database\Seeders;

use App\Models\Servidor;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            PersonalSeeder::class,
            EstadosSeeder::class,
            ServidorSeeder::class,
            TorreSeeder::class,
            TipoantenapSeeder::class,
            AntenaSeeder::class,
            CentrodatoSeeder::class,
            OltSeeder::class,
            TarjetaSeeder::class,
            GponSeeder::class,
            CajanapSeeder::class,
            PlanSeeder::class,
            ClientesSeeder::class,
        ]);
    }
}
