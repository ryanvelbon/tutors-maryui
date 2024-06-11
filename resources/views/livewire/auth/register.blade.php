@section('title', 'Create a new account')

<div>
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <a href="{{ route('home') }}">
            <x-logo class="w-auto h-16 mx-auto text-indigo-600" />
        </a>

        <h2 class="mt-6 text-3xl font-extrabold text-center text-gray-900 leading-9">
            Create a new account
        </h2>

        <p class="mt-2 text-sm text-center text-gray-600 leading-5 max-w">
            Or
            <a href="{{ route('login') }}" class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150">
                sign in to your account
            </a>
        </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="px-4 py-8 bg-white shadow sm:rounded-lg sm:px-10">
            <form wire:submit="register">
                <div class="space-y-4">
                    <x-input label="Username" wire:model="username" autofocus inline icon="o-user" />

                    <x-input label="Email address" wire:model="email" inline icon="o-envelope" />

                    <x-input label="Password" wire:model="password" type="password" inline icon="o-key" />

                    <x-input label="Confirm Password" wire:model="passwordConfirmation" type="password" inline icon="o-key" />
                </div>

                <x-button label="Register" type="submit" icon="o-paper-airplane" class="mt-6 btn-primary w-full" spinner="register" />
            </form>
        </div>
    </div>
</div>
