<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'login_id' => fake()->unique()->userName(),
            'name' => fake()->name(),
            'password' => static::$password ??= Hash::make('password'),
            'role' => fake()->randomElement(['admin', 'manager', 'staff']),
            'code' => fake()->optional()->bothify('##??##'),
        ];
    }

    /**
     * Indicate that the user should be an admin.
     */
    public function admin(): static
    {
        return $this->state(fn(array $attributes) => [
            'role' => 'admin',
        ]);
    }

    /**
     * Indicate that the user should be a manager.
     */
    public function manager(): static
    {
        return $this->state(fn(array $attributes) => [
            'role' => 'manager',
        ]);
    }

    /**
     * Indicate that the user should be a staff.
     */
    public function staff(): static
    {
        return $this->state(fn(array $attributes) => [
            'role' => 'staff',
        ]);
    }
}
