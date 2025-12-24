@extends('layouts.client')
@section('headers')

@endsection
@section('content')

<body class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-white font-display">
    <div class="flex  overflow-hidden h-screen ">
        <!-- Sidebar -->
        <aside class="hidden lg:flex w-72 flex-col bg-[#171217] border-r border-border-dark flex-shrink-0 h-full">
            <div class="p-6 pb-2">
                <div class="flex items-center gap-3 mb-8">
                    <div class="size-8 rounded-full bg-primary flex items-center justify-center text-white">
                        <span class="material-symbols-outlined">spa</span>
                    </div>
                    <h1 class="text-xl font-bold tracking-tight text-white">Wellness Hub</h1>
                </div>
                <!-- User Profile Snippet -->
                <div class="flex items-center gap-3 p-3 rounded-xl bg-surface-dark/50 border border-border-dark mb-6">
                    <div class="bg-center bg-no-repeat bg-cover rounded-full size-10 flex-shrink-0" data-alt="Portrait of Jane Doe looking calm" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCFRPxjB9p55RPQd3s83Fg8CZ3dm5wUBkA2t5-FOn0bWuhpKei9_s4mcR8LjEciED6ePcbOb_eaiuywCiafKIyL8RKqsjN27iT8RDkhkcfXwZgPihIimN3dFjl7QWiZThDim1vGB7U-AWCS4AFPxs1e-KmlDkOkMukmwZxhkzbRwCMqVMdjbw6uY_7kd213jeAqDLNwKP3IOs7b-uf1MDx4m23h5N2qP5SHeK1OWQwoRvmRoheJuyRS5hy7KFJ9PouKCe3hx6H0zh8");'></div>
                    <div class="flex flex-col min-w-0">
                        <h2 class="text-white text-sm font-medium leading-none truncate">Jane Doe</h2>
                        <p class="text-[#b5a1b4] text-xs font-normal mt-1">Premium Member</p>
                    </div>
                </div>
            </div>
            <!-- Navigation -->
            <nav class="flex-1 overflow-y-auto px-4 space-y-1">
                <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-white hover:bg-surface-dark group transition-colors" href="#">
                    <span class="material-symbols-outlined text-[#b5a1b4] group-hover:text-primary transition-colors">home</span>
                    <span class="text-sm font-medium">Home</span>
                </a>
                <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg bg-surface-dark text-white group transition-colors" href="#">
                    <span class="material-symbols-outlined text-primary fill">play_circle</span>
                    <span class="text-sm font-medium">Course Videos</span>
                </a>
                <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-white hover:bg-surface-dark group transition-colors" href="#">
                    <span class="material-symbols-outlined text-[#b5a1b4] group-hover:text-primary transition-colors">bookmark</span>
                    <span class="text-sm font-medium">My List</span>
                </a>
                <div class="pt-4 pb-2 px-3">
                    <p class="text-xs font-bold text-[#b5a1b4] uppercase tracking-wider">Categories</p>
                </div>
                @foreach($coursesCategories as $category)
                <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-white hover:bg-surface-dark group transition-colors" href="#">
                    <span class="material-symbols-outlined text-[#b5a1b4] group-hover:text-primary transition-colors">self_improvement</span>
                    <span class="text-sm font-medium">{{ $category->category_name }}</span>
                </a>
                @endforeach
            </nav>
            <div class="p-4 border-t border-border-dark">
                <button class="flex w-full items-center gap-3 px-3 py-2.5 rounded-lg text-[#b5a1b4] hover:text-white hover:bg-surface-dark transition-colors">
                    <span class="material-symbols-outlined">logout</span>
                    <span class="text-sm font-medium">Log Out</span>
                </button>
            </div>
        </aside>
        <!-- Main Content -->
        <main class="flex-1 flex flex-col min-w-0 bg-background-dark h-full relative">
            <!-- Header -->
            @include('layouts.include.dark_header')
            <!-- Scrollable Area -->
            <div class="flex-1 overflow-y-auto p-6 lg:p-10 space-y-10">
                <!-- Hero Section -->
                <section class="rounded-3xl relative overflow-hidden bg-surface-dark shadow-2xl">
                    <div class="absolute inset-0 bg-cover bg-center" data-alt="Calm person meditating near a lake at sunset" style="background-image: url('{{ asset($top_course->cover_image) }}');">
                    </div>
                    <!-- Gradient Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-r from-background-dark via-background-dark/80 to-transparent"></div>
                    <div class="relative z-10 p-8 md:p-12 flex flex-col justify-center min-h-[400px] max-w-3xl">
                        <div class="flex items-center gap-2 mb-4">
                            <span class="bg-primary/20 text-primary text-xs font-bold px-2 py-1 rounded uppercase tracking-wider">Top Recommended</span>
                            <span class="text-tertiary text-xs font-medium px-2 py-1 rounded border border-tertiary/20">Modules {{$top_course->no_of_lessons}}</span>
                        </div>
                        <h2 class="text-4xl md:text-5xl font-bold text-white leading-tight mb-4">{{$top_course->course_name}}</h2>
                        <p class="text-gray-300 text-lg mb-8 max-w-xl">{!!$top_course->course_description!!}</p>
                        <div class="flex flex-wrap items-center gap-4">
                            <button data-id="{{ $top_course->id }}" data-type="course" class="bg-primary hover:bg-primary/90 text-[#171217] px-8 py-3.5 rounded-xl font-bold flex items-center gap-2 transition-transform active:scale-95 shadow-lg shadow-primary/25">
                                <span class="material-symbols-outlined fill">shop</span>
                                Add to Cart
                            </button>
                            <button class="bg-surface-dark/80 backdrop-blur border border-white/10 hover:bg-white/10 text-white px-6 py-3.5 rounded-xl font-medium flex items-center gap-2 transition-colors">
                                <span class="material-symbols-outlined">add</span>
                                Add to wishlist
                            </button>
                        </div>
                        <!-- Progress Bar -->
                        <div class="mt-8 w-full max-w-md">
                            <div class="flex justify-between text-xs text-gray-400 mb-2 font-medium">
                                <span>0% Completed</span>
                                <span>{{$top_course->course_duration}}{{$top_course->duration_unit}}</span>
                            </div>
                            <div class="h-1.5 w-full bg-white/10 rounded-full overflow-hidden">
                                <div class="h-full bg-primary w-[2%] rounded-full"></div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Filter Chips -->
                <section>
                    <div class="flex flex-wrap items-center gap-3 overflow-x-auto pb-2 scrollbar-hide">
                        <button class="px-4 py-2 rounded-full bg-white text-background-dark font-medium text-sm border border-transparent shadow-sm">All</button>
                        @foreach($coursesCategories as $category)
                        <button class="px-4 py-2 rounded-full bg-surface-dark text-[#b5a1b4] hover:text-white hover:bg-surface-dark/80 font-medium text-sm border border-border-dark transition-colors">{{$category->category_name}}</button>
                        @endforeach
                    </div>
                </section>
                <!-- Main Grid: Recommended -->
                <section>
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-2xl font-bold text-white">Recommended for You</h3>
                        <a class="text-sm font-medium text-primary hover:text-primary/80" href="#">View All</a>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        <!-- Card 1 -->
                        @foreach($courses as $course)
