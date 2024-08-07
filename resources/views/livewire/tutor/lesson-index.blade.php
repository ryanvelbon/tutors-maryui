@section('title', 'Lessons')

<div>
    <x-header title="Lessons" subtitle="This is where you (a tutor) can manage your lessons." separator />

    @if($lessons->isEmpty())
        <div class="pt-48 flex flex-col items-center gap-6">
            <h3 class="text-xl font-bold">No lessons</h3>
            <p>Your lessons will appear here.</p>
            <x-button label="Schedule a Lesson" />
        </div>
    @else
        <x-table :headers="$headers" :rows="$lessons" :sort-by="$sortBy" with-pagination wire:model="expanded" expandable>
            @scope('cell_starts_at', $lesson)
                <span class="font-mono">
                    {{ $lesson->starts_at->format('D jS M') }}
                </span>
            @endscope

            @scope('cell_start_time', $lesson)
                <span class="font-mono">
                    {{ $lesson->starts_at->format('H:i') }}
                </span>
            @endscope

            @scope('cell_end_time', $lesson)
                <span class="font-mono">
                    {{ $lesson->ends_at->format('H:i') }}
                </span>
            @endscope

            @scope('cell_status', $lesson)
                <span class="bg-{{ $lesson->status->getColor() }} px-2 py-1 text-white rounded-full text-xs">
                    {{ $lesson->status }}
                </span>
            @endscope

            @scope('actions', $lesson)
                <x-button icon="o-pencil-square" spinner class="btn-sm" />
            @endscope

            @scope('expansion', $lesson)
                <div class="bg-base-200 p-8">
                    {{ $lesson->description }}
                </div>
            @endscope
        </x-table>
    @endif
</div>
