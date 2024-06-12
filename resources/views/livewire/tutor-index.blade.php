<div class="py-24 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <x-drawer wire:model="showFilters" class="w-11/12 lg:w-1/3">
        <x-button label="Close" @click="$wire.showFilters = false" />
    </x-drawer>

    <h2 class="text-4xl font-gray-800 font-bold text-center">Tutors</h2>

    <div class="my-6">
        <x-button label="Filters" icon="o-funnel" wire:click="$toggle('showFilters')" />
    </div>

    @if(!$tutors->isEmpty())
        <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($tutors as $tutor)
                <div class="bg-gray-100 p-4 h-64 rounded-lg flex flex-col justify-between">

                    <div class="flex justify-between items-center">
                        <h3 class="font-semibold">{{ $tutor->full_name }}</h3>
                        <div>
                            <x-button icon="o-envelope" class="btn-circle btn-sm" />
                            <x-button icon="o-phone" class="btn-circle btn-sm" />
                        </div>
                    </div>

                    <div>
                        <p class="text-sm text-gray-600">{{ $tutor->bio }}</p>
                    </div>

                    <div class="flex flex-wrap gap-1">
                        @foreach($tutor->subjects as $subject)
                            <span class="bg-gray-300 text-xs px-2 py-1 rounded">{{ $subject->title }}</span>
                        @endforeach
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

</div>
