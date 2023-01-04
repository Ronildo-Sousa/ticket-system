<?php

use App\Enums\user\Roles;
use App\Models\Label;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;

beforeEach(function () {
    $this->user = User::factory()->create(['role_id' => Roles::Administrator->value]);
});

it('shows a form to create a label', function () {
    actingAs($this->user)
        ->get(route('labels.create'))
        ->assertOk()
        ->assertSeeText(__('label'));
});

it('should be able to create a label', function () {
    actingAs($this->user)
        ->post(route('labels.store', [
            'name' => 'test label'
        ]))
        ->assertRedirect(route('labels.index'));

    assertDatabaseCount('labels', 1);
});

test('only admin user can create a label', function () {
    /** @var User $nonAdmin */
    $nonAdmin = User::factory()->create(['role_id' => Roles::Regular]);

    actingAs($nonAdmin)
        ->post(route('labels.store', [
            'name' => 'test name'
        ]))
        ->assertForbidden();
});

test('label name should be required and unique', function () {
    Label::factory()->create(['name' => 'label1']);

    actingAs($this->user)
        ->post(route('labels.store', [
            'name' => ''
        ]))
        ->assertStatus(Response::HTTP_FOUND)
        ->assertSessionHasErrors(['name']);

    actingAs($this->user)
        ->post(route('labels.store', [
            'name' => 'label1'
        ]))
        ->assertStatus(Response::HTTP_FOUND)
        ->assertSessionHasErrors(['name']);
});
