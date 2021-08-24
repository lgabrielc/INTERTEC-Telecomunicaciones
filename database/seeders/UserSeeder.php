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
        $passwords='123456789';
        $admin = new User;
        $admin->name = 'Gabriel';
        $admin->email = 'kidmeg100@hotmail.com';
        $admin->password = $passwords;
        $admin->save();
    }
}
