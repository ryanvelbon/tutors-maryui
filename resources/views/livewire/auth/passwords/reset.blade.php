@section('title', 'Reset password')

<div>
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <a href="{{ route('home') }}">
            <x-logo class="w-auto h-16 mx-auto text-indigo-600" />
        </a>

        <h2 class="mt-6 text-3xl font-extrabold text-center text-gray-900 leading-9">
            Reset password
        </h2>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="px-4 py-8 bg-white shadow sm:rounded-lg sm:px-10">
            <form wire:submit="resetPassword">
                <input wire:model="token" type="hidden">

                <div class="space-y-4">
                    <x-input label="Email address" wire:model="email" autofocus inline icon="o-envelope" />

                    <x-input label="Password" wire:model="password" type="password" inline icon="o-key" />

                    <x-input label="Confirm Password" wire:model="passwordConfirmation" type="password" inline icon="o-key" />
                </div>

                <x-button label="Reset password" type="submit" icon="o-paper-airplane" class="mt-6 btn-primary w-full" spinner="resetPassword" />
            </form>
        </div>
    </div>
</div>
