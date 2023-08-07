<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BannedWordsSeeder extends Seeder
{
    /**
     * Run the banned words seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $words = [
            ['word' => 'boring'],
            ['word' => 'ugly'],
            ['word' => 'smelly'],
            ['word' => 'shitty'],
            ['word' => '.net'],
            ['word' => 'bullshit'],
            ['word' => 'he owes me money']
        ];

        DB::table('banned_words')->insert($words);
    }
}
