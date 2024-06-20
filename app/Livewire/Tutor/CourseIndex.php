<?php

namespace App\Livewire\Tutor;

use App\Models\Course;
use Livewire\Attributes\Layout;
use Livewire\Component;

class CourseIndex extends Component
{
    #[Layout('layouts.panel')]
    public function render()
    {
        $user = auth()->user();

        $courses = Course::query()
            ->with('subject', 'level')
            ->where('tutor_id', $user->tutorId)
            ->get();

        $headers = [
            ['key' => 'id', 'label' => '#'],
            ['key' => 'title', 'label' => 'Title'],
            ['key' => 'subject.title', 'label' => 'Subject'],
            ['key' => 'level.title', 'label' => 'Level'],
            ['key' => 'total_hours', 'label' => 'Length', 'class' => 'text-center'],
            ['key' => 'price', 'label' => 'Price', 'class' => 'text-center'],
        ];

        return view('livewire.tutor.course-index', [
            'headers' => $headers,
            'courses' => $courses,
        ]);
    }
}
