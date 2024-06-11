@section('title', 'Confirm your password')

<div>
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <a href="{{ route('home') }}">
            <x-logo class="w-auto h-16 mx-auto text-indigo-600" />
        </a>

        <h2 class="mt-6 text-3xl font-extrabold text-center text-gray-900 leading-9">
            Confirm your password
        </h2>
        <p class="mt-2 text-sm text-center text-gray-600 leading-5 max-w">
            Please confirm your password before continuing
        </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="px-4 py-8 bg-white shadow sm:rounded-lg sm:px-10">
            <form wire:submit="confirm">
                <x-input label="Password" wire:model="password" type="password" autofocus inline />

                <div class="flex items-center justify-end mt-6">
                    <div class="text-sm leading-5">
                        <a href="{{ route('password.request') }}" class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150">
                            Forgot your password?
                        </a>
                    </div>
                </div>

                <x-button label="Confirm password" type="submit" icon="o-paper-airplane" class="mt-6 btn-primary w-full" spinner="confirm" />
            </form>
        </div>
    </div>
</div>
