@section('title', "{$tutor->user->full_name} | Private Lessons" )

@extends('layouts.app')

@section('content')
    <section id="profile-header" class="bg-gray-800">
        <div class="relative isolate flex flex-col justify-end overflow-hidden pb-8 pt-80 md:pt-20 md:pb-20">
            <div class="md:hidden">
                <img class="absolute inset-0 -z-10 h-full w-full object-cover" src="{{ $tutor->user->avatarUrl }}" alt="">
                <div class="absolute inset-0 -z-10 bg-gradient-to-t from-gray-900 via-gray-900/60"></div>
                <div class="absolute inset-0 -z-10 ring-1 ring-inset ring-gray-900/10"></div>
            </div>

            <div class="container grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="my-auto space-y-2">
                    <p class="text-gray-300 text-xl md:text-2xl lg:text-3xl xl:text-4xl italic">{{ $tutor->user->tagline }}</p>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-bold text-white">{{ $tutor->user->full_name }}</h1>
                    <div class="text-gray-500 text-lg">
                        @foreach($tutor->subjects as $subject)
                            {{ $subject->title }}
                            @if(!$loop->last)
                                &bull;
                            @endif
                        @endforeach
                        <span class="hidden md:inline-block">private lessons in {{ $tutor->user->locality->name }}</span>
                    </div>
                    <div class="flex flex-row items-center">
                        @for($i=0; $i<5; $i++)
                            <x-icon name="s-star" class="w-8 h-8 text-yellow-400" />
                        @endfor
                        <span class="text-base text-gray-200 ml-2">{{ $tutor->reviews_count }} reviews</span>
                    </div>
                    <x-icon name="s-map-pin" :label="$tutor->user->locality->name" class="w-8 h-8 text-2xl text-gray-200" />
                </div>
                <div class="hidden md:block">
                    <img class="mx-auto h-96 rounded-full" src="{{ $tutor->user->avatarUrl }}">
                </div>
            </div>
        </div>
    </section>
    <section id="profile-subnav" class="border-0 border-b">
        <div class="container md:flex md:justify-between">
            <nav class="text-gray-500 space-x-4 my-auto hidden md:block">
                <a href="#profile-bio" class="hover:text-gray-800">Profile</a>
                <a href="#profile-reviews" class="hover:text-gray-800">Reviews ({{ $tutor->reviews_count }})</a>
                <a href="#profile-faq" class="hover:text-gray-800">FAQ</a>
            </nav>
            <div class="flex flex-col justify-center md:flex-row gap-4 py-4">
                <x-button icon="o-heart" label="Save to favourites" class="btn-lg w-full md:w-auto" />
                <x-button icon="o-envelope" label="Contact {{ $tutor->user->title }} {{ $tutor->user->last_name }}" class="btn-lg btn-primary w-full md:w-auto" />
            </div>
        </div>
    </section>
    <section>
        <div class="container pt-16 grid grid-cols-1 lg:grid-cols-3 gap-12">
            <main class="lg:col-span-2">
                <div id="profile-bio" class="pb-16 border-0 border-b">
                    <h3 class="mb-6 text-3xl font-bold">About me</h3>
                    <div>{{ $tutor->user->bio }}</div>
                </div>
                <div id="profile-reviews" class="py-16 border-0 border-b">
                    <h3 class="mb-6 text-3xl font-bold">What my students say</h3>
                    <ul class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @forelse($tutor->reviews as $review)
                            <li class="card bg-white">
                                <div class="card-body">
                                    <div class="flex gap-2">
                                        <img class="rounded h-16" src="{{ $review->author->avatarUrl }}">
                                        <div>
                                            @for($i=0; $i<5; $i++)
                                                <x-icon name="s-star" class="w-4 h-4 {{ $review->rating > $i ? 'text-yellow-500' : 'text-gray-500' }}" />
                                            @endfor
                                            <p class="text-xs text-gray-500">{{ $review->created_at->format('j M Y') }}</p>
                                            <p class="text-sm font-semibold">{{ $review->author->full_name }}</p>
                                        </div>
                                    </div>
                                    <div class="text-sm">
                                        {{ $review->comment }}
                                    </div>
                                </div>
                            </li>
                        @empty
                            <div>
                                No reviews yet.
                            </div>
                        @endforelse
                    </ul>
                </div>
                <div id="profile-faq" class="py-16 border-0 border-b">
                    <h3 class="mb-6 text-3xl font-bold">FAQ</h3>
                </div>
            </main>
            <aside class="space-y-6 mb-12">
                <div class="card bg-white">
                    <div class="card-body flex flex-col items-center">
                        <h3 class="card-title">Choose a package</h3>
                    </div>
                </div>
                <div class="card bg-white">
                    <div class="card-body flex flex-col items-center">
                        <h3 class="card-title">Another card</h3>
                    </div>
                </div>
            </aside>
        </div>
    </section>
@endsection
