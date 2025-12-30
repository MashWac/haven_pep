@extends('layouts.client')
@section('headers')

@endsection
@section('content')

<body class="bg-background-light dark:bg-background-dark font-display text-neutral-900 dark:text-gray-100 min-h-screen flex flex-col">
    <!-- Top Navigation -->
    @include('../layouts/include/dark_header')

    <main class="flex-grow w-full max-w-[1280px] mx-auto px-4 md:px-8 py-8 md:py-12">
        <!-- Hero Section -->
        <section class="grid grid-cols-1 lg:grid-cols-12 gap-8 mb-16">
            <!-- Profile Image -->
            <div class="lg:col-span-5 flex justify-center lg:justify-start">
                <div class="relative w-full max-w-[500px] aspect-[4/5] rounded-2xl overflow-hidden shadow-2xl ring-1 ring-white/10">
                    <div class="absolute inset-0 bg-gradient-to-t from-background-dark via-transparent to-transparent opacity-80 z-10"></div>
                    <div class="w-full h-full bg-cover bg-center" data-alt="Portrait of Sarah Jenkins yoga instructor" style="background-image: url('{{ asset($instructor->image) }}');"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-6 z-20">
                        <div class="flex gap-2 mb-4">
                            <span class="bg-secondary/20 text-secondary border border-secondary/30 text-xs font-bold px-3 py-1 rounded-full backdrop-blur-sm">Top Rated</span>
                            <span class="bg-primary/20 text-primary border border-primary/30 text-xs font-bold px-3 py-1 rounded-full backdrop-blur-sm">Verified</span>
                        </div>
                        <h1 class="text-4xl md:text-5xl font-bold text-white mb-2 leading-tight">{{ $instructor->full_name }}</h1>
                        <p class="text-gray-300 text-lg mb-6">{{ $instructor->job_title }}</p>
                        <div class="flex gap-3">
                            <button class="flex-1 bg-primary hover:bg-primary/90 text-background-dark font-bold py-3 px-6 rounded-lg transition-transform active:scale-95 flex items-center justify-center gap-2">
                                <span class="material-symbols-outlined text-[20px]">calendar_month</span>
                                Book Session
                            </button>
                            <button class="bg-surface-dark hover:bg-white/10 text-white font-bold py-3 px-4 rounded-lg border border-white/10 transition-colors flex items-center justify-center">
                                <span class="material-symbols-outlined text-[20px]">person_add</span>
                            </button>
                            <button class="bg-surface-dark hover:bg-white/10 text-white font-bold py-3 px-4 rounded-lg border border-white/10 transition-colors flex items-center justify-center">
                                <span class="material-symbols-outlined text-[20px]">share</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Bio & Stats -->
            <div class="lg:col-span-7 flex flex-col justify-center space-y-8">
                <!-- Stats Grid -->
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                    <div class="bg-white dark:bg-surface-dark p-4 rounded-xl border border-neutral-200 dark:border-white/5 flex flex-col items-center text-center">
                        <span class="text-primary material-symbols-outlined text-3xl mb-2">groups</span>
                        <p class="text-2xl font-bold dark:text-white">5k+</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 font-medium uppercase tracking-wider">Students</p>
                    </div>
                    <div class="bg-white dark:bg-surface-dark p-4 rounded-xl border border-neutral-200 dark:border-white/5 flex flex-col items-center text-center">
                        <span class="text-secondary material-symbols-outlined text-3xl mb-2">school</span>
                        <p class="text-2xl font-bold dark:text-white">12</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 font-medium uppercase tracking-wider">Courses</p>
                    </div>
                    <div class="bg-white dark:bg-surface-dark p-4 rounded-xl border border-neutral-200 dark:border-white/5 flex flex-col items-center text-center">
                        <span class="text-tertiary material-symbols-outlined text-3xl mb-2">star</span>
                        <p class="text-2xl font-bold dark:text-white">4.9</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 font-medium uppercase tracking-wider">Rating</p>
                    </div>
                    <div class="bg-white dark:bg-surface-dark p-4 rounded-xl border border-neutral-200 dark:border-white/5 flex flex-col items-center text-center">
                        <span class="text-primary material-symbols-outlined text-3xl mb-2">schedule</span>
                        <p class="text-2xl font-bold dark:text-white">8y</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 font-medium uppercase tracking-wider">Experience</p>
                    </div>
                </div>
                <!-- About Me -->
                <div class="bg-white dark:bg-surface-dark rounded-xl p-6 md:p-8 border border-neutral-200 dark:border-white/5">
                    <h3 class="text-xl font-bold mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-secondary">face</span>
                        About Me
                    </h3>
                    <p class="text-neutral-600 dark:text-gray-300 leading-relaxed text-base font-light">
                        {!!$instructor->about_me!!}
                    </p>
                    <div class="mt-6 flex flex-wrap gap-3">
                        <span class="px-3 py-1 rounded-full text-xs font-medium bg-neutral-100 dark:bg-white/5 text-neutral-600 dark:text-gray-300 border border-neutral-200 dark:border-white/10">Biblical Money Coaching</span>
                        <span class="px-3 py-1 rounded-full text-xs font-medium bg-neutral-100 dark:bg-white/5 text-neutral-600 dark:text-gray-300 border border-neutral-200 dark:border-white/10">Books</span>
                        <span class="px-3 py-1 rounded-full text-xs font-medium bg-neutral-100 dark:bg-white/5 text-neutral-600 dark:text-gray-300 border border-neutral-200 dark:border-white/10">Church Structures</span>
                    </div>
                </div>
            </div>
        </section>
        <!-- Main Content Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Left Column: Certifications & Contact -->
            <div class="lg:col-span-4 space-y-8">
                <!-- Certifications -->
                <div class="bg-white dark:bg-surface-dark rounded-xl p-6 border border-neutral-200 dark:border-white/5">
                    <h3 class="text-lg font-bold mb-6 flex items-center justify-between">
                        <span>Credentials</span>
                        <span class="material-symbols-outlined text-neutral-400">verified</span>
                    </h3>
                    <div class="space-y-6">
                        @foreach($achievements as $achievement)
                        <div class="flex gap-4">
                            <div class="size-10 rounded-full bg-primary/10 flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined text-primary text-xl">{{$achievement->icon}}</span>
                            </div>
                            <div>
                                <h4 class="font-bold text-sm">{{$achievement->achievement}}</h4>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <!-- Connect / Social -->
                <div class="bg-gradient-to-br from-primary/20 to-secondary/20 rounded-xl p-6 border border-white/5">
                    <h3 class="text-lg font-bold mb-4">Let's Connect</h3>
                    <p class="text-sm text-gray-400 mb-6">Follow my daily journey and quick tips on social media.</p>
                    <div class="flex gap-4">
                        <a class="size-10 rounded-full bg-background-dark flex items-center justify-center hover:text-primary transition-colors" href="{{ $instructor->instagram_url }}">
                            <!-- Instagram-ish icon using material symbol for generic -->
                            <span class="material-symbols-outlined">photo_camera</span>
                        </a>
                        <a class="size-10 rounded-full bg-background-dark flex items-center justify-center hover:text-secondary transition-colors" href="{{ $instructor->facebook_url }}">
                            <span class="material-symbols-outlined">smart_display</span>
                        </a>
                        <a class="size-10 rounded-full bg-background-dark flex items-center justify-center hover:text-tertiary transition-colors" href="{{ $instructor->email_address }}">
                            <span class="material-symbols-outlined">alternate_email</span>
                        </a>
                    </div>
                </div>
            </div>
            <!-- Right Column: Courses & Testimonials -->
            <div class="lg:col-span-8 space-y-12">
                <!-- Active Courses -->
                <section>
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-2xl font-bold">Featured Courses</h3>
                        <a class="text-sm font-medium text-primary hover:text-primary/80 flex items-center gap-1" href="#">
                            View all <span class="material-symbols-outlined text-sm">arrow_forward</span>
                        </a>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Course Card 1 -->
                        @foreach($courses as $course)
                        <div class="group bg-white dark:bg-surface-dark rounded-xl overflow-hidden border border-neutral-200 dark:border-white/5 hover:border-primary/50 transition-colors">
                            <div class="aspect-video w-full bg-cover bg-center relative group-hover:scale-105 transition-transform duration-500" data-alt="{{ $course->course_name}}" style="background-image: url('{{ asset($course->cover_image) }}');">
                                <div class="absolute inset-0 bg-black/40 group-hover:bg-black/20 transition-colors"></div>
                                <span class="absolute top-3 left-3 bg-white/10 backdrop-blur-md text-white text-xs font-bold px-2 py-1 rounded">Beginner</span>
                            </div>
                            <div class="p-5 relative bg-white dark:bg-surface-dark">
                                <h4 class="font-bold text-lg mb-2 group-hover:text-primary transition-colors">{{ $course->course_name}}</h4>
                                <div class="flex items-center gap-4 text-xs text-gray-500 dark:text-gray-400 mb-4">
                                    <div class="flex items-center gap-1">
                                        <span class="material-symbols-outlined text-base">schedule</span> {{ $course->course_duration}} {{ $course->duration_unit}}
                                    </div>
                                    <div class="flex items-center gap-1">
                                        <span class="material-symbols-outlined text-base">star</span> 4.9 (1.2k)
                                    </div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-xl font-bold text-neutral-900 dark:text-white">@if($course->pricing > 0)KSH {{ $course->pricing}}@else Free @endif</span>
                                    <a href="{{url('/course_details/'.$course->id)}}" class="text-sm font-bold bg-neutral-100 dark:bg-white/10 hover:bg-primary hover:text-background-dark text-neutral-900 dark:text-white px-4 py-2 rounded-lg transition-colors">
                                        Preview
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </section>
                <!-- Books -->
                <section>
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-2xl font-bold">Featured Books</h3>
                        <a class="text-sm font-medium text-primary hover:text-primary/80 flex items-center gap-1" href="#">
                            View all <span class="material-symbols-outlined text-sm">arrow_forward</span>
                        </a>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Course Card 1 -->
                        @foreach($books as $book)
                        <div class="group relative flex flex-col gap-4">
                            <div class="relative aspect-[2/3] w-full overflow-hidden rounded-xl bg-gray-200 dark:bg-gray-800 shadow-lg group-hover:shadow-xl group-hover:shadow-primary/20 transition-all duration-300 group-hover:-translate-y-1">
                                <img alt="{{$book->title}}" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110" src="{{$book->image}}" />

                                <div class="absolute top-3 right-3">
                                    <span class="inline-flex items-center justify-center rounded-full bg-black/60 backdrop-blur-md px-2.5 py-1 text-[11px] font-bold text-white shadow-sm border border-white/10">
                                        <span class="material-symbols-outlined text-[14px] mr-1 text-yellow-400 fill-current">star</span> 4.9
                                    </span>
                                </div>

                                <div class="absolute inset-0 bg-black/70 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col items-center justify-center gap-3 p-6 text-center">
                                    <button class="add-to-cart-btn w-full bg-primary hover:bg-[#c95cc6] text-white py-2.5 rounded-lg font-bold text-sm shadow-lg transform translate-y-4 group-hover:translate-y-0 transition-all duration-300 flex items-center justify-center gap-2"
                                        data-id="{{ $book->id }}"
                                        data-type="book">
                                        <span class="material-symbols-outlined text-sm">shopping_cart</span>
                                        Add to Cart
                                    </button>

                                    <a href="{{url('/book_summary/'.$book->id)}}"
                                        class="w-full bg-white/10 backdrop-blur-md text-white border border-white/20 py-2.5 rounded-lg font-bold text-sm hover:bg-white/20 transition-all transform translate-y-4 group-hover:translate-y-0 transition-all duration-300 delay-75 flex items-center justify-center gap-2">
                                        <span class="material-symbols-outlined text-sm">visibility</span>
                                        Quick View
                                    </a>
                                </div>
                            </div>

                            <div class="px-1">
                                <h3 class="text-base font-bold text-gray-900 dark:text-white truncate group-hover:text-primary transition-colors">{{$book->title}}</h3>
                                <p class="text-sm text-gray-500 dark:text-[#b5a1b4]">{{$book->author}}</p>

                                <div class="mt-3 flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <span class="text-sm font-black text-primary">
                                            @if($book->price > 0) KSH {{ number_format($book->price) }} @else Free @endif
                                        </span>
                                        @if($book->discount)
                                        <span class="text-xs text-gray-400 line-through">KSH {{ number_format($book->price + $book->discount) }}</span>
                                        @endif
                                    </div>

                                    <span class="inline-flex items-center gap-1 text-[10px] font-bold uppercase tracking-wider text-[#b5a1b4]">
                                        <span class="material-symbols-outlined text-[14px]">headphones</span>
                                        Audio
                                    </span>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </section>
            </div>
        </div>
    </main>
    <!-- Footer -->
    @include('../layouts/include/footer')
</body>

@endsection
@section('scripts')
@endsection