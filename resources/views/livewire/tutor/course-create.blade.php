@section('title', 'Create a new course')

<div class="container py-16 mx-auto max-w-4xl">

    <x-button
        label="Go back"
        icon="o-chevron-left"
        :link="route('tutor.courses.index')"
        class="btn-ghost mb-6"
    />

    <x-header
        title="Create a new course"
        subtitle="What you are creating here is essentially a template. You can offer a course many times."
        separator
    />

    <x-form wire:submit="save">

        <div class="lg:grid grid-cols-5 gap-8">
            <div class="col-span-2">
                <x-header
                    title="Title"
                    subtitle="Try to include keywords that students would likely use when searching for a course like yours."
                    size="text-2xl"
                />
            </div>
            <div class="col-span-3 grid gap-3">
                <x-input
                    label="Title"
                    wire:model="title"
                    inline
                />
            </div>
        </div>

        <div class="lg:grid grid-cols-5 gap-8">
            <div class="col-span-2">
                <x-header
                    title="Description"
                    subtitle="Write a few words explaining what the course is about and who it is for."
                    size="text-2xl"
                />
            </div>
            <div class="col-span-3 grid gap-3">
                <x-textarea
                    label="Description"
                    wire:model="description"
                    rows="3"
                    inline
                />
            </div>
        </div>

        <div class="lg:grid grid-cols-5 gap-8">
            <div class="col-span-2">
                <x-header
                    title="Subject"
                    subtitle="Each course should target a specific level."
                    size="text-2xl"
                />
            </div>
            <div class="col-span-3 grid gap-3">
                <x-select
                    label="Subject"
                    :options="$subjects"
                    wire:model="subject_id"
                    option-label="title"
                    placeholder="---"
                    inline
                />

                <x-select
                    label="Level"
                    :options="$levels"
                    wire:model="level_id"
                    option-label="title"
                    placeholder="---"
                    inline
                />
            </div>
        </div>

        <hr class="my-5" />

        <div class="lg:grid grid-cols-5 gap-8">
            <div class="col-span-2">
                <x-header
                    title="Pricing"
                    subtitle="What is the price for this course? And how many hours of tuition in total?"
                    size="text-2xl"
                />
            </div>
            <div class="col-span-3 grid gap-3">
                <x-input
                    label="Hours"
                    type="number"
                    wire:model.blur="total_hours"
                    hint="The total duration (in hours) of the course."
                    inline
                />

                <x-input
                    label="Price"
                    type="number"
                    wire:model.blur="price"
                    step="5"
                    prefix="EUR"
                    inline
                />
            </div>
        </div>

        <x-slot:actions>
            <x-button
                label="Cancel"
                :link="route('tutor.courses.index')"
                class="btn-ghost"
            />

            <x-button
                label="Save"
                type="submit"
                spinner="save"
                class="btn-primary"
            />
        </x-slot:actions>
    </x-form>
</div>
