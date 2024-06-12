<div>
    <h2 class="text-2xl font-gray-800 font-bold">Search tutors</h2>

    @php
    $headers = [
        ['key' => 'id', 'label' => '#'],
        ['key' => 'full_name', 'label' => 'Name']
    ];
    @endphp

    <x-table :headers="$headers" :rows="$tutors" />
</div>
