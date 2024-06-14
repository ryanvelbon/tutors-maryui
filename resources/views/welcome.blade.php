@extends('layouts.app')

@section('content')

<section class="bg-white">
    <div class="py-48">
        <div class="flex flex-col text-center space-y-6 mx-auto max-w-4xl">
            <p class="text-xl text-base-content font-semibold">Nervous about your exams?</p>
            <p class="text-6xl text-base-content font-bold">Unlock your learning potential</p>
            <p class="text-xl text-base-content">Find qualified SEC & MATSEC tutors in Malta & Gozo to help you achieve the grades you deserve.</p>
            <div>
                <x-button label="Find a Tutor" :link="route('tutors.index')" class="btn-secondary btn-lg" />
            </div>
        </div>
    </div>
</section>
<section class="bg-base-100">
    <div class="container py-16">
        <h2>How it works</h2>
    </div>
</section>
<section class="bg-base-200">
    <div class="container py-16">
        <h2>Pick a Subject</h2>
    </div>
</section>
<section class="bg-base-100">
    <div class="container py-16">
        <h2>Featured Private Tutors</h2>
    </div>
</section>
<section class="bg-accent">
    <div class="container py-24 space-y-8 flex flex-col items-center">
        <p class="text-4xl font-bold">Find your perfect tutor today!</p>
        <x-button label="Browse Tutors" :link="route('tutors.index')" class="btn-neutral btn-lg" />
    </div>
</section>
@endsection
