<?php

namespace App\Livewire\Panel;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Settings extends Component
{
    #[Layout('layouts.panel')]
    public function render()
    {
        return view('livewire.panel.settings');
    }
}
