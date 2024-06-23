<?php

namespace Database\Seeders;

use App\Enums\CourseOfferingStatus;
use App\Enums\LessonStatus;
use App\Models\Course;
use App\Models\CourseOffering;
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
            LocalitySeeder::class,
            AcademicYearSeeder::class,
            LevelSeeder::class,
            SubjectSeeder::class,
            SchoolSeeder::class,
        ]);

        $subjectIds = Subject::pluck('id');

        $n = 50; // number of tutors



        /*                    T U T O R S
         =========================================================*/


        $tutors = Tutor::factory($n)->create();

        // assign random subjects to each tutor
        $tutors->map(function (Tutor $tutor) use ($subjectIds) {
            $tutor->user->subjects()->sync($subjectIds->random(rand(1,2)));
        });



        /*                    C O U R S E S
         =========================================================*/


        $courses = Course::factory($n*3)->create();



        /*            C O U R S E   O F F E R I N G S
         =========================================================*/


        foreach ($courses as $course) {

            $nOfferings = rand(0, 10);

            for ($i=0; $i < $nOfferings ; $i++) {
                $data = $course->only('title', 'description', 'subject_id', 'level_id', 'tutor_id', 'total_hours', 'price');
                $data['capacity'] = fake()->randomElement([4,5,6,8,10,12,15,16,18,20,25,30]);
                $data['start_date'] = fake()->dateTimeBetween('-1 year', '+1 year')->format('Y-m-d');
                $data['course_id'] = $course->id;
                $data['status'] = fake()->randomElement(CourseOfferingStatus::cases());
                CourseOffering::create($data);
            }
        }



        /*                     L E S S O N S
         =========================================================*/


        $offerings = CourseOffering::all();

        foreach ($offerings as $offering) {

            $minutesPerLesson = fake()->randomElement([45,60,90,120]);
            $totalMinutes = $offering->total_hours * 60;
            $nMinutes = 0;

            $hh = rand(15, 18);
            $mm = fake()->randomElement([0, 30]);
            $startsAt = $offering->start_date;
            $startsAt->hour($hh)->minute($mm);

            while ($nMinutes < $totalMinutes) {

                $endsAt = clone $startsAt;
                $endsAt->addMinutes($minutesPerLesson);

                Lesson::factory()->create([
                    'tutor_id' => $offering->tutor_id,
                    'subject_id' => $offering->subject_id,
                    'course_offering_id' => $offering->id,
                    'capacity' => $offering->capacity,
                    'starts_at' => $startsAt,
                    'ends_at' => $endsAt,
                ]);

                $nMinutes += $minutesPerLesson;

                $startsAt->addDays(7);
            }
        }

        Lesson::past()->update(['status' => LessonStatus::Completed]);
        Lesson::past()->inRandomOrder()->take(50)->update(['status' => LessonStatus::Cancelled]);


        /*                   S T U D E N T S
         =========================================================*/


        $students = Student::factory($n*10)->create();
    }
}
