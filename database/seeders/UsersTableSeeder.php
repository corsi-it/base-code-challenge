<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        User::firstOrCreate([
            'name' => 'Salvi',
            'email' => 'salvi@corsi.it',
            'password' => Hash::make('password'),
        ]);
        User::firstOrCreate([
            'name' => 'John',
            'email' => 'john@corsi.it',
            'password' => Hash::make('password'),
        ]);
        User::firstOrCreate([
            'name' => 'Jane',
            'email' => 'jane@corsi.it',
            'password' => Hash::make('password'),
        ]);
        User::firstOrCreate([
            'name' => 'Test',
            'email' => 'test@corsi.it',
            'password' => Hash::make('password'),
        ]);
        User::firstOrCreate([
            'name' => 'Tester',
            'email' => 'tester@corsi.it',
            'password' => Hash::make('password'),
        ]);
    }
}
