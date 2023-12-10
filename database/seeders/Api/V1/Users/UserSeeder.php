<?php

namespace Database\Seeders\Api\V1\Users;

use App\Models\Api\V1\Users\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'status' => 1,
            'first_name' => 'SuperAdmin',
            'last_name' => 'Chuck Norris',
            'email' => 'spadmin@mail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('Secret1234*'),
            'remember_token' => Str::random(10),
        ]);

        User::factory()->times(4)->create();
    }
}
