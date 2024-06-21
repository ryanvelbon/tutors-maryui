@section('title', 'Tutor Dashboard')

<div>
    <x-header title="Dashboard" subtitle="This is the Tutor Dashboard" separator />

    <x-header title="This week" />

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <div class="bg-white shadow p-4 col-span-2">
            <div class="flex justify-between items-start mb-2">
                <h2 class="text-2xl font-bold">Lessons</h2>
                <a href="{{ route('tutor.lessons.index') }}" wire:navigate class="text-xs underline">see all lessons</a>
            </div>
            @forelse($lessonsThisWeek as $lesson)
                <div class="bg-white p-4 space-y-8 border-2 mb-2">
                    <div class="flex justify-between text-xs">
                        <div>
                            {{ $lesson->starts_at->format('D jS M') }}
                            {{ $lesson->starts_at->format('H:i') }}
                            -
                            {{ $lesson->ends_at->format('H:i') }}
                        </div>
                        <div>{{ $lesson->status }}</div>
                    </div>
                    <div class="flex justify-between text-xs">
                        <p>{{ $lesson->title }}</p>
                        <div>{{ $lesson->subject->title }} {{ $lesson->courseOffering->level->code }}</div>
                    </div>
                </div>
            @empty
                <div>
                    No lessons scheduled for this week.
                </div>
            @endforelse
        </div>
    </div>
</div>
