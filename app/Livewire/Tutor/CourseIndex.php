<?php

namespace App\Livewire\Tutor;

use App\Models\Course;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class CourseIndex extends Component
{
    use WithPagination;

    public array $sortBy = ['column' => 'price', 'direction' => 'desc'];

    #[Layout('layouts.panel')]
    public function render()
    {
        $user = auth()->user();

        $courses = Course::query()
            ->with('subject', 'level')
            ->where('tutor_id', $user->tutorId)
            ->orderBy(...array_values($this->sortBy))
            ->paginate(10);

        $headers = [
            ['key' => 'id', 'label' => '#'],
            ['key' => 'title', 'label' => 'Title'],
            ['key' => 'subject.title', 'label' => 'Subject', 'sortable' => false],
            ['key' => 'level.title', 'label' => 'Level', 'sortable' => false],
            ['key' => 'total_hours', 'label' => 'Length', 'class' => 'text-center'],
            ['key' => 'price', 'label' => 'Price', 'class' => 'text-center'],
        ];

        return view('livewire.tutor.course-index', [
            'headers' => $headers,
            'courses' => $courses,
        ]);
    }
}
