<?php

use App\Enums\Roles;
use App\Models\Category;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;

beforeEach(function () {
    $this->user = User::factory()->create(['role_id' => Roles::Administrator]);
});

it('should be able to create a category', function () {
    $response = actingAs($this->user)
        ->post(route('categories.store', [
            'name' => 'test category'
        ]));

    $response->assertStatus(Response::HTTP_CREATED);

    assertDatabaseCount('categories', 1);
});

test('only admin user can create a category', function () {
    /** @var User $nonAdmin */
    $nonAdmin = User::factory()->create(['role_id', Roles::Regular]);

    $response = actingAs($nonAdmin)
        ->post(route('categories.store'));

    $response->assertStatus(Response::HTTP_FORBIDDEN);
});

test('category name should be required and unique', function () {
    Category::factory()->create(['name' => 'category1']);

    $response1 = actingAs($this->user)
        ->post(route('categories.store', [
            'name' => ''
        ]));

    $response1->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    $response1->assertSessionHasErrors(['name']);

    $response2 = actingAs($this->user)
        ->post(route('categories.store', [
            'name' => 'category1'
        ]));
    $response2->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    $response2->assertSessionHasErrors(['name']);
});
