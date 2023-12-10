<?php

namespace Database\Seeders\Api\V1\Users;

use Illuminate\Database\Seeder;
use App\Models\Api\V1\Users\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::factory()->create([
            'name' => 'superadmin',
        ]);

        Role::factory()->create([
            'name' => 'admin',
        ]);

        Role::factory()->create([
            'name' => 'editor',
        ]);

        Role::factory()->create([
            'name' => 'user',
        ]);

    }
}