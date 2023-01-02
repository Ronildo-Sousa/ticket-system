<?php

use App\Enums\Roles;
use App\Models\Ticket;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;

beforeEach(function () {
    $this->user = User::factory()->create(['role_id' => Roles::Administrator->value]);
});

it('should be able to add a comment to a ticket', function () {
    Ticket::factory()->create();

    actingAs($this->user)
        ->post(route('comments.store', [
            'ticket_id' => 1,
            'body' => fake()->paragraph(),
        ]))
        ->assertOk();

    assertDatabaseCount('comments', 1);
});
