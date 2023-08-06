<?php

namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the reviews seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $seed_number=500;

        $factory = Review::factory();

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
