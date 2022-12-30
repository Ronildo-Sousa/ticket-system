<?php

use App\Enums\Roles;
use App\Models\Category;
use App\Models\Label;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;

beforeEach(function () {
    Category::factory()->create();
    Label::factory()->create();
    $this->user = User::factory()->create(['role_id' => Roles::Regular]);
});

it('should be able to create a ticket', function () {
    actingAs($this->user)
        ->post(route('tickets.store', [
            'title' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'priority_id' => 1,
            'user_id' => 1,
        ]))
        ->assertRedirectToRoute('tickets.index');

    assertDatabaseCount('tickets', 1);
});
