<?php

namespace App\Livewire\Tutor;

use App\Models\CourseOffering;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class CourseOfferingIndex extends Component
{
    use WithPagination;

    public array $sortBy = ['column' => 'price', 'direction' => 'desc'];

    public array $expanded = [];

    #[Layout('layouts.panel')]
    public function render()
    {
        $user = auth()->user();

        $offerings = CourseOffering::query()
            ->with('subject', 'level')
            ->where('tutor_id', $user->tutorId)
            ->orderBy(...array_values($this->sortBy))
            ->paginate(10);

        $headers = [
            ['key' => 'id', 'label' => '#'],
            ['key' => 'title', 'label' => 'Title'],
            ['key' => 'status', 'label' => 'Status'],
            ['key' => 'start_date', 'label' => 'Starts'],
            ['key' => 'subject.title', 'label' => 'Subject', 'sortable' => false],
            ['key' => 'level.code', 'label' => 'Level', 'sortable' => false],
            ['key' => 'total_hours', 'label' => 'Length', 'class' => 'text-center'],
            ['key' => 'price', 'label' => 'Price', 'class' => 'text-center'],
            ['key' => 'capacity', 'label' => 'Seats'],
        ];

        return view('livewire.tutor.course-offering-index', [
            'headers' => $headers,
            'offerings' => $offerings,
        ]);
    }
}
