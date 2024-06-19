@section('title', 'Courses')

<div>
    <x-header title="Courses" subtitle="A course is a structured series of lessons. You can offer the same course many times." separator>
        <x-slot:middle class="!justify-end">
            <x-input icon="o-bolt" placeholder="Search..." />
        </x-slot:middle>
        <x-slot:actions>
            <x-button icon="o-funnel" />
            <x-button label="New course" icon="o-plus" class="btn-primary" :link="route('tutor.courses.create')" />
        </x-slot:actions>
    </x-header>

    @if($courses->isEmpty())
        <div>
            no courses
        </div>
    @else
        <x-table :headers="$headers" :rows="$courses" :sort-by="$sortBy" with-pagination striped>

            @scope('cell_total_hours', $course)
                <span>{{ $course->total_hours }}</span>
                <sub>hr</sub>
            @endscope

            @scope('cell_price', $course)
                &euro; {{ $course->price }}
            @endscope

            @scope('actions', $course)
                <x-button icon="o-plus" tooltip-left="Offer this course" class="btn-circle btn-sm btn-outline" />
            @endscope
        </x-table>
    @endif
</div>
