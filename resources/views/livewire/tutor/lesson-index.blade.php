@section('title', 'Lessons')

<div>
    <x-header title="Lessons" subtitle="This is where you (a tutor) can manage your lessons." separator />

    <x-table :headers="$headers" :rows="$lessons" :sort-by="$sortBy" with-pagination wire:model="expanded" expandable>
        @scope('cell_date', $lesson)
            <span class="font-mono">
                {{ $lesson->starts_at->format('D jS M') }}
            </span>
        @endscope

        @scope('cell_starts_at', $lesson)
            <span class="font-mono">
                {{ $lesson->starts_at->format('H:i') }}
            </span>
        @endscope

        @scope('cell_ends_at', $lesson)
            <span class="font-mono">
                {{ $lesson->ends_at->format('H:i') }}
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
</div>
