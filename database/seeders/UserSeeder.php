<?php

namespace Database\Seeders;

use App\Models\User;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the users seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $seed_number=100;

        $factory = User::factory();

        // Progress bar
        $progress = $this->command->getOutput()->createProgressBar($seed_number);
        $progress->setFormat("[%bar%] %percent:3s%%\n");
        $progress->start();

        for($i=0; $i<=$seed_number; $i++){
            $factory->create()->each(
                function() use ($progress) {
                    $progress->advance();
                }
            );
        }

        $progress->clear();
    }
}
