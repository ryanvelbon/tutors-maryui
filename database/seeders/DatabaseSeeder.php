<?php

namespace Database\Seeders;

use App\Models\Lesson;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Tutor;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'username' => 'john2000',
            'email' => 'john@x.com',
        ]);

        $this->call([
            SubjectSeeder::class,
            AcademicYearSeeder::class,
            LevelSeeder::class,
            SchoolSeeder::class,
        ]);

        $subjectIds = Subject::pluck('id');

        $tutors = Tutor::factory(50)->create();

        // assign random subjects to each tutor
        $tutors->map(function (Tutor $tutor) use ($subjectIds) {
            $tutor->user->subjects()->sync($subjectIds->random(rand(1,2)));
        });

        $students = Student::factory(100)->create();

        $lessons = Lesson::factory(200)->create();
    }
}
