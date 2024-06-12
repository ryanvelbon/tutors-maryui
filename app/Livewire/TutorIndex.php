<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class TutorIndex extends Component
{
    public function render()
    {
        $tutors = User::tutors()->get();

        return view('livewire.tutor-index', [
            'tutors' => $tutors,
        ]);
    }
}
