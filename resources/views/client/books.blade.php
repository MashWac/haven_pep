@extends('layouts.client')
@section('headers')

@endsection
@section('content')
<body class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-tertiary transition-colors duration-200 overflow-x-hidden">
    <!-- Top Navigation -->
     @include('../layouts/include/dark_header')

    <div class="flex flex-col min-h-screen">
                <!-- Main Content Wrapper -->
        <main class="flex-1 w-full max-w-[1280px] mx-auto px-4 md:px-10 pb-24 pt-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
                <!-- Left Column (Content) -->
                <div class="lg:col-span-8 flex flex-col gap-8">
                    <!-- Hero / Book Header -->
                    <div class="flex flex-col sm:flex-row gap-8 items-start">
                        <div class="w-full sm:w-48 shrink-0 aspect-[2/3] rounded-lg shadow-xl overflow-hidden relative group">
                            <div class="absolute inset-0 bg-cover bg-center" data-alt="Book cover of Atomic Habits with abstract geometric shapes" style="background-image: url('{{ asset($book_details->image) }}');"></div>
                            <!-- Fallback/Overlay for visual interest -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex items-end p-3 opacity-0 group-hover:opacity-100 transition-opacity">
                                <button class="size-8 bg-white/20 backdrop-blur rounded-full flex items-center justify-center text-white ml-auto hover:bg-white/40">
                                    <span class="material-symbols-outlined text-sm">open_in_full</span>
                                </button>
                            </div>
                        </div>
                        <div class="flex flex-col gap-4 flex-1">
                            <div>
                                <div class="flex items-center gap-3 mb-2">
                                    <span class="px-3 py-1 rounded-full bg-secondary/20 text-secondary text-xs font-bold uppercase tracking-wider">{{ $book_details->category }}</span>
                                    <div class="flex items-center gap-1 text-yellow-400">
                                        <span class="material-symbols-outlined text-sm fill-current">star</span>
                                        <span class="text-sm font-medium dark:text-white text-gray-900">4.8</span>
                                        <span class="text-xs text-gray-500 dark:text-[#b5a1b4]">(12k ratings)</span>
                                    </div>
                                </div>
                                <h1 class="text-4xl md:text-5xl font-black text-gray-900 dark:text-white tracking-tight mb-2">{{ $book_details->title }}</h1>
                                <h2 class="text-lg md:text-xl text-gray-600 dark:text-[#b5a1b4] font-medium">by {{ $book_details->author }}</h2>
                            </div>
                            <div class="flex flex-wrap gap-4 text-sm text-gray-500 dark:text-gray-400 items-center">
                                {{--<div class="flex items-center gap-1.5">
                                    <span class="material-symbols-outlined text-secondary">schedule</span>
                                    <span>15 min read</span>
                                </div>
                                <div class="flex items-center gap-1.5">
                                    <span class="material-symbols-outlined text-secondary">headphones</span>
                                    <span>Audio available</span>
                                </div>--}}
                                <div class="flex items-center gap-1.5">
                                    <span class="material-symbols-outlined text-secondary">calendar_today</span>
                                    <span>Published 2018</span>
                                </div>
                            </div>
                            <div class="flex flex-wrap gap-3 mt-2">
                                <button data-id="{{ $book_details->id }}" data-type="book" class="add-to-cart-btn flex items-center justify-center gap-2 rounded-lg h-12 px-6 bg-primary hover:bg-primary/90 text-white font-bold transition-all shadow-lg shadow-primary/25">
                                    <span class="material-symbols-outlined">menu_book</span>
                                    <span>Add to cart</span>
                                </button>
                                <button class="flex items-center justify-center gap-2 rounded-lg h-12 px-6 bg-surface-dark dark:bg-[#362b36] hover:bg-gray-200 dark:hover:bg-[#4a3b4a] text-white font-bold transition-all border border-transparent dark:border-[#4a3b4a]">
                                    <span class="material-symbols-outlined">bookmark_add</span>
                                    <span>Library</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- Divider -->
                    <hr class="border-gray-200 dark:border-[#362b36]" />
                    <!-- Synopsis Section -->
                    <section>
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Synopsis</h3>
                        <div class="prose prose-lg dark:prose-invert prose-p:text-tertiary prose-p:leading-relaxed max-w-none">
                            <p>
                                {!! $book_details->synopsis !!}</p>
                        </div>
                    </section>
                    <!-- Key Takeaways Cards -->
                    {{--<section>
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white">Key Takeaways</h3>
                            <button class="text-primary text-sm font-bold hover:underline">View all</button>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Card 1 -->
                            <div class="p-5 rounded-xl bg-tertiary text-background-dark flex flex-col gap-3 relative overflow-hidden group">
                                <div class="absolute -right-4 -top-4 bg-primary/20 size-24 rounded-full group-hover:scale-110 transition-transform"></div>
                                <div class="size-8 rounded-full bg-primary/20 text-primary flex items-center justify-center font-bold text-sm mb-1">01</div>
                                <h4 class="font-bold text-lg leading-tight">Small habits make a big difference.</h4>
                                <p class="text-sm opacity-80 leading-relaxed">Improving by 1% every day results in a 37x improvement after one year.</p>
                            </div>
                            <!-- Card 2 -->
                            <div class="p-5 rounded-xl bg-surface-dark border border-[#362b36] flex flex-col gap-3 group hover:border-secondary/50 transition-colors">
                                <div class="size-8 rounded-full bg-secondary/20 text-secondary flex items-center justify-center font-bold text-sm mb-1">02</div>
                                <h4 class="font-bold text-lg text-white leading-tight">Focus on systems, not goals.</h4>
                                <p class="text-sm text-[#b5a1b4] leading-relaxed">Goals are about the results you want to achieve. Systems are about the processes that lead to those results.</p>
                            </div>
                            <!-- Card 3 -->
                            <div class="p-5 rounded-xl bg-surface-dark border border-[#362b36] flex flex-col gap-3 group hover:border-secondary/50 transition-colors">
                                <div class="size-8 rounded-full bg-secondary/20 text-secondary flex items-center justify-center font-bold text-sm mb-1">03</div>
                                <h4 class="font-bold text-lg text-white leading-tight">Make it obvious.</h4>
                                <p class="text-sm text-[#b5a1b4] leading-relaxed">The 1st law of behavior change is to make the cue visible in your environment.</p>
                            </div>
                            <!-- Card 4 -->
                            <div class="p-5 rounded-xl bg-surface-dark border border-[#362b36] flex flex-col gap-3 group hover:border-secondary/50 transition-colors">
                                <div class="size-8 rounded-full bg-secondary/20 text-secondary flex items-center justify-center font-bold text-sm mb-1">04</div>
                                <h4 class="font-bold text-lg text-white leading-tight">Make it satisfying.</h4>
                                <p class="text-sm text-[#b5a1b4] leading-relaxed">What is immediately rewarded is repeated. What is immediately punished is avoided.</p>
                            </div>
                        </div>
                    </section>--}}
                    <!-- Actionable Advice -->
                    {{--<section class="bg-[#181118] border border-[#362b36] rounded-2xl p-6 md:p-8">
                        <div class="flex items-start gap-4">
                            <div class="p-3 bg-secondary/10 rounded-lg text-secondary shrink-0">
                                <span class="material-symbols-outlined">psychology_alt</span>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-white mb-2">Apply this to your life</h3>
                                <p class="text-tertiary/90 mb-4 leading-relaxed">
                                    Start by identifying a habit you want to build. Use habit stacking: "After I [CURRENT HABIT], I will [NEW HABIT]." For example, "After I pour my coffee, I will meditate for one minute."
                                </p>
                                <a class="inline-flex items-center text-primary font-bold hover:text-white transition-colors" href="#">
                                    <span>Download Worksheet</span>
                                    <span class="material-symbols-outlined text-lg ml-1">arrow_forward</span>
                                </a>
                            </div>
                        </div>
                    </section>--}}
                </div>
                <!-- Right Column (Sidebar) -->
                <aside class="lg:col-span-4 flex flex-col gap-8">
                    <!-- Progress Card -->
                    {{--<div class="p-6 rounded-xl bg-surface-dark border border-[#362b36]">
                        <h4 class="text-white font-bold mb-4 flex items-center gap-2">
                            <span class="material-symbols-outlined text-secondary">timelapse</span>
                            Your Progress
                        </h4>
                        <div class="flex items-end justify-between mb-2">
                            <span class="text-sm text-[#b5a1b4]">Reading</span>
                            <span class="text-sm font-bold text-secondary">35%</span>
                        </div>
                        <div class="w-full bg-[#181118] rounded-full h-2 mb-6">
                            <div class="bg-secondary h-2 rounded-full" style="width: 35%"></div>
                        </div>
                        <div class="flex items-center gap-3 p-3 rounded-lg bg-[#181118]/50">
                            <div class="size-10 rounded-full bg-white/10 flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined text-white text-lg">group</span>
                            </div>
                            <div class="text-sm">
                                <p class="text-white font-medium">Community Reading</p>
                                <p class="text-[#b5a1b4] text-xs">158 people reading now</p>
                            </div>
                        </div>
                    </div>--}}
                    <!-- Author Box -->
                    <div class="flex flex-col gap-4">
                        <h4 class="text-white font-bold text-lg">About the Author</h4>
                        <div class="flex items-center gap-4">
                            <div class="size-16 rounded-full bg-cover bg-center shrink-0" data-alt="Portrait of James Clear" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCyaUiSiSbS5hZLfI5_oMTFyjR2rqmSPtHFwRvR4eNTlSi3c6jc9IyV0DO7m6TDFEPJBWnLUubI16dgXjQ0n-HObzD7BXiqU6Hgvu0nCS1D1HZ9xQLcUga-aU1S1hp1jHA-Sqce2c28LJeeotjiOGMSH0OnTuxSlEsGYkOGNPfH0tyZsV_mIxNra3TcmT3FQJNq7meexmjVK6arAhzLh5N_hrnVYDiDBABbNzOXREJFqFKm2h74BUmNJOiCRw_VY9fzNdp73kXXzUA");'></div>
                            <div>
                                <h5 class="text-white font-bold">{{ $book_details->author }}</h5>
                                <p class="text-sm text-[#b5a1b4]">Writer and speaker focused on habits, decision-making, and continuous improvement.</p>
                            </div>
                        </div>
                       {{-- <button class="w-full py-2 rounded-lg border border-[#362b36] text-white hover:bg-[#362b36] transition-colors text-sm font-medium">Follow Author</button>--}}
                    </div>
                    <!-- Related Books -->
                    <div>
                        <h4 class="text-white font-bold text-lg mb-4">Similar Reads</h4>
                        <div class="flex flex-col gap-4">
                            @foreach($similar_books as $book)
                            <!-- Related 1 -->
                            <a class="flex gap-3 group p-2 hover:bg-[#362b36] rounded-lg transition-colors" href="{{ url('/book_summary/'.$book->id) }}">
                                <div class="w-12 aspect-[2/3] bg-gray-700 rounded bg-cover bg-center" data-alt="Cover of The Power of Habit" style="background-image: url('{{ asset($book_details->image) }}');"></div>
                                <div class="flex flex-col justify-center">
                                    <h6 class="text-white font-medium text-sm group-hover:text-primary transition-colors">{{ $book->title }}</h6>
                                    <p class="text-xs text-[#b5a1b4]">{{ $book->author }}</p>
                                </div>
                            </a>
                            @endforeach
                    
                        </div>
                    </div>
                </aside>
            </div>
        </main>
        <!-- Sticky Audio Player Bottom Bar -->
        {{--<div class="fixed bottom-0 left-0 right-0 bg-[#251b25]/95 dark:bg-[#1a121a]/95 backdrop-blur-lg border-t border-[#362b36] px-4 py-3 z-40 transform translate-y-0 transition-transform">
            <div class="max-w-[960px] mx-auto flex items-center gap-4 justify-between">
                <!-- Info (Hidden on mobile) -->
                <div class="hidden sm:flex items-center gap-3 w-1/4">
                    <div class="size-10 rounded bg-gray-700 bg-cover bg-center" data-alt="Thumbnail of Atomic Habits book cover" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDLte20Swi4k_C9NRmaxeJgAF8MKQgGCS-0rD0lsbgnYtODNc9f-9t7iHji8YXACmx37O5IZZQAJSsdqhEutkPysvRma-0uSNULQKzgynAL6sr5zjSe89lK5mco7puQEGuuTT4cGDqb0AQuwpm8Q9uE6sOPAflagY1I_Nj2ikWERvgPbqmMEudSy_Mh5YYNtrNFWJhNApHKrRWR4KrfoHP1A98v5BeQPpoqKiSEM6nk5sQAXWMkpN6po4adOOIx7SeCrecPsslsD_0");'></div>
                    <div class="flex flex-col overflow-hidden">
                        <span class="text-white text-sm font-bold truncate">Atomic Habits</span>
                        <span class="text-xs text-[#b5a1b4] truncate">Ch. 1: The Surprising Power</span>
                    </div>
                </div>
                <!-- Controls -->
                <div class="flex flex-col items-center gap-1 flex-1 max-w-md">
                    <div class="flex items-center gap-6">
                        <button class="text-[#b5a1b4] hover:text-white material-symbols-outlined text-xl">shuffle</button>
                        <button class="text-white hover:text-primary material-symbols-outlined text-2xl">skip_previous</button>
                        <button class="size-10 rounded-full bg-white text-black hover:scale-105 transition-transform flex items-center justify-center">
                            <span class="material-symbols-outlined text-2xl">play_arrow</span>
                        </button>
                        <button class="text-white hover:text-primary material-symbols-outlined text-2xl">skip_next</button>
                        <button class="text-[#b5a1b4] hover:text-white material-symbols-outlined text-xl">repeat</button>
                    </div>
                    <!-- Scrub bar -->
                    <div class="w-full flex items-center gap-2 text-[10px] text-[#b5a1b4] font-mono">
                        <span>04:12</span>
                        <div class="h-1 flex-1 bg-gray-700 rounded-full overflow-hidden cursor-pointer group">
                            <div class="h-full bg-primary w-1/3 group-hover:bg-primary/80 transition-colors relative">
                                <div class="absolute right-0 top-1/2 -translate-y-1/2 size-2 bg-white rounded-full opacity-0 group-hover:opacity-100"></div>
                            </div>
                        </div>
                        <span>15:30</span>
                    </div>
                </div>
                <!-- Volume / Actions (Hidden on mobile small) -->
                <div class="hidden sm:flex items-center justify-end gap-4 w-1/4">
                    <button class="text-[#b5a1b4] hover:text-white flex items-center gap-1 text-xs font-bold border border-[#362b36] px-2 py-1 rounded">
                        <span>1.0x</span>
                    </button>
                    <div class="flex items-center gap-2 group">
                        <span class="material-symbols-outlined text-[#b5a1b4] text-xl">volume_up</span>
                        <div class="w-20 h-1 bg-gray-700 rounded-full overflow-hidden">
                            <div class="h-full bg-secondary w-3/4"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>--}}
    </div>
        <!-- Footer -->
@include('../layouts/include/footer')
</body>
@endsection
@section('scripts')
@endsection