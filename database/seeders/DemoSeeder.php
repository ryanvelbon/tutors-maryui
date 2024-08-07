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
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DemoSeeder extends Seeder
{
    public function run(): void
    {
        $n = 10; // number of tutors



        /*                   S T U D E N T S
        =========================================================*/


        Student::factory(1000)->create();



        /*                    T U T O R S
         =========================================================*/


        for ($i=0; $i < $n ; $i++) {
            Tutor::factory()
                ->hasReviews(rand(0,10))
                ->create();
        }

        $tutors = Tutor::all();

        /*
         * Populates junction table `tutor_subject_level` so that each
         * tutor teaches a few subjects (at specific levels)
         */

        foreach ($tutors as $tutor) {

            $subjects = Subject::inRandomOrder()->take(2)->get();

            foreach ($subjects as $subject) {

                $levelIds = $subject->levels->shuffle()->take(rand(1,3))->pluck('id')->toArray();

                $tutor->addSubject($subject, $levelIds);
            }
        }



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
    }
}
