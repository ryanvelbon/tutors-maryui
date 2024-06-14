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
        <p class="text-center text-4xl font-bold text-base-content">What do you need help with?</p>
        <ul class="flex gap-3 overflow-x-auto py-8 mx-auto max-w-2xl">
            @foreach($subjects as $subject)
                <a href="#">
                    <li class="w-48 h-48 shrink-0 bg-white hover:bg-black hover:text-white transition duration-500 ease-in-out flex flex-col gap-4 items-center justify-center select-none">
                        <x-icon name="o-academic-cap" class="w-12 h-12" />
                        <h3 class="font-bold">{{ $subject->title }}</h3>
                    </li>
                </a>
            @endforeach
        </ul>
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
