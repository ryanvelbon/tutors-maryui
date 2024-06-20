<div>
    <x-header title="Cohorts" subtitle="A cohort represents a specific instance of a course being offered at a particular time to a group of students." separator>
        <x-slot:actions>
            <x-button label="Offer a course" icon="o-plus" class="btn-primary" :link="route('tutor.courseOfferings.create')" />
        </x-slot:actions>
    </x-header>
</div>
