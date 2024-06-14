<div class="bg-white px-4">
    <div class="h-16 mx-auto max-w-7xl flex justify-between items-center">
        <div class="flex items-center gap-4">
            <a href="{{ route('home') }}">
                <x-logo class="w-auto h-8 text-primary" />
            </a>
            <x-button label="Become a Tutor" :link="route('register')" class="btn-ghost" />
        </div>
        <div>
            @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-button type="submit" label="Sign out" icon="o-arrow-left-start-on-rectangle" />
                </form>
            @else
                <x-button label="Log in" icon="o-arrow-right-end-on-rectangle" :link="route('login')" />

                <x-button label="Register" icon="o-user-circle" :link="route('register')" class="btn-primary" />
            @endauth
        </div>
    </div>
</div>