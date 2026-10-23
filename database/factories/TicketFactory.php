<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketFactory extends Factory
{
    protected $model = Ticket::class;

    public function definition(): array
    {
        return [
            'event_id' => Event::factory(),
            'name' => fake()->randomElement([
                'Regular',
                'VIP',
                'Early Bird',
            ]),
            'price' => fake()->randomFloat(2, 5000, 50000),
            'quantity' => fake()->numberBetween(50, 500),
            'quantity_sold' => 0,
        ];
    }
}
