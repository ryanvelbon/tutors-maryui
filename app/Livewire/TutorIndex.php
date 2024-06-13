<?php

namespace App\Livewire;

use App\Enums\UserSex;
use App\Models\Subject;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use Mary\Traits\Toast;

class TutorIndex extends Component
{
    use WithPagination;
    use Toast;

    public bool $showFilters = false;

    #[Url (as: 'subject')]
    public $subjectId;

    #[Url (as: 'gender')]
    public ?string $sex = null;

    public function updated($property): void
    {
        if ($property !== 'showFilters') {
            $this->resetPage();
        }
    }

    public function clear(): void
    {
        $this->reset();
        $this->resetPage();
        $this->success('Filters cleared.', position: 'toast-top');
    }

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
            ->when($this->sex, function ($query) {
                $query->where('sex', $this->sex);
            })
            ->paginate(12);

        $subjectOptions = Subject::all();
        $subjectOptions->prepend(['title' => 'All Subjects', 'id' => null]);

        $sexOptions = UserSex::cases();
        $sexOptions[] = ['name' => 'Any', 'value' => null];

        return view('livewire.tutor-index', [
            'tutors' => $tutors,
            'subjectOptions' => $subjectOptions,
            'sexOptions' => $sexOptions,
        ]);
    }
}
