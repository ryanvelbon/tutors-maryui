@section('title', 'Edit Profile')

<div>
    <x-header title="Profile" subtitle="This is where you edit your profile." separator />

    <x-form wire:submit="save" class="max-w-3xl mx-auto">

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
            <x-input wire:model="firstName" label="First Name" inline />

            <x-input wire:model="lastName" label="Last Name" inline />

            <x-select wire:model="sex" label="Gender" :options="$sexOptions" optionValue="value" placeholder="Choose an option" inline />

            <x-select wire:model="title" label="Title" :options="$titleOptions" optionValue="value" placeholder="Choose an option" inline />
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-2">
            <div>
                <select class="select w-full" wire:model="dobD">
                    <option value="">DD</option>
                    @for($i=1; $i<=31; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
                @error('dobD')
                    <div class="text-red-500 label-text-alt p-1">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <select class="select w-full" wire:model="dobM">
                    <option value="">MM</option>
                    @php
                        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                    @endphp
                    @foreach($months as $value => $label)
                        <option value="{{ $value+1 }}">{{ $label }}</option>
                    @endforeach
                </select>
                @error('dobM')
                    <div class="text-red-500 label-text-alt p-1">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <select class="select w-full" wire:model="dobY">
                    <option value="">YYYY</option>
                    @for($i = 2020; $i >= 1920; $i--)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
                @error('dobY')
                    <div class="text-red-500 label-text-alt p-1">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <x-slot:actions>
            <x-button label="Save Changes" class="btn-primary" type="submit" spinner="save" />
        </x-slot:actions>
    </x-form>
</div>
