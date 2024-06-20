@section('title', 'Offer a course')

<div class="px-4">
    
    @if($step < 2)
        <x-button
            label="Go back"
            icon="o-chevron-left"
            :link="route('tutor.courseOfferings.index')"
            class="btn-ghost mb-6 mt-4"
        />
    @else
        <div class="h-24"></div>
    @endif

    <form wire:submit="nextStep" class="min-h-128 mx-auto max-w-4xl flex flex-col items-center justify-between">

        {{-- Form header --}}
        <div class="text-center">Step {{ $step }}</div>

        {{-- Form body --}}
        <div>
            @if($step == 1)
                @if($courses->isNotEmpty())
                    <h2 class="text-2xl font-bold text-center">Which course would you like to offer?</h2>
                    <div x-data="{ selectedOption: '' }" class="mx-auto max-w-lg">
                        @foreach($courses as $course)
                            <div class="mt-8">
                                <label>
                                    <div
                                        class="cursor-pointer select-none border border-2 py-6 text-center"
                                        :class="selectedOption === '{{ $course->id }}' ? 'bg-white border-primary' : 'bg-white/50 hover:bg-white/20 hover:border-gray-300'"
                                    >
                                        <h4 class="font-semibold">{{ $course->title }}</h4>
                                        <p class="text-sm text-gray-500">
                                            {{ $course->subject->title }}
                                            &bull;
                                            {{ $course->level->title }}
                                        </p>
                                    </div>
                                    <input wire:model.live="courseId" type="radio" value="{{ $course->id }}" x-model="selectedOption" class="sr-only" />
                                </label>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="mt-12 flex flex-col items-center gap-8">
                        <p>Oops! Looks like you haven't created any courses yet.</p>
                        <x-button label="Create Your First Course" icon="o-plus" :link="route('tutor.courses.create')" />
                    </div>
                @endif
            @elseif($step == 2)
                <div class="space-y-12">
                    <x-input label="Class Size" type="number" wire:model="capacity" hint="How many students can enroll for this course?" inline />
                    <x-input label="Total Hours" type="number" wire:model="totalHours" hint="How many hours in total?" inline />
                    <x-input label="Price" type="number" wire:model="price" prefix="EUR" hint="Enter the total price each student pays for this course" inline />
                </div>
            @elseif($step == 3)
                <x-datetime label="Start date" wire:model="startDate" hint="When will the first lesson take place?" inline />
            @elseif($step == 4)
                step 4
                <p>Select options (tags)</p>
            @elseif($step == 5)
                step 5
            @elseif($step == 6)
                <div class="overflow-hidden bg-white shadow sm:rounded-lg">
                    <div class="px-4 py-6 sm:px-6">
                        <h3 class="text-base font-semibold leading-7 text-gray-900">Course Information</h3>
                        <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500">Lorem ipsum dolor sit amet consectetur sed do eiusmod.</p>
                    </div>
                    <div class="border-t border-gray-100">
                        <dl class="divide-y divide-gray-100">
                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-900">Title</dt>
                                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $course->title }}</dd>
                            </div>
                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-900">Description</dt>
                                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $course->description }}</dd>
                            </div>
                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-900">Subject</dt>
                                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $course->subject->title }}</dd>
                            </div>
                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-900">Level</dt>
                                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $course->level->title }}</dd>
                            </div>
                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-900">Max students</dt>
                                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $capacity }} students</dd>
                            </div>
                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-900">Total hours</dt>
                                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $totalHours }} hours</dd>
                            </div>
                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-900">Price</dt>
                                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">&euro; {{ $price }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>
            @endif
        </div>

        {{-- Form footer --}}
        <div class="w-full py-4">
            @if($step > 1)
                <div class="flex justify-between">
                    <div>
                        <x-button label="Cancel" class="btn-error" :link="route('tutor.courseOfferings.index')" />
                        @if($step > 2)
                            <button type="button" wire:click="previousStep" class="btn">Previous</button>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary">
                        @if($step === $totalSteps)
                            Finish
                        @else
                            Next
                        @endif
                    </button>
                </div>
            @endif
        </div>
    </form>
</div>
