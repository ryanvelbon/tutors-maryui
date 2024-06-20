<?php

namespace App\Livewire\Tutor;

use App\Models\Course;
use App\Models\CourseOffering;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Mary\Traits\Toast;

class CourseOfferingCreate extends Component
{
    use Toast;

    public $step = 1;
    public $totalSteps = 6;

    public $courseId;
    public $totalHours;
    public $price;
    public $capacity;
    public $startDate;

    protected $stepRules = [
        1 => [
            // *TODO* ensure courseId references a course belonging to current user
        ],
        2 => [
            'capacity' => 'required|integer|min:3|max:30',
            'totalHours' => 'required|int|min:1|max:100',
            'price' => 'required|int|min:10|max:999',
        ],
        3 => [
            'startDate' => 'required|date|after:today|before:+2 years',
        ],
    ];

    public function updated($property)
    {
        if ($property === 'courseId') {
            $this->step = 2;

            $course = Course::find($this->courseId);
            $this->totalHours = $course->total_hours;
            $this->price = $course->price;
        }
    }

    public function nextStep()
    {
        if (in_array($this->step, array_keys($this->stepRules))) {
            $this->validate($this->stepRules[$this->step]);
        }

        if ($this->step < $this->totalSteps) {
            $this->step = $this->step + 1;
        } else {
            $this->save();
        }
    }

    public function previousStep()
    {
        if ($this->step > 2) {
            $this->step = $this->step - 1;
        }
    }

    private function save()
    {
        $data = Course::find($this->courseId)->only('title', 'description', 'subject_id', 'level_id', 'tutor_id');

        $data['course_id'] = $this->courseId;
        $data['total_hours'] = $this->totalHours;
        $data['capacity'] = $this->capacity;
        $data['price'] = $this->price;
        $data['start_date'] = $this->startDate;

        CourseOffering::create($data);

        $this->success('Course Offering created.', redirectTo: route('tutor.courseOfferings.index'));
    }

    #[Layout('layouts.empty')]
    public function render()
    {
        $user = auth()->user();

        $courses = Course::query()
            ->with('subject', 'level')
            ->where('tutor_id', $user->tutorId)
            ->get();

        $course = $courses->firstWhere('id', $this->courseId);

        return view('livewire.tutor.course-offering-create', [
            'courses' => $courses,
            'course' => $course,
        ]);
    }
}
