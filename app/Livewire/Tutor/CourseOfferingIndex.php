<?php

namespace App\Livewire\Tutor;

use Livewire\Attributes\Layout;
use Livewire\Component;

class CourseOfferingIndex extends Component
{
    #[Layout('layouts.panel')]
    public function render()
    {
        return view('livewire.tutor.course-offering-index');
    }
}
