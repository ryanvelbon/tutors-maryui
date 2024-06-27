<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SubjectFactory extends Factory
{
    public function definition(): array
    {
        $title = rtrim(fake()->text(15), '.');

        return [
            'title' => $title,
            'slug' => Str::slug($title),
        ];
    }
}
