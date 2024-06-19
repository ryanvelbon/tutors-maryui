<?php

namespace App\Livewire\Auth;

use App\Enums\AccountType;
use Livewire\Attributes\Layout;
use Livewire\Component;

class RegisterAs extends Component
{
    public $accountType = '';

    public function boot()
    {
        // prevent user from accessing this page if account type already set
        if (auth()->user()->account_type) {
            return redirect()->route('home');
        }
    }

    public function updated($property)
    {
        if ($property === 'accountType') {

            $this->updateProfile();

            return redirect()->route('account.profile');
        }
    }

    private function updateProfile()
    {
        $user = auth()->user();

        switch ($this->accountType) {
            case 'student':
                $user->account_type = AccountType::Student;
                $user->studentProfile()->create();
                break;
            case 'tutor':
                $user->account_type = AccountType::Tutor;
                $user->tutorProfile()->create();
                break;
        }

        $user->save();
    }

    #[Layout('layouts.empty')]
    public function render()
    {
        return view('livewire.auth.register-as');
    }
}
