<?php

namespace Database\Factories;

use App\Enums\StockRequestStatusEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class StockRequestFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'item_id'      => \App\Models\Item::factory(),
            'quantity'     => $this->faker->numberBetween(1, 100),
            'status'       => $this->faker->randomElement([
                StockRequestStatusEnum::PENDING,
                StockRequestStatusEnum::APPROVED,
                StockRequestStatusEnum::REJECTED,
            ]),
            'start_date'   => $this->faker->date(),
            'end_date'     => $this->faker->date(),
            'requested_by' => \App\Models\User::factory(),
//            'approved_by'  => $this->faker->boolean ? \App\Models\User::factory() : null,
//            'approved_at'  => $this->faker->boolean ? $this->faker->dateTime() : null,
//            'rejected_by'  => $this->faker->boolean ? \App\Models\User::factory() : null,
//            'rejected_at'  => $this->faker->boolean ? $this->faker->dateTime() : null,
        ];
    }

}
