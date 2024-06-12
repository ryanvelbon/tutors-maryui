<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class TutorIndex extends Component
{
    public bool $showFilters = false;

    public function render()
    {
        $tutors = User::tutors()
            ->with('subjects')
            ->get();

        return view('livewire.tutor-index', [
            'tutors' => $tutors,
        ]);
    }
}
