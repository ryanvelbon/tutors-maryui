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
        $price = rand(5, 15);

        return [
            'user_id' => User::factory()->create([
                'title' => fake()->randomElement(UserTitle::cases()),
                'account_type' => AccountType::Tutor,
                'price_per_hour_individual' => $price * rand(2,5),
                'price_per_hour_group' => $price,
            ]),
        ];
    }
}
