<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => substr(ucwords(fake()->text(40)), 0, -1),
            'description' => fake()->paragraph(),
            'subject_id' => \App\Models\Subject::inRandomOrder()->first(),
            'level_id'   => \App\Models\Level::inRandomOrder()->first(),
            'tutor_id'   => \App\Models\Tutor::inRandomOrder()->first(),
        ];
    }
}
