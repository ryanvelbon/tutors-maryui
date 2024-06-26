<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            LocalitySeeder::class,
            AcademicYearSeeder::class,
            LevelSeeder::class,
            SubjectSeeder::class,
            SchoolSeeder::class,
        ]);
    }
}
