<?php

namespace Database\Factories;

use App\Models\Subject;
use App\Models\Tutor;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class LessonFactory extends Factory
{
    public function definition(): array
    {
        $duration = fake()->randomElement([45, 60, 90, 120]);
        $hh = rand(14, 17);
        $mm = fake()->randomElement([0, 30]);
        $startsAt = fake()->dateTimeBetween('-3 months', '+3 months')->setTime($hh, $mm);
        $endsAt = clone $startsAt;
        $endsAt->modify("+ $duration min");

        return [
            'title' => substr(ucwords(fake()->text(40)), 0, -1),
            'description' => fake()->paragraph(),
            'capacity' => rand(1,5) > 4 ? 1 : fake()->randomElement([1, 2, 3, 4, 5, 10]),
            'starts_at' => $startsAt,
            'ends_at' => $endsAt,
            'subject_id' => Subject::inRandomOrder()->first() ?? Subject::factory()->create(),
            'tutor_id' => Tutor::inRandomOrder()->first() ?? Tutor::factory()->create(),
        ];
    }

}
