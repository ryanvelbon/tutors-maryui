<div>
    <x-header title="Cohorts" separator>
        <x-slot:middle class="!justify-end">
            <x-input icon="o-bolt" placeholder="Search..." />
        </x-slot:middle>
        <x-slot:actions>
            <x-button icon="o-funnel" />
            <x-button label="Offer a course" icon="o-plus" class="btn-primary" :link="route('tutor.courseOfferings.create')" />
        </x-slot:actions>
    </x-header>

    @if($offerings->isEmpty())
        <div class="mt-12 flex flex-col items-center gap-8">
            <p>No course offerings found.</p>
            <x-button label="Offer a course" icon="o-plus" :link="route('tutor.courseOfferings.create')" />
        </div>
    @else
        <x-table :headers="$headers" :rows="$offerings" :sort-by="$sortBy" with-pagination striped wire:model="expanded" expandable>
            @scope('cell_start_date', $offering)
                <span class="font-mono">
                    {{ $offering->start_date->format('Y M d') }}
                </span>
            @endscope

            @scope('cell_total_hours', $offering)
                <span>{{ $offering->total_hours }}</span>
                <sub>hr</sub>
            @endscope

            @scope('cell_price', $offering)
                &euro; {{ $offering->price }}
            @endscope

            @scope('actions', $offering)
                <x-button icon="o-calendar-days" class="btn-sm" />
            @endscope

            @scope('expansion', $offering)
                <div class="bg-base-200 p-8">
                    <p>more info</p>
                </div>
            @endscope
        </x-table>
    @endif
</div>
