<div class="grid grid-cols-1 md:grid-cols-4 gap-2">
    <x-select label="I want to learn" :options="$subjectOptions" option-label="title" wire:model.live="subjectId" inline />

    <x-select label="Level" :options="$levelOptions" option-label="title" inline />

    <x-select label="Locality" :options="$localityOptions" inline />
    {{-- make this a dropdown where user can select multiple localities --}}
</div>