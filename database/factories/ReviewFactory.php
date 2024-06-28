<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::students()->inRandomOrder()->first() ?? Student::factory()->create()->user,
            'comment' => fake()->sentence(),
            'rating' => rand(1,5),
        ];
    }
}
