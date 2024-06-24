<div>
    <x-drawer wire:model="showFilters" class="w-11/12 lg:w-1/3">
        <div class="flex justify-end">
            <x-button @click="$wire.showFilters = false" icon="o-x-mark" class="btn-circle btn-ghost -mr-4" />
        </div>

        <div class="mt-4 space-y-6">
            <x-button label="Reset" icon="o-x-mark" wire:click="clear" spinner />

            <x-radio label="Gender" :options="$sexOptions" option-value="value" class="w-full" wire:model.live="sex" />

            <x-select label="Subject" icon="o-academic-cap" :options="$subjectOptions" option-label="title" wire:model.live="subjectId" inline />

            <x-choices label="Localities" wire:model.live="localityIds" :options="$localityOptions" />

        </div>
    </x-drawer>

    <div class="bg-white">
        <div class="container">
            <h1 class="py-4 text-2xl font-bold">Find a tutor near you</h1>
        </div>
    </div>

    <aside
        x-data="{ scrolled: false }"
        @scroll.window="scrolled = window.scrollY > 100"
        :class="scrolled ? 'shadow-xl top-0' : ''"
        class="fixed z-40 w-full bg-white py-4 transition-colors duration-1000"
    >
        <div class="container">
            @include('partials.filters')
            <div class="mt-4 flex justify-between">
                <div>
                    <x-button label="Filters" icon="o-funnel" wire:click="$toggle('showFilters')" />
                </div>
                <div>
                    <x-dropdown label="Sort by">
                        <x-menu-item title="Our top picks" />
                        <x-menu-item title="Popularity" />
                        <x-menu-item title="Price: highest first" />
                        <x-menu-item title="Price: lowest first" />
                        <x-menu-item title="Best rating" />
                    </x-dropdown>
                </div>
            </div>
        </div>
    </aside>

    <main class="container pt-32 md:pt-48 pb-8">
        @if(!$tutors->isEmpty())
            <ul role="list" class="space-y-12 max-w-4xl">
                @foreach($tutors as $tutor)
                    <li class="bg-white rounded-2xl shadow hover:shadow-xl flex flex-col sm:flex-row">
                        <img class="aspect-[16/9] w-full sm:w-52 flex-none rounded-t-2xl sm:rounded-l-2xl sm:rounded-tr-none  object-cover" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=8&w=1024&h=1024&q=80" alt="">
                        <div class="card-body">
                            <div class="flex flex-col sm:flex-row justify-between">
                                <div>
                                    <h3 class="text-xl font-bold">Leslie Alexander</h3>
                                    <p class="text-sm leading-7 text-gray-600">Maths &bull; Physics</p>
                                    <x-icon name="o-map-pin" label="{{ $tutor->locality->name }}" class="text-sm text-gray-600" />
                                </div>
                                <div class="flex flex-row gap-6">
                                    <div class="flex flex-col">
                                        <x-icon name="s-star" label="4.8" class="h-5 text-xl font-bold" />
                                        <span class="text-gray-600 text-xs">21 reviews</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="h-5 text-xl font-bold">&euro;14</span>
                                        <span class="text-gray-600 text-xs mt-2">per hour</span>
                                    </div>
                                </div>
                            </div>
                            <div x-data="{ isExpanded: false, limit: 160, text: '{{ $tutor->bio }}' }">
                                <p x-text="isExpanded ? text : text.substring(0, limit) + (text.length > limit ? '...' : '')" class="text-base leading-6"></p>
                                <button x-show="text.length > limit" @click="isExpanded = !isExpanded" class="mt-2 underline font-semibold hover:text-primary">
                                    <span x-text="isExpanded ? 'Read less' : 'Read more'"></span>
                                </button>
                            </div>
                            <div class="mt-4 flex items-center justify-between">
                                <ul role="list" class="flex gap-x-3">
                                    <x-button icon="o-heart" class="btn-circle btn-sm" tooltip-bottom="Save to my list" />
                                    <x-button icon="o-share" class="btn-circle btn-sm" tooltip-bottom="Share" />
                                </ul>
                                <x-button label="Message" class="btn-primary" />
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <div class="bg-gray-100 h-96 flex flex-col gap-6 items-center justify-center">
                <x-icon name="o-magnifying-glass" class="w-16 h-16" />
                <p class="text-2xl font-bold text-gray-800">No tutors found.</p>
                <p class="text-gray-600">There are no matching tutors for your search criteria. Try updating your search.</p>
                <x-button label="Update search" wire:click="$toggle('showFilters')" class="btn-primary" />
            </div>
        @endif

        @if(!$tutors->isEmpty())
            <div class="my-4">
                {{ $tutors->links() }}
            </div>
        @endif
    </main>

</div>
