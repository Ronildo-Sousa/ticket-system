<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\Roles;
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
        Role::factory()->create(['name' => 'Regular']);
        Role::factory()->create(['name' => 'Agent']);
        Role::factory()->create(['name' => 'Administrator']);

        User::factory()->create([
            'email' => 'admin@admin.com',
            'role_id' => Roles::Administrator
        ]);
    }
}
