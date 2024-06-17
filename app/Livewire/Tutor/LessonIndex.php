<?php

namespace App\Livewire\Tutor;

use App\Models\Lesson;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class LessonIndex extends Component
{
    use WithPagination;

    public array $sortBy = ['column' => 'starts_at', 'direction' => 'asc'];

    public array $expanded = [];

    #[Layout('layouts.panel')]
    public function render()
    {
        $user = auth()->user();

        $lessons = Lesson::query()
            ->where('tutor_id', $user->tutorId)
            ->orderBy(...array_values($this->sortBy))
            ->paginate(10);

        $headers = [
            ['key' => 'title', 'label' => 'Title'],
            ['key' => 'subject.title', 'label' => 'Subject'],
            ['key' => 'date', 'label' => 'Date'],
            ['key' => 'starts_at', 'label' => 'Starts'],
            ['key' => 'ends_at', 'label' => 'Ends'],
        ];

        return view('livewire.tutor.lesson-index', [
            'headers' => $headers,
            'lessons' => $lessons,
        ]);
    }
}
