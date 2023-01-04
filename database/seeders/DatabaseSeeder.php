<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\user\Roles;
use App\Models\Category;
use App\Models\Label;
use App\Models\Priority;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Category::factory(3)->create();
        Label::factory(3)->create();
        Priority::factory(2)->create();

        Role::factory()->create(['name' => 'Regular']);
        Role::factory()->create(['name' => 'Agent']);
        Role::factory()->create(['name' => 'Administrator']);

        User::factory()->create([
            'email' => 'admin@admin.com',
            'role_id' => Roles::Administrator
        ]);
    }
}