<a href="{{ url('/course_details/' . $course->id) }}" class="group block">
    <div class="flex flex-col gap-3">
        <div class="relative aspect-video rounded-xl overflow-hidden bg-surface-dark shadow-lg">
            <div class="absolute inset-0 bg-cover bg-center transition-transform duration-500 group-hover:scale-105" 
                 style="background-image: url('{{ asset($course->cover_image) }}');">
            </div>
            
            <div class="absolute inset-0 bg-black/20 group-hover:bg-black/40 transition-colors"></div>
            
            <div class="absolute bottom-3 right-3 bg-black/70 backdrop-blur-sm text-white text-xs font-bold px-2 py-1 rounded">
                {{ $course->course_duration }} {{ $course->duration_unit }}
            </div>
            
            <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                <div class="bg-white/20 backdrop-blur-sm p-3 rounded-full border border-white/30 text-white">
                    <span class="material-symbols-outlined fill text-4xl">visibility</span>
                </div>
            </div>
        </div>

        <div class="flex gap-3 items-start">
            <div class="size-9 rounded-full bg-gray-600 bg-cover bg-center flex-shrink-0 border border-border-dark" 
                 style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuD4WyW-HBDkgCRGxTWBnUm539sV9Wcysi7lKk3p3-gf0oTPXq3iPoWMw2YleRumb3oUxNNMyc9e4cbxP36Ut-N0cZTGkfw-7Bvzl-HJRURXCs5nky561qFR8qF2wN86E2DLy7UB4sw-unVln0iidO5A5OmOUuzHrPKFEPo_PltjqEi2RRXyhpSIqb0FraIAIxtpxBYbYLXHKG8rHbOD6I0LzizJ9wJowMfdVjAkBd-pYfXTOBs-5GocCYuPjJM5RFAaUBgsNcD0UHI")'>
            </div>
            
            <div class="flex flex-col">
                <h4 class="text-white font-semibold leading-tight group-hover:text-primary transition-colors">
                    {{ $course->course_name }}
                </h4>
                <p class="text-[#b5a1b4] text-sm mt-1">
                    {{ $instructor->full_name }} • {{ $course->category_name }}
                </p>
            </div>
        </div>
    </div>
