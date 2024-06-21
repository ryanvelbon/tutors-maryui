<?php

namespace App\Livewire\Tutor;

use App\Models\Lesson;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Dashboard extends Component
{
    #[Layout('layouts.panel')]
    public function render()
    {
        $user = auth()->user();

        $lessonsThisWeek = Lesson::query()
            ->with('subject', 'courseOffering.level')
            ->where('tutor_id', $user->tutorId)
            ->thisWeek()
            ->orderBy('starts_at', 'asc')
            ->get();

        return view('livewire.tutor.dashboard', [
            'lessonsThisWeek' => $lessonsThisWeek,
        ]);
    }
}
