<nav x-data="{ openMenu: false }" class="bg-white shadow">
    <div class="container">
        <div class="flex h-16 justify-between">
            <div class="flex items-center">
                <div>
                    <a href="{{ route('home') }}">
                        <x-logo class="w-auto h-8 text-primary" />
                    </a>
                </div>
                <div class="ml-12 space-x-8 text-sm hidden sm:block">
                    <a wire:navigate href="{{ route('tutors.index') }}" class="hover:underline">Tutors</a>
                    <a wire:navigate href="{{ route('courses.index') }}" class="hover:underline">Courses</a>
                    @auth
                        <a wire:navigate href="{{ route('dashboard') }}" class="hover:underline">Dashboard</a>
                    @else
                        <a wire:navigate href="{{ route('register') }}" class="hover:underline">Become a Tutor</a>
                    @endauth
                </div>
            </div>
            <div class="hidden sm:ml-6 sm:flex sm:items-center space-x-2">
                @auth
                    <!-- Notifications dropdown -->
                    <x-button icon="o-bell" class="btn-circle btn-sm" />

                    <!-- Profile dropdown -->
                    <div x-data="{ open: false }" class="relative">
                        <x-avatar @click="open = !open" class="h-10 w-auto border-4 hover:border-primary cursor-pointer" image="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" />

                        <div x-cloak x-show="open" @click.away="open = false" class="absolute right-0 z-40 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95">
                            <!-- Active: "bg-gray-100", Not Active: "" -->
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200">Your Profile</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200">Settings</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200 w-full text-left">
                                    <x-icon name="o-arrow-left-start-on-rectangle" />
                                    Sign out
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <x-button label="Log in" icon="o-arrow-right-end-on-rectangle" :link="route('login')" class="btn-sm btn-ghost" />

                    <x-button label="Register" icon="o-user-circle" :link="route('register')" class="btn-sm btn-primary" />
                @endauth
            </div>
            <div class="-mr-2 flex items-center sm:hidden">
                <!-- Mobile menu button -->
                <button @click="openMenu = !openMenu" type="button" class="btn btn-sm btn-circle">
                    <span class="sr-only">Open main menu</span>
                    <!-- Icon when menu is closed. -->
                    <x-icon x-cloak x-show="!openMenu" name="o-bars-3" />
                    <!-- Icon when menu is open. -->
                    <x-icon x-cloak x-show="openMenu" name="o-x-mark" />
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div x-cloak x-show="openMenu" class="sm:hidden" id="mobile-menu">
        <div class="space-y-1 pb-3 pt-2">
            <a wire:navigate href="{{ route('tutors.index') }}" class="block py-2 hover:bg-gray-200 text-center">Tutors</a>
            <a wire:navigate href="{{ route('courses.index') }}" class="block py-2 hover:bg-gray-200 text-center">Courses</a>
            @auth
                <a wire:navigate href="{{ route('dashboard') }}" class="block py-2 hover:bg-gray-200 text-center">Dashboard</a>
            @else
                <a wire:navigate href="{{ route('register') }}" class="block py-2 hover:bg-gray-200 text-center">Become a Tutor</a>
            @endauth
        </div>
        <div class="border-t border-gray-200 pb-3 pt-4">
            @auth
                <div class="space-y-1">
                    <a href="#" class="block py-2 hover:bg-gray-200 text-center">Your Profile</a>
                    <a href="#" class="block py-2 hover:bg-gray-200 text-center">Settings</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block py-2 hover:bg-gray-200 w-full text-center">Sign out</button>
                    </form>
                </div>
            @else
                <div class="px-3 space-y-2">
                    <x-button label="Register" icon="o-user-circle" :link="route('register')" class="btn-primary w-full" />

                    <x-button label="Log in" icon="o-arrow-right-end-on-rectangle" :link="route('login')" class="btn-outline w-full" />
                </div>
            @endif
        </div>
    </div>
</nav>
