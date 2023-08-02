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
            'name' => 'Salvi',
            'email' => 'salvi@corsi.it',
            'password' => Hash::make('password'),
        ]);
        User::create([
            'name' => 'John',
            'email' => 'john@corsi.it',
            'password' => Hash::make('password'),
        ]);
        User::create([
            'name' => 'Jane',
            'email' => 'Jane@corsi.it',
            'password' => Hash::make('password'),
        ]);
        User::create([
            'name' => 'Test',
            'email' => 'test@corsi.it',
            'password' => Hash::make('password'),
        ]);
        User::create([
            'name' => 'Tester',
            'email' => 'tester@corsi.it',
            'password' => Hash::make('password'),
        ]);
    }
}
