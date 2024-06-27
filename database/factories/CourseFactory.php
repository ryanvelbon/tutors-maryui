<?php

namespace Database\Factories;

use App\Models\Level;
use App\Models\Subject;
use App\Models\Tutor;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    public function definition(): array
    {
        $totalHours = rand(2,20) * 2;
        $hourlyRate = rand(3,10);

        return [
            'title' => substr(ucwords(fake()->text(40)), 0, -1),
            'description' => fake()->paragraph(),
            'subject_id' => Subject::inRandomOrder()->first() ?? Subject::factory(),
            'level_id'   => Level::inRandomOrder()->first() ?? Level::factory(),
            'tutor_id'   => Tutor::inRandomOrder()->first() ?? Tutor::factory(),
            'total_hours' => $totalHours,
            'price' => $totalHours * $hourlyRate,
        ];
    }
}
