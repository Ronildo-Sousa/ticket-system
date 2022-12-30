<?php

use App\Enums\Roles;
use App\Models\Category;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;

beforeEach(function () {
    $this->user = User::factory()->create(['role_id' => Roles::Administrator->value]);
});

it('shows a form to create a category', function () {
    actingAs($this->user)
        ->get(route('categories.create'))
        ->assertOk()
        ->assertSeeText(__('category'));
});

it('should be able to create a category', function () {
    actingAs($this->user)
        ->post(route('categories.store', [
            'name' => 'test category'
        ]))
        ->assertRedirect(route('categories.index'));

    assertDatabaseCount('categories', 1);
});

test('only admin user can create a category', function () {
    /** @var User $nonAdmin */
    $nonAdmin = User::factory()->create(['role_id' => Roles::Regular]);

    actingAs($nonAdmin)
        ->post(route('categories.store', [
            'name' => 'test name'
        ]))
        ->assertForbidden();
});

test('category name should be required and unique', function () {
    Category::factory()->create(['name' => 'category1']);

    actingAs($this->user)
        ->post(route('categories.store', [
            'name' => ''
        ]))
        ->assertStatus(Response::HTTP_FOUND)
        ->assertSessionHasErrors(['name']);

    actingAs($this->user)
        ->post(route('categories.store', [
            'name' => 'category1'
        ]))
        ->assertStatus(Response::HTTP_FOUND)
        ->assertSessionHasErrors(['name']);
});
