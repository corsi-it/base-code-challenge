<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'John',
            'email' => 'john@corsi.it',
            'password' => Hash::make('password'),
        ]);
        User::create([
            'name' => 'Jane',
            'email' => 'jane@corsi.it',
            'password' => Hash::make('password'),
        ]);
        User::create([
            'name' => 'Salvi',
            'email' => 'salvi@corsi.it',
            'password' => Hash::make('password'),
        ]);
    }
}
