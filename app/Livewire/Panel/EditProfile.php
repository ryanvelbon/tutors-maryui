<?php

namespace App\Livewire\Panel;

use App\Enums\UserSex;
use App\Enums\UserTitle;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Mary\Traits\Toast;

class EditProfile extends Component
{
    use Toast;

    public $firstName;
    public $lastName;
    public $sex;
    public $title;

    public $dobD;
    public $dobM;
    public $dobY;

    public $sexOptions;
    public $titleOptions;

    public function mount()
    {
        $user = auth()->user();

        $this->firstName = $user->first_name;
        $this->lastName = $user->last_name;
        $this->sex = $user->sex->value;
        $this->title = $user->title->value;
        $this->dobD = $user->dob->day;
        $this->dobM = $user->dob->month;
        $this->dobY = $user->dob->year;

        $this->sexOptions = array_map(function($case) {
            return [
                'id' => $case->value,
                'name' => $case->name,
            ];
        }, UserSex::cases());

        $this->titleOptions = array_map(function ($case) {
            return [
                'id' => $case->value,
                'name' => $case->name,
            ];
        }, UserTitle::cases());
    }

    public function save()
    {
        $data = $this->validate([
            'firstName' => 'required|string|min:2|max:25|regex:/^[a-zA-Z\s]*$/',
            'lastName'  => 'required|string|min:2|max:25|regex:/^[a-zA-Z\s]*$/',

            'sex'   => ['required', Rule::in(UserSex::cases())],
            'title' => ['nullable', Rule::in(UserTitle::cases())],

            'dobD' => 'required|int|min:1|max:31',
            'dobM' => 'required|int|min:1|max:12',
            'dobY' => 'required|int|min:1920|max:2020',
        ]);

        $dob = Carbon::create($this->dobY, $this->dobM, $this->dobD);

        auth()->user()->update([
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'sex' => $this->sex,
            'title' => $this->title,
            'dob' => $dob,
        ]);

        $this->success('Profile updated');
    }

    #[Layout('layouts.panel')]
    public function render()
    {
        return view('livewire.panel.edit-profile');
    }
}
