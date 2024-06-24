<?php

namespace App\Livewire;

use App\Enums\UserSex;
use App\Models\Level;
use App\Models\Locality;
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

    #[Url (as: 'localities')]
    public $localityIds = [];

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
        $this->success('Filters cleared.', position: 'toast-bottom');
    }

    public function render()
    {
        $tutors = User::query()
            ->tutors()
            ->with('subjects', 'locality')
            ->when($this->subjectId, function ($query) {
                $query->whereHas('subjects', function ($query) {
                    $query->where('subject_id', $this->subjectId);
                });
            })
            ->when($this->localityIds, function ($query) {
                $query->whereIn('locality_id', $this->localityIds);
            })
            ->when($this->sex, function ($query) {
                $query->where('sex', $this->sex);
            })
            ->paginate(12);

        $subjectOptions = Subject::orderBy('title', 'ASC')->get();
        $subjectOptions->prepend(['title' => 'All Subjects', 'id' => null]);

        $levelOptions = $this->subjectId ? Subject::find($this->subjectId)->levels : collect([]);
        $levelOptions->prepend(['title' => 'Any Level', 'id' => null]);

        $localityOptions = Locality::orderBy('name', 'ASC')->get();
        $localityOptions->prepend(['name' => 'Anywhere', 'id' => null]);

        $sexOptions = UserSex::cases();
        $sexOptions[] = ['name' => 'Any', 'value' => null];

        return view('livewire.tutor-index', [
            'tutors' => $tutors,
            'subjectOptions' => $subjectOptions,
            'levelOptions' => $levelOptions,
            'localityOptions' => $localityOptions,
            'sexOptions' => $sexOptions,
        ]);
    }
}
