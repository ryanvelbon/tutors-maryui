<?php

namespace App\Livewire\Panel;

use Livewire\Attributes\Layout;
use Livewire\Component;

class EditProfile extends Component
{
    #[Layout('layouts.panel')]
    public function render()
    {
        return view('livewire.panel.edit-profile');
    }
}
