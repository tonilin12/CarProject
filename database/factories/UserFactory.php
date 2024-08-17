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
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Models\User::class;

    /**
     * The current password being used by the factory.
     */
    protected static ?string $password = null;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->name(), // Unique name
            'email' => $this->faker->unique()->safeEmail(), // Unique email
            'admin' => $this->faker->boolean(), // Random boolean for admin
            'email_verified_at' => now(), // Automatically set email verified timestamp
            'password' => static::$password ??= Hash::make('password'), // Default password
            'remember_token' => Str::random(10), // Random remember token
            'phone_number' => $this->faker->phoneNumber(), // Fake phone number
            'address' => $this->faker->address(), // Fake address
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
