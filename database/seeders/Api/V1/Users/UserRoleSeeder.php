<?php

namespace Database\Seeders\Api\V1\Users;

use Illuminate\Database\Seeder;
use App\Models\Api\V1\Users\UserRole;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserRole::factory()->create([
            'role_id' => 1,
            'user_id' => 1,
        ]);

        UserRole::factory()->create([
            'role_id' => 1,
            'user_id' => 2,
        ]);

        UserRole::factory()->create([
            'role_id' => 2,
            'user_id' => 3,
        ]);

        UserRole::factory()->create([
            'role_id' => 3,
            'user_id' => 4,
        ]);

        UserRole::factory()->create([
            'role_id' => 4,
            'user_id' => 5,
        ]);
    }
}