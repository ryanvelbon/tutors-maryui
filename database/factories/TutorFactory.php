<?php

namespace Database\Factories;

use App\Enums\AccountType;
use App\Enums\UserTitle;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TutorFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory()->create([
                'title' => fake()->randomElement(UserTitle::cases()),
                'account_type' => AccountType::Tutor,
            ]),
        ];
    }
}
