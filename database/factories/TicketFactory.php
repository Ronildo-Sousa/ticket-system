<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $status = ['open', 'closed'];

        return [
            'title' => fake()->sentence(4),
            'description' => fake()->paragraph(6),
            'priority_id' => rand(0, 2),
            'status' => $status[rand(0, 1)],
            'user_id' => (User::first()) ? User::first() : User::factory()
        ];
    }
}
