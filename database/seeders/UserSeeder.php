<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
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
        User::create(['name'=>'Gabriel',
                      'email'=>'kidmeg100@hotmail.com',
                      'password'=>Hash::make('password'),
                      ]);
    }
}
