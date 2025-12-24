@extends('layouts.client')
@section('content')

<body class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-white font-display overflow-hidden h-screen flex">
    <aside class="hidden lg:flex w-72 flex-col bg-[#171217] border-r border-border-dark flex-shrink-0 h-full">
        <div class="p-6 pb-2">
            <div class="flex items-center gap-3 mb-8">
                <div class="size-8 rounded-full bg-primary flex items-center justify-center text-white">
                    <span class="material-symbols-outlined">spa</span>
                </div>
                <h1 class="text-xl font-bold tracking-tight text-white">Wellness Hub</h1>
            </div>
            <div class="flex items-center gap-3 p-3 rounded-xl bg-surface-dark/50 border border-border-dark mb-6">
                <div class="bg-center bg-no-repeat bg-cover rounded-full size-10 flex-shrink-0" data-alt="Portrait of Jane Doe looking calm" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCFRPxjB9p55RPQd3s83Fg8CZ3dm5wUBkA2t5-FOn0bWuhpKei9_s4mcR8LjEciED6ePcbOb_eaiuywCiafKIyL8RKqsjN27iT8RDkhkcfXwZgPihIimN3dFjl7QWiZThDim1vGB7U-AWCS4AFPxs1e-KmlDkOkMukmwZxhkzbRwCMqVMdjbw6uY_7kd213jeAqDLNwKP3IOs7b-uf1MDx4m23h5N2qP5SHeK1OWQwoRvmRoheJuyRS5hy7KFJ9PouKCe3hx6H0zh8");'></div>
                <div class="flex flex-col min-w-0">
                    <h2 class="text-white text-sm font-medium leading-none truncate">Jane Doe</h2>
                    <p class="text-[#b5a1b4] text-xs font-normal mt-1">Premium Member</p>
                </div>
            </div>
        </div>
        <nav class="flex-1 overflow-y-auto px-4 space-y-1">
            <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-white hover:bg-surface-dark group transition-colors" href="#">
                <span class="material-symbols-outlined text-[#b5a1b4] group-hover:text-primary transition-colors">home</span>
                <span class="text-sm font-medium">Home</span>
            </a>
            <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg bg-surface-dark text-white group transition-colors" href="#">
                <span class="material-symbols-outlined text-primary fill">play_circle</span>
                <span class="text-sm font-medium">Course Details</span>
            </a>
            <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-white hover:bg-surface-dark group transition-colors" href="#">
                <span class="material-symbols-outlined text-[#b5a1b4] group-hover:text-primary transition-colors">bookmark</span>
                <span class="text-sm font-medium">My List</span>
            </a>
        </nav>
        <div class="p-4 border-t border-border-dark">
            <button class="flex w-full items-center gap-3 px-3 py-2.5 rounded-lg text-[#b5a1b4] hover:text-white hover:bg-surface-dark transition-colors">
                <span class="material-symbols-outlined">logout</span>
                <span class="text-sm font-medium">Log Out</span>
            </button>
        </div>
    </aside>
    <main class="flex-1 flex flex-col min-w-0 bg-background-dark h-full relative">
        @include('../layouts/include/dark_header')
        <div class="flex-1 overflow-y-auto">
            <div class="p-6 lg:p-10 max-w-7xl mx-auto space-y-10">
                <section class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
                    <div class="lg:col-span-2 space-y-6">
                        <div class="relative rounded-2xl overflow-hidden bg-black aspect-video group">
                            <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ asset($course_details->cover_image) }}');"></div>
                            <div class="absolute inset-0 bg-black/40 flex items-center justify-center group-hover:bg-black/50 transition-colors cursor-pointer">
                                <!-- <div class="size-20 bg-white/20 backdrop-blur-md rounded-full flex items-center justify-center pl-1 border border-white/30 text-white shadow-2xl transition-transform hover:scale-110">
                                    <span class="material-symbols-outlined text-5xl fill">play_arrow</span>
                                </div> -->
                            </div>
                            <!-- <div class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black/90 to-transparent">
                                <div class="h-1 bg-white/30 rounded-full mb-4 cursor-pointer">
                                    <div class="h-full bg-primary w-1/3 rounded-full relative">
                                        <div class="absolute right-0 top-1/2 -translate-y-1/2 size-3 bg-white rounded-full shadow"></div>
                                    </div>
                                </div>

                            </div> -->
                        </div>
                        <div>
                            <div class="flex flex-wrap gap-3 mb-4">
                                <span class="bg-surface-dark border border-border-dark text-[#b5a1b4] px-3 py-1 rounded-full text-sm font-medium flex items-center gap-1">
                                    <span class="material-symbols-outlined text-base">schedule</span>
                                    Total duration: {{$course_details->course_duration}} {{$course_details->duration_unit}}
                                </span>
                                <span class="bg-surface-dark border border-border-dark text-[#b5a1b4] px-3 py-1 rounded-full text-sm font-medium flex items-center gap-1">
                                    <span class="material-symbols-outlined text-base">signal_cellular_alt</span>
                                    {{$course_details->category}}
                                </span>
                            </div>
                            <h1 class="text-3xl font-bold text-white mb-3">{{$course_details->course_name}}</h1>
                            <p class="text-gray-400 leading-relaxed text-lg">
                                {{$course_details->description}}
                            </p>
                            <div class="flex items-center gap-4 mt-6 pt-6 border-t border-border-dark">
                                <div class="size-12 rounded-full bg-gray-700 bg-cover bg-center border-2 border-primary" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuAcD-XmeqP62hhhZfoVbORzb8d-cTzulhbBHl2AuQhEnqWXixL_fUEkvw7SIbrzttZEXRG3z-xJJqf9F-4MwhJf4y6zzH9Lt-p_-cCJAsi1U-aHs4__657Ot6x7zd11CPNecZPIs6Fd0tnwc3bIXLs3jaB5R7MVSiLrbUyWecLESWOZTdmgwxRMdeJAmdTHCGxVrnt5eprDWu0uw7hNn46Y2VK4EGlds2GpsAjWkmVFthivrB1hUY1xq9Toz5uOVzAjzVFpzOCt-Go")'></div>
                                <div>
                                    <p class="text-white font-bold">{{$instructor->full_name}}</p>
                                    <p class="text-secondary text-sm">{{$instructor->job_title}}</p>
                                </div>
                                <a href="{{url('/')}}" class="ml-auto bg-surface-dark hover:bg-white/5 text-white border border-border-dark px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                                    View Profile
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="bg-surface-dark rounded-2xl p-6 border border-border-dark sticky top-24">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-white font-bold text-lg">Course Summary</h3>
                        </div>
                        <!-- <div class="h-2 w-full bg-background-dark rounded-full overflow-hidden mb-6">
                            <div class="h-full bg-primary w-[35%] rounded-full"></div>
                        </div> -->
                        <div class="space-y-4">
                            <div class="flex items-center gap-4 text-gray-300">
                                <div class="size-10 rounded-lg bg-background-dark flex items-center justify-center text-secondary">
                                    <span class="material-symbols-outlined">play_lesson</span>
                                </div>
                                <div>
                                    <p class="text-xs text-[#b5a1b4]">Lessons</p>
                                    <p class="font-bold">{{count($course_lessons)}}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4 text-gray-300">
                                <div class="size-10 rounded-lg bg-background-dark flex items-center justify-center text-primary">
                                    <span class="material-symbols-outlined">download</span>
                                </div>
                                <div>
                                    <p class="text-xs text-[#b5a1b4]">Resources</p>
                                    <p class="font-bold">{{$material_count}}</p>
                                </div>
                            </div>
                        </div>
                    <button data-id="{{ $course_details->id }}" data-type="course" class=" add-to-cart-btn w-full mt-8 bg-primary hover:bg-primary/90 text-[#171217] font-bold py-3 rounded-xl transition-colors">
                            Add to Cart
                        </button>
                    </div>
                </section>
                <section>
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-2xl font-bold text-white">Course Curriculum</h3>
                        <div class="flex gap-2">
                            <button class="text-sm text-[#b5a1b4] hover:text-white px-3 py-1.5 rounded bg-surface-dark hover:bg-surface-dark/80 transition-colors">Expand All</button>
                            <button class="text-sm text-[#b5a1b4] hover:text-white px-3 py-1.5 rounded bg-surface-dark hover:bg-surface-dark/80 transition-colors">Collapse All</button>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div class="border border-border-dark rounded-xl overflow-hidden bg-surface-dark/30">
                            <div class="bg-surface-dark p-4 flex items-center justify-between cursor-pointer">
                                <div class="flex items-center gap-3">
                                    <span class="bg-primary/20 text-primary size-6 flex items-center justify-center rounded text-xs font-bold">1</span>
                                    <h4 class="text-white font-semibold">Introduction to Breathwork</h4>
                                </div>
                                <div class="flex items-center gap-4 text-sm text-[#b5a1b4]">
                                    <span>3 Lessons • 45m</span>
                                    <span class="material-symbols-outlined">keyboard_arrow_up</span>
                                </div>
                            </div>
                            @foreach ($course_lessons as $lesson)

                            <div class="p-4 border-t border-border-dark bg-background-dark/50 hover:bg-background-dark transition-colors">
                                <div class="flex flex-col md:flex-row gap-6">
                                    <div class="relative w-full md:w-48 aspect-video rounded-lg overflow-hidden bg-surface-dark flex-shrink-0 group cursor-pointer">
                                        <div class="absolute inset-0 bg-cover bg-center opacity-60 group-hover:opacity-100 transition-opacity" style="background-image: url('{{ asset($course_details->cover_image) }}');"></div>
                                        <div class="absolute inset-0 flex items-center justify-center">
                                            <!-- <div class="bg-black/50 p-2 rounded-full backdrop-blur-sm">
                                                <span class="material-symbols-outlined text-white">play_arrow</span>
                                            </div> -->
                                        </div>
                                        <!-- <div class="absolute bottom-1 right-1 bg-black/80 text-[10px] text-white px-1.5 rounded">12:30</div> -->
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex justify-between items-start mb-2">
                                            <h5 class="text-white font-medium text-lg group-hover:text-primary transition-colors cursor-pointer">{{$lesson->lesson_number}} . {{$lesson->lesson_title}}</h5>
                                            <span class="text-secondary text-xs bg-secondary/10 px-2 py-1 rounded font-medium flex items-center gap-1">
                                                <span class="material-symbols-outlined text-sm">check_circle</span> Completed
                                            </span>
                                        </div>
                                        <p class="text-sm text-[#b5a1b4] mb-4 line-clamp-2">
                                            {{$lesson->description}}

                                    </p>
                                        <!-- <div class="flex items-center gap-3">
                                            <a class="inline-flex items-center gap-2 text-xs font-medium text-tertiary border border-tertiary/30 px-3 py-1.5 rounded hover:bg-tertiary/10 transition-colors" href="#">
                                                <span class="material-symbols-outlined text-sm">description</span>
                                                Download Slides (PPTX)
                                            </a>
                                            <button class="text-[#b5a1b4] hover:text-white p-1.5 rounded hover:bg-surface-dark transition-colors" title="Add Note">
                                                <span class="material-symbols-outlined text-sm">edit_note</span>
                                            </button>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div>
                </section>
                <section class="bg-surface-dark rounded-2xl p-8 border border-border-dark">
                    <h3 class="text-xl font-bold text-white mb-6">About the Instructor</h3>
                    <div class="flex flex-col md:flex-row gap-8 items-start">
                        <div class="w-full md:w-48 flex-shrink-0 text-center md:text-left">
                            <div class="size-32 rounded-full bg-gray-600 bg-cover bg-center border-4 border-background-dark mx-auto md:mx-0 shadow-xl" style="background-image: url('{{ asset($instructor->image) }}');"></div>
                            <div class="mt-4 flex justify-center md:justify-start gap-2">
                                <button class="size-8 rounded-full bg-background-dark flex items-center justify-center text-[#b5a1b4] hover:text-white hover:bg-primary transition-colors">
                                    <span class="material-symbols-outlined text-sm">mail</span>
                                </button>
                                <button class="size-8 rounded-full bg-background-dark flex items-center justify-center text-[#b5a1b4] hover:text-white hover:bg-primary transition-colors">
                                    <span class="material-symbols-outlined text-sm">language</span>
                                </button>
                            </div>
                        </div>
                        <div class="flex-1">
                            <h4 class="text-2xl font-bold text-white">{{$instructor->full_name}}</h4>
                            <p class="text-secondary font-medium mb-4">{{$instructor->job_title}}</p>
                            <div class="space-y-4 text-gray-300 text-sm leading-relaxed">
                                <p>
                                    {!!$instructor->about_me!!}
                                </p>
                            </div>
                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mt-8 pt-6 border-t border-border-dark">
                                <div>
                                    <p class="text-2xl font-bold text-white">{{$all_courses_count}}</p>
                                    <p class="text-xs text-[#b5a1b4] uppercase tracking-wide">Courses</p>
                                </div>
                                <div>
                                    <p class="text-2xl font-bold text-white">4.9</p>
                                    <p class="text-xs text-[#b5a1b4] uppercase tracking-wide">Rating</p>
                                </div>
                                <div>
                                    <p class="text-2xl font-bold text-white">15k+</p>
                                    <p class="text-xs text-[#b5a1b4] uppercase tracking-wide">Students</p>
                                </div>
                                <div>
                                    <p class="text-2xl font-bold text-white">150+</p>
                                    <p class="text-xs text-[#b5a1b4] uppercase tracking-wide">Reviews</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </main>

</body>
@endsection
@section('scripts')
@endsection