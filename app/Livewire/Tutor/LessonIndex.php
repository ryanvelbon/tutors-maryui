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
            ['key' => 'starts_at', 'label' => 'Date'],
            ['key' => 'start_time', 'label' => 'Starts', 'sortable' => false],
            ['key' => 'end_time', 'label' => 'Ends', 'sortable' => false],
            ['key' => 'status', 'label' => 'Status'],
            ['key' => 'subject.title', 'label' => 'Subject'],
            ['key' => 'title', 'label' => 'Title'],
        ];

        return view('livewire.tutor.lesson-index', [
            'headers' => $headers,
            'lessons' => $lessons,
        ]);
    }
}
