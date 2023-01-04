<?php

use App\Enums\Roles;
use App\Models\Category;
use App\Models\Label;
use App\Models\Priority;
use App\Models\Role;
use App\Models\User;
use App\Notifications\TicketCreated;
use Illuminate\Support\Facades\Notification;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;

beforeEach(function () {
    Category::factory(2)->create();
    Label::factory(2)->create();
    Priority::factory()->create();

    Role::factory()->create(['name' => 'Regular']);
    Role::factory()->create(['name' => 'Agent']);
    Role::factory()->create(['name' => 'Administrator']);

    $this->user = User::factory()->create(['role_id' => Roles::Regular]);
});

it('has a create ticket page', function () {
    actingAs($this->user)
        ->get(route('tickets.create'))
        ->assertOk()
        ->assertSeeText(__('ticket'));
});

it('should be able to user create a ticket', function () {
    actingAs($this->user)
        ->post(route('tickets.store', [
            'title' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'priority_id' => 1,
            'categories' => [1],
            'labels' => [1, 2],
        ]))
        ->assertRedirectToRoute('tickets.index');

    assertDatabaseCount('tickets', 1);
    assertDatabaseCount('category_ticket', 1);
    assertDatabaseCount('label_ticket', 2);
});

test('admin should be notified when a new ticket is created', function () {
    User::factory(15)->create();

    Notification::fake();

    actingAs($this->user)
        ->post(route('tickets.store', [
            'title' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'priority_id' => 1,
            'categories' => [1],
            'labels' => [1, 2],
        ]));

    User::admin()->each(fn ($user) => Notification::assertSentTo($user, TicketCreated::class));
    Notification::assertCount(User::admin()->count());
});
