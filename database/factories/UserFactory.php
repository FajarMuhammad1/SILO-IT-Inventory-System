<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
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
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('password'), // default password
            'role' => $this->faker->randomElement(['admin', 'staff']),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * State khusus untuk admin.
     */
    public function admin(): static
    {
        return $this->state(fn () => [
            'role' => 'admin',
        ]);
    }

    /**
     * State khusus untuk staff.
     */
    public function staff(): static
    {
        return $this->state(fn () => [
            'role' => 'staff',
        ]);
    }
}
