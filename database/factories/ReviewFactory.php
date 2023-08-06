<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $created_by = User::select('id')->inRandomOrder()->first();

        $reviewed_user = User::select('id')->inRandomOrder()->first();

        while ($created_by === $reviewed_user)
        {
            $reviewed_user++;
        }

        //TODO: Generare anche i created_at

        return [
            'created_by' => $created_by,
            'comment' => $this->faker->text(),
            'stars' => $this->faker->numberBetween(1,5),
            'reviewed_user' => $reviewed_user,
        ];
    }
}
