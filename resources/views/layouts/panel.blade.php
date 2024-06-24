@extends('layouts.base')

@section('body')
<body class="min-h-screen font-sans antialiased bg-base-200/50 dark:bg-base-200">

    {{-- NAVBAR mobile only --}}
    <x-nav sticky class="lg:hidden">
        <x-slot:brand>
            <a href="{{ route('home') }}">App</a>
        </x-slot:brand>
        <x-slot:actions>
            <label for="main-drawer" class="lg:hidden mr-3">
                <x-icon name="o-bars-3" class="cursor-pointer" />
            </label>
        </x-slot:actions>
    </x-nav>

    {{-- MAIN --}}
    <x-main full-width>
        <x-slot:sidebar drawer="main-drawer" collapsible class="bg-base-100 lg:bg-inherit">

            <div class="ml-5 pt-5">
                <a href="{{ route('home') }}">App</a>
            </div>

            <x-menu activate-by-route>

                @if($user = auth()->user())
                    <x-menu-separator />

                    <x-list-item :item="$user" value="name" sub-value="email" no-separator no-hover class="-mx-2 !-my-2 rounded">
                        <x-slot:actions>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-button type="submit" icon="o-power" class="btn-circle btn-ghost btn-xs" tooltip-left="logoff" />
                            </form>
                        </x-slot:actions>
                    </x-list-item>

                    <x-menu-separator />
                @endif

                <x-menu-item title="Dashboard" icon="o-home" :link="route('dashboard')" />

                @if($user->isTutor())
                    <x-menu-item title="Courses" icon="o-square-2-stack" :link="route('tutor.courses.index')" />
                    <x-menu-item title="Cohorts" icon="o-user-group" :link="route('tutor.courseOfferings.index')" />
                @endif

                <x-menu-item title="Lessons" icon="o-calendar-days" :link="route('lessons')" />
                <x-menu-item title="Stats" icon="o-chart-bar-square" link="#" />
                <x-menu-item title="Messages" icon="o-chat-bubble-bottom-center-text" link="#" />

                <x-menu-sub title="Account" icon="o-user-circle">
                    <x-menu-item title="Profile" icon="o-identification" :link="route('account.profile')" />
                    <x-menu-item title="Settings" icon="o-cog-6-tooth" :link="route('account.settings')" />
                </x-menu-sub>
            </x-menu>
        </x-slot:sidebar>

        <x-slot:content>
            {{ $slot }}
        </x-slot:content>
    </x-main>

    <x-toast />
</body>
@endsection
