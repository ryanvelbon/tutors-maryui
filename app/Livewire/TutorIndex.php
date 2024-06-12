<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Url;

class TutorIndex extends Component
{
    public bool $showFilters = false;

    #[Url (as: 'subject')]
    public $subjectId;

    public function render()
    {
        $tutors = User::query()
            ->tutors()
            ->with('subjects')
            ->when($this->subjectId, function ($query) {
                $query->whereHas('subjects', function ($query) {
                    $query->where('subject_id', $this->subjectId);
                });
            })
            ->get();

        return view('livewire.tutor-index', [
            'tutors' => $tutors,
        ]);
    }
}
