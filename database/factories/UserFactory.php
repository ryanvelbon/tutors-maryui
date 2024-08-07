<?php

namespace Database\Factories;

use App\Models\Locality;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected static ?string $password;

    public function definition(): array
    {
        return [
            'username' => fake()->username(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'dob' => fake()->dateTimeBetween('-65 years', '-18 years')->format('Y-m-d'),
            'sex' => fake()->randomElement(['m', 'f']),
            'tagline' => fake()->text(70),
            'bio' => fake()->text(rand(100,1000)),
            'avatar' => 'user' . rand(1,100) . '.png',
            'locality_id' => Locality::inRandomOrder()->first(),
        ];
    }

    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
