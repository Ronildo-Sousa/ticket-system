<?php

use App\Enums\Roles;
use App\Models\Category;
use App\Models\Label;
use App\Models\Priority;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;

beforeEach(function () {
    Category::factory(2)->create();
    Label::factory(2)->create();
    Priority::factory()->create();
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

//  REVER ESTE TESTE
it('should be able to attach files to a ticket', function () {
    Storage::fake('tickets-files');
    $files = [];
    $files[] = UploadedFile::fake()->create('test-file.php', 200);
    $files[] = UploadedFile::fake()->create('test-file2.php', 200);

    actingAs($this->user)
        ->post(route('tickets.store', [
            'title' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'priority_id' => 1,
            'categories' => [1],
            'labels' => [1, 2],
            'files' => $files,
        ]))->assertRedirectToRoute('tickets.index');

    foreach ($files as $file) {
        Storage::disk('tickets-files')->assertExists($file->hashName());
    }
});
