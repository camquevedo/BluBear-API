<?php

namespace Database\Factories\Api\V1\Users;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Api\V1\Users\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'status' => $this->faker->boolean(85),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => $this->faker->boolean() ?
                $this->faker->dateTimeThisYear() : null,
            'password' => $this->faker->password(),
            'deleted_at' => $this->faker->boolean() ?
                now() : null
        ];
    }
}