</a>
                        @endforeach
                    </div>
                </section>
                <!-- Section: Popular in Yoga -->
                <section>
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-2xl font-bold text-white">Popular in Yoga</h3>
                        <div class="flex gap-2">
                            <button class="p-1 rounded-full bg-surface-dark hover:bg-white/10 text-white transition-colors">
                                <span class="material-symbols-outlined">chevron_left</span>
                            </button>
                            <button class="p-1 rounded-full bg-surface-dark hover:bg-white/10 text-white transition-colors">
                                <span class="material-symbols-outlined">chevron_right</span>
                            </button>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        <!-- Card 5 -->
                        @foreach ($courses as $course)
<a href="{{ url('/course_details/' . $course->id) }}" class="group block">
    <div class="flex flex-col gap-3">
        <div class="relative aspect-video rounded-xl overflow-hidden bg-surface-dark shadow-lg">
            <div class="absolute inset-0 bg-cover bg-center transition-transform duration-500 group-hover:scale-105" 
                 style="background-image: url('{{ asset($course->cover_image) }}');">
            </div>
            
            <div class="absolute inset-0 bg-black/20 group-hover:bg-black/40 transition-colors"></div>
            
            <div class="absolute bottom-3 right-3 bg-black/70 backdrop-blur-sm text-white text-xs font-bold px-2 py-1 rounded">
                {{ $course->course_duration }} {{ $course->duration_unit }}
            </div>
            
            <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                <div class="bg-white/20 backdrop-blur-sm p-3 rounded-full border border-white/30 text-white">
                    <span class="material-symbols-outlined fill text-4xl">visibility</span>
                </div>
            </div>
        </div>

        <div class="flex gap-3 items-start">
            <div class="size-9 rounded-full bg-gray-600 bg-cover bg-center flex-shrink-0 border border-border-dark" 
                 style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuD4WyW-HBDkgCRGxTWBnUm539sV9Wcysi7lKk3p3-gf0oTPXq3iPoWMw2YleRumb3oUxNNMyc9e4cbxP36Ut-N0cZTGkfw-7Bvzl-HJRURXCs5nky561qFR8qF2wN86E2DLy7UB4sw-unVln0iidO5A5OmOUuzHrPKFEPo_PltjqEi2RRXyhpSIqb0FraIAIxtpxBYbYLXHKG8rHbOD6I0LzizJ9wJowMfdVjAkBd-pYfXTOBs-5GocCYuPjJM5RFAaUBgsNcD0UHI")'>
            </div>
            
            <div class="flex flex-col">
                <h4 class="text-white font-semibold leading-tight group-hover:text-primary transition-colors">
                    {{ $course->course_name }}
                </h4>
                <p class="text-[#b5a1b4] text-sm mt-1">
                    {{ $instructor->full_name }} • {{ $course->category_name }}
                </p>
            </div>
        </div>
    </div>
</a>
                        @endforeach


                    </div>
                </section>
                <!-- Footer -->
                @include('../layouts/include/footer')
            </div>
        </main>
    </div>

</body>
@endsection
@section('scripts')
@endsection