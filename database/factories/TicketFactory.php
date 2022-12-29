<?php

namespace Database\Factories;

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
        $priority = ['LOW', 'MEDIUM', 'HIGH'];

        return [
            'title' => fake()->sentence(4),
            'description' => fake()->paragraph(6),
            'priority' => $priority[rand(0, 2)],
            'status' => $status[rand(0, 1)]
        ];
    }
}
