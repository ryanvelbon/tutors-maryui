<div class="py-24 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
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

    <h2 class="text-4xl font-gray-800 font-bold text-center">Tutors</h2>

    <div class="my-6 flex justify-between">
        <x-button label="Filters" icon="o-funnel" wire:click="$toggle('showFilters')" />

        <x-radio :options="$subjectOptions" option-label="title" class="w-full text-xs text-nowrap" wire:model.live="subjectId" />
    </div>

    @if(!$tutors->isEmpty())
        <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($tutors as $tutor)
                <div class="bg-gray-100 rounded-lg">
                    <div class="p-4 h-96 flex flex-col">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center gap-1">
                                <x-icon name="o-map-pin" />
                                <span>{{ $tutor->locality->name }}</span>
                            </div>
                            <div class="flex flex-col items-end leading-tight">
                                <span class="text-2xl font-bold">€{{ $tutor->price_per_hour_individual }}</span>
                                <span class="text-xs text-gray-600">per hour</span>
                            </div>
                        </div>

                        <div class="grow flex flex-col items-center space-y-2">
                            <img class="h-24 w-24 rounded-full bg-gray-800" src="{{ $tutor->avatar ?? '/assets/img/user.jpg' }}" alt="">
                            <h2 class="text-gray-800 font-bold text-lg">{{ $tutor->full_name }}</h2>
                            <p class="text-center text-sm text-gray-600">{{ $tutor->bio }}</p>
                        </div>

                        <div class="flex flex-wrap justify-center gap-1">
                            @foreach($tutor->subjects as $subject)
                                <span class="bg-gray-300 text-xs px-2 py-1 rounded">{{ $subject->title }}</span>
                            @endforeach
                        </div>
                    </div>
                    <div class="px-4 py-2 flex justify-center gap-2">
                        <x-button icon="o-envelope" class="btn-circle btn-sm" />
                        <x-button icon="o-phone" class="btn-circle btn-sm" />
                    </div>
                </div>
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

</div>
