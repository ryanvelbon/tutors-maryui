<?php

namespace App\Livewire\Tutor;

use App\Models\Course;
use App\Models\Level;
use App\Models\Subject;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Mary\Traits\Toast;

class CourseCreate extends Component
{
    use Toast;

    #[Validate('required|min:20|max:40')]
    public $title;

    #[Validate('required|min:50|max:200')]
    public $description;

    #[Validate('required')]
    public $subject_id;

    #[Validate('required')]
    public $level_id;

    #[Validate('required|int|min:1|max:100')]
    public $total_hours;

    #[Validate('required|int|min:10|max:999')]
    public $price;

    public function save()
    {
        $data = $this->validate();
        $data['tutor_id'] = auth()->user()->tutorId;

        $course = Course::create($data);

        $this->success('Course created. Click here to offer the course.', redirectTo: route('tutor.courses.index'));
    }

    #[Layout('layouts.empty')]
    public function render()
    {
        $subjects = Subject::all();
        $levels = Level::all();

        return view('livewire.tutor.course-create', [
            'subjects' => $subjects,
            'levels' => $levels,
        ]);
    }
}
