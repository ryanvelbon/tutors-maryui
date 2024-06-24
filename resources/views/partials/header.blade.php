<div class="bg-white">
    <div class="container h-16 flex justify-between items-center">
        <div class="flex items-center gap-2">
            <a href="{{ route('home') }}">
                <x-logo class="w-auto h-8 text-primary" />
            </a>
            <x-button label="Tutors" :link="route('tutors.index')" class="btn-ghost" />
            <x-button label="Courses" :link="route('courses.index')" class="btn-ghost" />
            @auth
                <x-button label="Dashboard" :link="route('dashboard')" class="btn-ghost" />
            @else
                <x-button label="Become a Tutor" :link="route('register')" class="btn-ghost" />
            @endauth
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