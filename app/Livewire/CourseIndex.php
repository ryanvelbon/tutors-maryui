<?php

namespace App\Livewire;

use App\Models\Course;
use Livewire\Component;
use Livewire\WithPagination;

class CourseIndex extends Component
{
    use WithPagination;

    public function render()
    {
        $courses = Course::query()
            ->with(['tutor.user', 'subject', 'level'])
            ->paginate(10);

        return view('livewire.course-index', [
            'courses' => $courses,
        ]);
    }
}
