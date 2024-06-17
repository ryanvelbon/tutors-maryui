<?php

namespace Database\Factories;

use App\Enums\AccountType;
use App\Models\AcademicYear;
use App\Models\School;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory()->create([
                'title' => null,
                'account_type' => AccountType::Student,
                'dob' => fake()->dateTimeBetween('-18 years', '-5 years')->format('Y-m-d'),
            ]),
            'school_id' => School::inRandomOrder()->first(),
            'academic_year_id' => AcademicYear::inRandomOrder()->first(),
        ];
    }
}
