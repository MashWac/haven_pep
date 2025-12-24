@extends('layouts.client')
@section('headers')

@endsection
@section('content')
<body class="bg-background-light dark:bg-background-dark font-display text-gray-900 dark:text-white overflow-x-hidden">
    <!-- Main Layout Container -->
    <div class="relative flex min-h-screen w-full flex-col group/design-root">
        <!-- Top Navigation -->
              @include('../layouts/include/dark_header')

        <!-- Main Content Area -->
        <main class="flex flex-1 w-full max-w-[1440px] mx-auto">
            <!-- Sidebar -->
            <aside class="hidden lg:flex w-64 flex-col border-r border-gray-200 dark:border-surface-dark bg-white dark:bg-background-dark p-6 shrink-0 sticky top-[73px] h-[calc(100vh-73px)] overflow-y-auto">
                <div class="flex flex-col gap-8">
                    <!-- Filters Group 1 -->
                    <div>
                        <h3 class="text-gray-900 dark:text-white text-sm font-bold uppercase tracking-wider mb-4">Browse by Topic</h3>
                        <div class="flex flex-col gap-1">
                            <a class="flex items-center gap-3 px-3 py-2 rounded-lg bg-primary/10 text-primary font-medium" href="#">
                                <span class="material-symbols-outlined text-[20px]">grid_view</span>
                                <span class="text-sm">All Books</span>
                            </a>
                            @foreach($books_categories as $category)
                            <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-surface-dark transition-colors" href="#">
                                <span class="material-symbols-outlined text-[20px]">self_improvement</span>
                                <span class="text-sm">{{ $category->category_name }}</span>
                            </a>
                            @endforeach

                        </div>
                    </div>
                    <!-- Filters Group 2 -->
                    <div>
                        <h3 class="text-gray-900 dark:text-white text-sm font-bold uppercase tracking-wider mb-4">Format</h3>
                        <div class="flex flex-col gap-2">
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <div class="relative flex items-center">
                                    <input class="peer h-5 w-5 cursor-pointer appearance-none rounded-md border border-gray-300 dark:border-gray-600 bg-transparent checked:bg-primary checked:border-primary transition-all" type="checkbox" />
                                    <span class="absolute text-white opacity-0 peer-checked:opacity-100 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 pointer-events-none">
                                        <svg class="h-3.5 w-3.5" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path clip-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" fill-rule="evenodd"></path>
                                        </svg>
                                    </span>
                                </div>
                                <span class="text-sm text-gray-600 dark:text-gray-400 group-hover:text-primary transition-colors">E-Book</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <div class="relative flex items-center">
                                    <input class="peer h-5 w-5 cursor-pointer appearance-none rounded-md border border-gray-300 dark:border-gray-600 bg-transparent checked:bg-primary checked:border-primary transition-all" type="checkbox" />
                                    <span class="absolute text-white opacity-0 peer-checked:opacity-100 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 pointer-events-none">
                                        <svg class="h-3.5 w-3.5" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path clip-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" fill-rule="evenodd"></path>
                                        </svg>
                                    </span>
                                </div>
                                <span class="text-sm text-gray-600 dark:text-gray-400 group-hover:text-primary transition-colors">Audiobook</span>
                            </label>
                        </div>
                    </div>
                    <!-- Promo Card -->
                    <div class="mt-auto p-4 rounded-xl bg-gradient-to-br from-secondary/20 to-primary/20 border border-secondary/20">
                        <div class="flex items-center gap-2 mb-2 text-secondary">
                            <span class="material-symbols-outlined">auto_awesome</span>
                            <span class="text-xs font-bold uppercase">Pro Feature</span>
                        </div>
                        <p class="text-sm font-medium mb-3">Get unlimited access to all audiobooks with Premium.</p>
                        <button class="w-full py-2 bg-white dark:bg-background-dark text-gray-900 dark:text-white text-xs font-bold rounded-lg hover:shadow-md transition-shadow">Upgrade Now</button>
                    </div>
                </div>
            </aside>
            <!-- Content Area -->
            <div class="flex-1 flex flex-col min-w-0 p-6 md:p-10 gap-8">
                <!-- Hero Section -->
                <div class="relative overflow-hidden rounded-2xl bg-surface-dark">
                    <div class="absolute inset-0 bg-cover bg-center opacity-60 mix-blend-overlay" data-alt="Abstract calming waves pattern background"  style="background-image: url('{{ asset($top_book->image) }}');"></div>
                    <div class="absolute inset-0 bg-gradient-to-r from-background-dark via-background-dark/80 to-transparent"></div>
                    <div class="relative z-10 flex flex-col md:flex-row items-center gap-8 p-8 md:p-12">
                        <div class="shrink-0 w-32 md:w-48 shadow-2xl rotate-[-5deg] hover:rotate-0 transition-transform duration-500">
                            <img alt="Book cover of Finding Balance showing a stacked stone sculpture" class="rounded-lg w-full h-auto object-cover aspect-[2/3]" src="{{ asset($top_book->image) }}" />
                        </div>
                        <div class="flex flex-col items-center md:items-start text-center md:text-left">
                            <span class="px-3 py-1 rounded-full bg-primary/20 text-primary text-xs font-bold tracking-wider uppercase mb-4 border border-primary/20">Book of the Month</span>
                            <h1 class="text-3xl md:text-5xl font-black text-white mb-4 tracking-tight">{{$top_book->title}}</h1>
                            <p class="text-gray-300 text-sm md:text-lg mb-6 max-w-lg">{{$top_book->subtitle}}</p>
                            <div class="flex gap-4">
                                <button class="flex items-center gap-2 bg-primary hover:bg-primary/90 text-white px-6 py-3 rounded-lg font-bold transition-all shadow-[0_0_20px_-5px_#da71d7]">
                                    <span class="material-symbols-outlined">menu_book</span>
                                    <span>Start Reading</span>
                                </button>
                                <button class="flex items-center gap-2 bg-white/10 hover:bg-white/20 text-white px-6 py-3 rounded-lg font-bold backdrop-blur-sm transition-all">
                                    <span class="material-symbols-outlined">bookmark_add</span>
                                    <span>Save</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Search and Filters Bar -->
                <div class="flex flex-col md:flex-row gap-4 justify-between items-start md:items-center">
                    <div class="relative w-full md:w-96 group">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary transition-colors">
                            <span class="material-symbols-outlined">search</span>
                        </div>
                        <input class="block w-full pl-10 pr-3 py-3 border-none rounded-xl leading-5 bg-white dark:bg-surface-dark text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary sm:text-sm shadow-sm" placeholder="Search for titles, authors, or topics..." type="text" />
                    </div>
                    <!-- Chips -->
                    <div class="flex gap-2 overflow-x-auto pb-2 md:pb-0 w-full md:w-auto scrollbar-hide">
                        <button class="flex items-center gap-2 px-4 py-2 rounded-lg bg-tertiary text-gray-900 font-bold text-xs whitespace-nowrap shadow-sm hover:shadow-md transition-all">
                            <span class="material-symbols-outlined text-[16px]">headphones</span>
                            Audiobook
                        </button>
                        <button class="flex items-center gap-2 px-4 py-2 rounded-lg bg-white dark:bg-surface-dark border border-gray-200 dark:border-gray-700 text-gray-600 dark:text-gray-300 font-medium text-xs whitespace-nowrap hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                            <span class="material-symbols-outlined text-[16px] text-yellow-500">star</span>
                            High Rated
                        </button>
                        <button class="flex items-center gap-2 px-4 py-2 rounded-lg bg-white dark:bg-surface-dark border border-gray-200 dark:border-gray-700 text-gray-600 dark:text-gray-300 font-medium text-xs whitespace-nowrap hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                            New Arrivals
                        </button>
                    </div>
                </div>
                <!-- Book Grid -->
                <div>
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-bold text-gray-900 dark:text-white">Trending Now</h2>
                        <a class="text-primary text-sm font-bold hover:underline" href="#">View All</a>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 md:gap-8">
                        <!-- Book Card 1 -->
                         @foreach($books as $book)
                                     <div class="group relative flex flex-col gap-4">
                            <div class="relative aspect-[2/3] w-full overflow-hidden rounded-xl bg-gray-200 dark:bg-gray-800 shadow-lg group-hover:shadow-xl group-hover:shadow-primary/10 transition-all duration-300 group-hover:-translate-y-1">
                                <img alt="{{$book->title}}" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105" src="{{$book->image}}" />
                                <div class="absolute top-2 right-2">
                                    <span class="inline-flex items-center justify-center rounded-md bg-black/50 backdrop-blur-md px-2 py-1 text-xs font-bold text-white shadow-sm">
                                        <span class="material-symbols-outlined text-[14px] mr-1 text-yellow-400 fill-current">star</span> 4.9
                                    </span>
                                </div>
                                <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity flex flex-col items-center justify-center gap-3 p-4">
                                    <button class="w-full bg-primary text-white py-2 rounded-lg font-bold text-sm shadow-lg transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">Read Now</button>
                                    <button class="w-full bg-white/20 backdrop-blur-sm text-white py-2 rounded-lg font-bold text-sm hover:bg-white/30 transition-colors transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300 delay-75"><a href="{{url('/book_summary/'.$book->id)}}">Quick View</a></button>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-base font-bold text-gray-900 dark:text-white truncate">{{$book->title}}</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400">{{$book->author}}</p>
                                <div class="mt-2 flex items-center gap-2">
                                    <span class="inline-flex items-center rounded bg-secondary/10 px-2 py-0.5 text-xs font-medium text-secondary">{{$book->price}}</span>
                                    <span class="inline-flex items-center rounded bg-gray-100 dark:bg-gray-700 px-2 py-0.5 text-xs font-medium text-gray-600 dark:text-gray-300">
                                        <span class="material-symbols-outlined text-[12px] mr-1">headphones</span> Audio</span>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
                <!-- Pagination -->
                <div class="flex items-center justify-center mt-12 mb-8">
                    <nav aria-label="Pagination" class="flex items-center gap-2">
                        <button class="p-2 rounded-lg text-gray-500 hover:bg-gray-100 dark:hover:bg-surface-dark transition-colors">
                            <span class="material-symbols-outlined">chevron_left</span>
                        </button>
                        <button class="px-4 py-2 rounded-lg bg-primary text-white font-bold text-sm">1</button>
                        <button class="px-4 py-2 rounded-lg text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-surface-dark transition-colors font-medium text-sm">2</button>
                        <button class="px-4 py-2 rounded-lg text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-surface-dark transition-colors font-medium text-sm">3</button>
                        <span class="px-2 text-gray-400">...</span>
                        <button class="px-4 py-2 rounded-lg text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-surface-dark transition-colors font-medium text-sm">12</button>
                        <button class="p-2 rounded-lg text-gray-500 hover:bg-gray-100 dark:hover:bg-surface-dark transition-colors">
                            <span class="material-symbols-outlined">chevron_right</span>
                        </button>
                    </nav>
                </div>
            </div>
        </main>
    </div>
            <!-- Footer -->
@include('../layouts/include/footer')
</body>
@endsection
@section('scripts')
@endsection
