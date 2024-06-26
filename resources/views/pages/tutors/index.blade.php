@section('title', "$level->title $subject->title | Private Tutors in Malta & Gozo" )

@extends('layouts.app')

@section('content')

    <header class="bg-primary py-16 text-center">
        <h1>Private Lessons in Malta and Gozo</h1>
        <h1 class="text-4xl font-bold text-center">
            {{ $level->title }} &bull; {{ $subject->title }}
        </h1>
    </header>

    <main class="container py-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($tutors as $tutor)
            <a href="#">
                <div class="p-4 bg-gray-300 hover:bg-gray-200">
                    <h3>{{ $tutor->user->title }} {{ $tutor->user->full_name }}</h3>
                    <p>&euro; {{ $tutor->user->price_per_hour_individual }} / hour</p>
                    <p>{{ $tutor->user->locality->name }}</p>
                </div>
            </a>
        @endforeach
    </main>

@endsection