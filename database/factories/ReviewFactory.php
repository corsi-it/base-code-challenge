<?php 

namespace Database\Factories;

use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    protected $model = Review::class;

    public function definition()
    {
        return [
            'employee_id' => User::inRandomOrder()->first()->id,
            'reviewer_id' => User::inRandomOrder()->first()->id,
            'rating' => $this->faker->numberBetween(1, 5),
            'comment' => $this->faker->paragraph,
            'created_at' => $this->faker->dateTimeBetween('-15 days', 'now'),
        ];
    }
}