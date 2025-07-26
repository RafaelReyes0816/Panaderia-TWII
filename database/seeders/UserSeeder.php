<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Rafael',
            'email' => 'rafael@panaderia.com',
            'password' => Hash::make('123456'),
        ]);

        User::create([
            'name' => 'Iván',
            'email' => 'ivan@panaderia.com',
            'password' => Hash::make('123456'),
        ]);

        User::create([
            'name' => 'David',
            'email' => 'david@panaderia.com',
            'password' => Hash::make('123456'),
        ]);
    }
}
