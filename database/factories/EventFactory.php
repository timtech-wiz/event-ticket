<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(4),
            'description' => fake()->paragraph(),
            'start_at' => fake()->dateTimeBetween('now', '+1 month'),
            'end_at' => fake()->dateTimeBetween('+1 month', '+2 months'),
            'location' => fake()->address(),
            'total_seats' => fake()->numberBetween(50, 500),
            'available_seats' => fake()->numberBetween(50, 500),
        ];
    }
}
