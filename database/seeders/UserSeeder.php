<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Luis Gabriel Coaquira Calloapaza',
            'email' => 'kidmeg100@hotmail.com',
            'password' => bcrypt('12345678'),
        ]);
    }
}
