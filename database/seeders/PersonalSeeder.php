<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Personal;

class PersonalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Personal::create([
                'nombre' => 'Luis Gabriel',
                'apellido' =>'Coaquira Calloapaza',
                'dni' =>'74712308',
                'user_id' => '1',
        ]);
    }
}
