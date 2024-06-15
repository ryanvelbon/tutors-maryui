<?php

namespace App\Livewire\Student;

use Livewire\Attributes\Layout;
use Livewire\Component;

class LessonIndex extends Component
{
    #[Layout('layouts.panel')]
    public function render()
    {
        return view('livewire.student.lesson-index');
    }
}
