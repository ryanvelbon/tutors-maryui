<div class="container py-16">
    <div class="mb-16 lg:mb-20">
        <h1 class="mb-8 text-4xl font-bold text-center">Courses</h1>
        <p class="mt-2 text-lg leading-8 text-gray-600 text-center">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
    </div>

    <div class="flex flex-row gap-8">

        <aside class="bg-blue-200 w-96 hidden lg:block">
            filters
        </aside>

        <main class="grow">
            @if($courses->isEmpty())
                <div>
                    No records match your search.
                </div>
            @else
                <div class="space-y-16 mx-auto max-w-3xl">
                    @foreach($courses as $course)
                        <article class="relative isolate flex flex-col md:flex-row bg-white">
                            <div class="relative aspect-[16/9] sm:aspect-[2/1] md:aspect-square md:w-64 md:shrink-0">
                                <img src="https://placehold.co/600x400" alt="" class="absolute inset-0 h-full w-full bg-gray-50 object-cover">
                            </div>
                            <div class="p-4 space-y-4">

                                <div class="flex justify-between">
                                    <div class="relative flex items-center gap-x-4">
                                        <img src="/assets/img/user.jpg" alt="" class="h-12 w-12 rounded-full bg-gray-50">
                                        <div class="text-sm leading-6">
                                            <p class="font-semibold text-gray-900">
                                                <span class="absolute inset-0"></span>
                                                {{ $course->tutor->user->title }}
                                                {{ $course->tutor->user->full_name }}
                                            </p>
                                            <p class="text-gray-600">Math Teacher at St. Thomas</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <div class="font-bold">&euro; {{ $course->price }}</div>
                                        <div class="text-gray-500 text-xs">&euro; {{ $course->hourly_rate }} per hour</div>
                                    </div>
                                </div>

                                <div>
                                    <h3 class="text-lg font-semibold leading-6 text-gray-900">
                                        {{ $course->title }}
                                    </h3>
                                    <p class="mt-1 text-sm leading-5 text-gray-600">{{ $course->description }}</p>
                                </div>

                                <div>
                                    <div class="inline-flex items-center gap-1">
                                        <x-icon name="s-star" class="text-black" />
                                        <span class="text-black font-bold">4.8</span>
                                        <span class="text-gray-500 text-xs">(72 reviews)</span>
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        <span>{{ $course->total_hours }} hours</span>
                                        &bull;
                                        <span>8 students</span>
                                        &bull;
                                        <span>Online Lessons</span>
                                    </div>
                                </div>

                                <div>
                                    <x-badge value="{{ $course->subject->title }}" class="badge-primary" />
                                    <x-badge value="{{ $course->level->title }}" class="badge-neutral" />
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif

            @if(!$courses->isEmpty())
                <div class="mt-8">
                    {{ $courses->links() }}
                </div>
            @endif
        </main>
    </div>
</div>
