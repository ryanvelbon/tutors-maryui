@section('title', 'Tutor Dashboard')

<div>
    <x-header title="Dashboard" subtitle="This is the Tutor Dashboard" separator />

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <x-card title="Lessons" class="col-span-2" shadow>
            <x-slot:menu>
                <x-button icon="o-plus" tooltip="Schedule a new lesson" class="btn-circle btn-sm" />
            </x-slot:menu>

            @if($lessonsThisWeek->isEmpty())
                <div class="py-16 text-center">
                    No lessons scheduled for this week.
                </div>
            @else
                <table class="table">
                    <tbody>
                        @foreach($lessonsThisWeek as $lesson)
                            <tr class="hover:bg-base-200/50 ">
                                <td>
                                    {{ $lesson->starts_at->format('D jS M') }}
                                </td>
                                <td>
                                    {{ $lesson->starts_at->format('H:i') }} - {{ $lesson->ends_at->format('H:i') }}
                                </td>
                                <td>
                                    {{ $lesson->subject->title }} {{ $lesson->courseOffering->level->code }}
                                </td>
                                <td>
                                    <span class="bg-{{ $lesson->status->getColor() }} px-2 py-1 text-white rounded-full text-xs">
                                        {{ $lesson->status }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
            <x-slot:actions>
                <x-button label="See all lessons" :link="route('tutor.lessons.index')" class="btn-sm mx-auto" />
            </x-slot:actions>
        </x-card>

        <x-card title="News" shadow>
        </x-card>
    </div>
</div>
