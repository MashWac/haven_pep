@extends('layouts.client')
@section('headers')
<style>
    /* Custom range slider track */
    input[type="range"] { -webkit-appearance: none; appearance: none; width: 100%; height: 5px; border-radius: 9999px; background: #362b36; outline: none; }
    input[type="range"]::-webkit-slider-thumb { -webkit-appearance: none; appearance: none; width: 18px; height: 18px; border-radius: 50%; background: #DA70D6; cursor: pointer; border: 2px solid #fff; box-shadow: 0 0 0 2px #DA70D6; }
    /* Hide scrollbar but allow scroll */
    .carousel-track::-webkit-scrollbar { display: none; }
    .carousel-track { -ms-overflow-style: none; scrollbar-width: none; }
</style>
@endsection

@section('content')
<body class="bg-background-light dark:bg-background-dark font-display text-gray-900 dark:text-white overflow-x-hidden">
<div class="relative flex min-h-screen w-full flex-col group/design-root">

    {{-- ── HEADER ─────────────────────────────────────────────────────────── --}}
    @include('../layouts/include/dark_header')

    {{-- ══════════════════════════════════════════════════════════════════════
         HERO — COMBOS
    ══════════════════════════════════════════════════════════════════════════ --}}
    @if($combos->count())
    <section class="w-full bg-surface-dark/40 dark:bg-[#1a0f1a] border-b border-[#362b36] py-12 px-6">
        <div class="max-w-[1440px] mx-auto">
            <div class="flex items-center gap-3 mb-8">
                <span class="material-symbols-outlined text-primary text-3xl">redeem</span>
                <div>
                    <h2 class="text-2xl font-black text-gray-900 dark:text-white">Combo Deals</h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Bundle offers — great value, better results.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($combos as $combo)
                <div class="group relative bg-white dark:bg-[#231b23] rounded-2xl overflow-hidden border border-gray-200 dark:border-[#362b36] shadow-lg hover:shadow-primary/20 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    {{-- Image --}}
                    <div class="relative h-52 bg-gray-100 dark:bg-surface-dark overflow-hidden">
                        @if($combo->image)
                            <img src="{{ asset($combo->image) }}" alt="{{ $combo->name }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-primary/20 to-secondary/20">
                                <span class="material-symbols-outlined text-primary text-6xl">redeem</span>
                            </div>
                        @endif
                        {{-- Gradient overlay --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                        {{-- Discount badge --}}
                        @if($combo->discount_percentage > 0)
                        <span class="absolute top-3 right-3 bg-green-500 text-white text-xs font-black px-3 py-1 rounded-full shadow-lg">
                            {{ $combo->discount_percentage }}% OFF
                        </span>
                        @endif
                        {{-- Item count badge --}}
                        <span class="absolute bottom-3 left-3 bg-black/50 backdrop-blur-sm text-white text-xs font-medium px-3 py-1.5 rounded-full flex items-center gap-1">
                            <span class="material-symbols-outlined text-[14px] text-primary">inventory_2</span>
                            {{ $combo->item_count }} item{{ $combo->item_count != 1 ? 's' : '' }}
                        </span>
                    </div>
                    {{-- Info --}}
                    <div class="p-5">
                        <h3 class="text-lg font-black text-gray-900 dark:text-white mb-1 group-hover:text-primary transition-colors">{{ $combo->name }}</h3>
                        @if($combo->description)
                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-3 line-clamp-2">{{ $combo->description }}</p>
                        @endif
                        @if($combo->item_names)
                        <p class="text-[11px] text-gray-400 dark:text-gray-500 mb-4 line-clamp-1 italic" title="{{ $combo->item_names }}">
                            Includes: {{ $combo->item_names }}
                        </p>
                        @endif
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-2xl font-black text-gray-900 dark:text-white">KES {{ number_format($combo->price, 2) }}</span>
                                @if($combo->discount_percentage > 0)
                                @php $original = $combo->price / (1 - $combo->discount_percentage / 100); @endphp
                                <span class="ml-2 text-sm line-through text-gray-400">KES {{ number_format($original, 0) }}</span>
                                @endif
                            </div>
                            <button data-id="{{ $combo->id }}" data-type="combo"
                                class="add-to-cart-btn flex items-center gap-2 bg-primary hover:bg-primary/90 text-white text-sm font-bold px-4 py-2.5 rounded-xl shadow-md hover:shadow-primary/30 transition-all active:scale-95">
                                <span class="material-symbols-outlined text-[18px]">add_shopping_cart</span>
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- ══════════════════════════════════════════════════════════════════════
         MAIN CONTENT — SIDEBAR FILTERS + PRODUCT CAROUSELS
    ══════════════════════════════════════════════════════════════════════════ --}}
    <main class="flex flex-1 w-full max-w-[1440px] mx-auto">

        {{-- ── FILTER SIDEBAR ────────────────────────────────────────────── --}}
        <aside class="hidden lg:flex w-72 flex-col border-r border-gray-200 dark:border-[#362b36] bg-white dark:bg-background-dark p-6 shrink-0 sticky top-[73px] h-[calc(100vh-73px)] overflow-y-auto">
            <form id="filter-form" method="GET" action="{{ url('/shop') }}" class="flex flex-col gap-8 h-full">

                {{-- Search --}}
                <div>
                    <h3 class="text-gray-900 dark:text-white text-xs font-bold uppercase tracking-wider mb-3">Search</h3>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-3 top-2.5 text-gray-400 text-lg pointer-events-none">search</span>
                        <input type="text" name="search" id="search-input" value="{{ $search ?? '' }}"
                            placeholder="Search items..."
                            class="w-full pl-9 pr-4 py-2.5 rounded-xl border border-gray-200 dark:border-[#362b36] bg-gray-50 dark:bg-surface-dark text-sm dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary transition-all">
                    </div>
                </div>

                {{-- Category filter --}}
                <div>
                    <h3 class="text-gray-900 dark:text-white text-xs font-bold uppercase tracking-wider mb-3">Browse by Category</h3>
                    <div class="flex flex-col gap-1">
                        <label class="flex items-center gap-3 px-3 py-2 rounded-lg cursor-pointer transition-colors {{ !$selectedCategory ? 'bg-primary/10 text-primary font-semibold' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-surface-dark' }}">
                            <input type="radio" name="category" value="" {{ !$selectedCategory ? 'checked' : '' }} class="hidden" onchange="this.form.submit()">
                            <span class="material-symbols-outlined text-[18px]">grid_view</span>
                            <span class="text-sm">All Categories</span>
                        </label>
                        @foreach($categories as $cat)
                        <label class="flex items-center justify-between gap-3 px-3 py-2 rounded-lg cursor-pointer transition-colors {{ $selectedCategory == $cat->id ? 'bg-primary/10 text-primary font-semibold' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-surface-dark' }}">
                            <div class="flex items-center gap-3">
                                <input type="radio" name="category" value="{{ $cat->id }}" {{ $selectedCategory == $cat->id ? 'checked' : '' }} class="hidden" onchange="this.form.submit()">
                                <span class="material-symbols-outlined text-[18px]">storefront</span>
                                <span class="text-sm">{{ $cat->name }}</span>
                            </div>
                            <span class="text-[10px] font-bold bg-gray-100 dark:bg-[#362b36] text-gray-500 dark:text-gray-400 px-2 py-0.5 rounded-full">{{ $cat->items_count }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>

                {{-- Price range filter --}}
                <div>
                    <h3 class="text-gray-900 dark:text-white text-xs font-bold uppercase tracking-wider mb-3">Max Price</h3>
                    <div class="flex flex-col gap-3">
                        <div class="flex items-center justify-between text-sm text-gray-500 dark:text-gray-400">
                            <span>KES 0</span>
                            <span id="price-display" class="font-bold text-primary">
                                KES {{ number_format($maxPrice ?? $maxProductPrice, 0) }}
                            </span>
                        </div>
                        <input type="range" name="max_price" id="price-range"
                            min="0" max="{{ $maxProductPrice }}" step="100"
                            value="{{ $maxPrice ?? $maxProductPrice }}"
                            class="w-full cursor-pointer"
                            oninput="document.getElementById('price-display').textContent = 'KES ' + parseInt(this.value).toLocaleString()">
                        <button type="submit"
                            class="w-full py-2.5 rounded-xl bg-primary hover:bg-primary/90 text-white text-sm font-bold transition-all shadow-sm hover:shadow-primary/30">
                            Apply Filters
                        </button>
                    </div>
                </div>

                {{-- Reset --}}
                @if($selectedCategory || $maxPrice || $search)
                <a href="{{ url('/shop') }}" class="flex items-center gap-2 text-sm text-gray-400 hover:text-red-400 transition-colors mt-auto">
                    <span class="material-symbols-outlined text-[16px]">filter_list_off</span>
                    Clear all filters
                </a>
                @endif

                {{-- Promo card --}}
                <div class="mt-auto p-4 rounded-xl bg-gradient-to-br from-primary/20 to-secondary/20 border border-primary/20">
                    <div class="flex items-center gap-2 mb-2 text-primary">
                        <span class="material-symbols-outlined">local_offer</span>
                        <span class="text-xs font-bold uppercase">Limited Offer</span>
                    </div>
                    <p class="text-sm font-medium mb-3 dark:text-white">Bundle up with our Combo Deals and save up to 30%!</p>
                    <a href="#combos-section" class="block w-full py-2 bg-white dark:bg-background-dark text-gray-900 dark:text-white text-xs font-bold rounded-lg hover:shadow-md transition-shadow text-center">
                        View Combos ↑
                    </a>
                </div>

            </form>
        </aside>

        {{-- ── PRODUCT AREA ───────────────────────────────────────────────── --}}
        <div class="flex-1 flex flex-col min-w-0 p-6 md:p-10 gap-12">

            {{-- Mobile filters bar --}}
            <div class="flex lg:hidden items-center gap-3 flex-wrap">
                <form method="GET" action="{{ url('/shop') }}" class="flex gap-2 flex-1 min-w-0">
                    <div class="relative flex-1">
                        <span class="material-symbols-outlined absolute left-3 top-2.5 text-gray-400 text-lg pointer-events-none">search</span>
                        <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search..."
                            class="w-full pl-9 pr-4 py-2 rounded-xl border border-gray-200 dark:border-[#362b36] bg-white dark:bg-surface-dark text-sm dark:text-white focus:outline-none focus:ring-2 focus:ring-primary">
                    </div>
                    <button type="submit" class="px-4 py-2 rounded-xl bg-primary text-white text-sm font-bold">Go</button>
                </form>
                <button onclick="document.getElementById('mobile-filter-drawer').classList.toggle('hidden')"
                    class="flex items-center gap-2 px-4 py-2 rounded-xl border border-gray-200 dark:border-[#362b36] bg-white dark:bg-surface-dark text-sm font-medium dark:text-white">
                    <span class="material-symbols-outlined text-[18px]">tune</span> Filter
                </button>
            </div>

            {{-- Mobile filter drawer --}}
            <div id="mobile-filter-drawer" class="hidden lg:hidden bg-white dark:bg-surface-dark rounded-2xl border border-gray-200 dark:border-[#362b36] p-5 shadow-lg">
                <form method="GET" action="{{ url('/shop') }}" class="flex flex-col gap-5">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-2">Category</p>
                        <div class="flex flex-wrap gap-2">
                            <a href="{{ url('/shop') }}" class="px-3 py-1.5 rounded-full text-xs font-medium {{ !$selectedCategory ? 'bg-primary text-white' : 'bg-gray-100 dark:bg-[#362b36] text-gray-600 dark:text-gray-300' }}">All</a>
                            @foreach($categories as $cat)
                            <a href="{{ url('/shop?category='.$cat->id) }}" class="px-3 py-1.5 rounded-full text-xs font-medium {{ $selectedCategory == $cat->id ? 'bg-primary text-white' : 'bg-gray-100 dark:bg-[#362b36] text-gray-600 dark:text-gray-300' }}">
                                {{ $cat->name }}
                            </a>
                            @endforeach
                        </div>
                    </div>
                    <div>
                        <p class="text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-2">
                            Max Price: <span class="text-primary" id="mobile-price-display">KES {{ number_format($maxPrice ?? $maxProductPrice, 0) }}</span>
                        </p>
                        <input type="range" name="max_price" min="0" max="{{ $maxProductPrice }}" step="100"
                            value="{{ $maxPrice ?? $maxProductPrice }}"
                            oninput="document.getElementById('mobile-price-display').textContent='KES '+parseInt(this.value).toLocaleString()"
                            class="w-full cursor-pointer">
                    </div>
                    <button type="submit" class="w-full py-2 rounded-xl bg-primary text-white text-sm font-bold">Apply</button>
                </form>
            </div>

            {{-- Active filter chips --}}
            @if($selectedCategory || ($maxPrice && $maxPrice < $maxProductPrice) || $search)
            <div class="flex flex-wrap gap-2 -mt-6">
                @if($search)
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-primary/10 text-primary text-xs font-medium">
                    <span class="material-symbols-outlined text-[14px]">search</span>
                    "{{ $search }}"
                    <a href="{{ url('/shop') }}?{{ http_build_query(array_filter(['category'=>$selectedCategory,'max_price'=>$maxPrice])) }}" class="ml-1 hover:text-red-400">✕</a>
                </span>
                @endif
                @if($selectedCategory)
                @php $activeCat = $categories->firstWhere('id', $selectedCategory); @endphp
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-secondary/10 text-secondary text-xs font-medium">
                    <span class="material-symbols-outlined text-[14px]">category</span>
                    {{ $activeCat?->name ?? 'Category' }}
                    <a href="{{ url('/shop') }}?{{ http_build_query(array_filter(['search'=>$search,'max_price'=>$maxPrice])) }}" class="ml-1 hover:text-red-400">✕</a>
                </span>
                @endif
                @if($maxPrice && $maxPrice < $maxProductPrice)
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-gray-100 dark:bg-surface-dark text-gray-600 dark:text-gray-300 text-xs font-medium">
                    <span class="material-symbols-outlined text-[14px]">payments</span>
                    Up to KES {{ number_format($maxPrice, 0) }}
                    <a href="{{ url('/shop') }}?{{ http_build_query(array_filter(['search'=>$search,'category'=>$selectedCategory])) }}" class="ml-1 hover:text-red-400">✕</a>
                </span>
                @endif
            </div>
            @endif

            {{-- ── Product carousels grouped by category ─────────────────── --}}
            @forelse($productsByCategory as $categoryName => $products)
            <section id="cat-{{ Str::slug($categoryName) }}">
                {{-- Section header --}}
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center gap-3">
                        <div class="w-1 h-7 bg-primary rounded-full"></div>
                        <h2 class="text-xl font-black text-gray-900 dark:text-white">{{ $categoryName }}</h2>
                        <span class="text-xs font-medium text-gray-400 bg-gray-100 dark:bg-surface-dark px-2 py-0.5 rounded-full">{{ $products->count() }}</span>
                    </div>
                    {{-- Carousel nav --}}
                    <div class="flex items-center gap-2">
                        <button onclick="scrollCarousel('carousel-{{ Str::slug($categoryName) }}', -1)"
                            class="p-2 rounded-full border border-gray-200 dark:border-[#362b36] text-gray-500 dark:text-gray-400 hover:border-primary hover:text-primary transition-colors">
                            <span class="material-symbols-outlined text-lg">chevron_left</span>
                        </button>
                        <button onclick="scrollCarousel('carousel-{{ Str::slug($categoryName) }}', 1)"
                            class="p-2 rounded-full border border-gray-200 dark:border-[#362b36] text-gray-500 dark:text-gray-400 hover:border-primary hover:text-primary transition-colors">
                            <span class="material-symbols-outlined text-lg">chevron_right</span>
                        </button>
                    </div>
                </div>

                {{-- Scrollable carousel --}}
                <div id="carousel-{{ Str::slug($categoryName) }}"
                    class="carousel-track flex gap-5 overflow-x-auto pb-4 scroll-smooth snap-x snap-mandatory">
                    @foreach($products as $product)
                    <div class="snap-start flex-shrink-0 w-52 group relative flex flex-col rounded-2xl overflow-hidden border border-gray-200 dark:border-[#362b36] bg-white dark:bg-[#231b23] shadow-sm hover:shadow-lg hover:shadow-primary/10 hover:-translate-y-1 transition-all duration-300">
                        {{-- Product image --}}
                        <div class="relative h-44 bg-gray-100 dark:bg-surface-dark overflow-hidden">
                            @if($product->image)
                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-primary/10 to-secondary/10">
                                    <span class="material-symbols-outlined text-gray-300 dark:text-gray-600 text-4xl">shopping_bag</span>
                                </div>
                            @endif
                            {{-- Discount badge --}}
                            @if($product->discount_percentage > 0)
                            <span class="absolute top-2 left-2 bg-green-500 text-white text-[10px] font-black px-2 py-0.5 rounded-full">
                                -{{ $product->discount_percentage }}%
                            </span>
                            @endif
                            {{-- Hover overlay --}}
                            <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-2 p-4">
                                <button data-id="{{ $product->id }}" data-type="shop_item"
                                    class="add-to-cart-btn w-full bg-primary text-white text-xs font-bold py-2 rounded-lg transform translate-y-2 group-hover:translate-y-0 transition-transform duration-200 flex items-center justify-center gap-1">
                                    <span class="material-symbols-outlined text-[14px]">add_shopping_cart</span> Add
                                </button>
                            </div>
                        </div>
                        {{-- Product info --}}
                        <div class="p-4 flex flex-col gap-1 flex-1">
                            <h3 class="text-sm font-bold text-gray-900 dark:text-white line-clamp-2 group-hover:text-primary transition-colors leading-snug">{{ $product->name }}</h3>
                            <p class="text-[11px] text-gray-400 dark:text-gray-500 line-clamp-2 flex-1">{{ $product->description ?? '' }}</p>
                            <div class="flex items-center justify-between mt-2">
                                <div>
                                    <span class="text-base font-black text-gray-900 dark:text-white">
                                        KES {{ number_format($product->price, 0) }}
                                    </span>
                                    @if($product->discount_percentage > 0)
                                    @php $origPrice = $product->price / (1 - $product->discount_percentage / 100); @endphp
                                    <span class="block text-[10px] line-through text-gray-400">KES {{ number_format($origPrice, 0) }}</span>
                                    @endif
                                </div>
                                <button data-id="{{ $product->id }}" data-type="shop_item"
                                    class="add-to-cart-btn flex items-center justify-center w-8 h-8 rounded-full bg-primary/10 hover:bg-primary text-primary hover:text-white transition-all active:scale-90">
                                    <span class="material-symbols-outlined text-[16px]">add</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>
            @empty
            {{-- Empty state --}}
            <div class="flex flex-col items-center justify-center py-24 text-center">
                <span class="material-symbols-outlined text-6xl text-gray-300 dark:text-gray-600 mb-4">inventory_2</span>
                <h3 class="text-xl font-black text-gray-900 dark:text-white mb-2">No items found</h3>
                <p class="text-gray-500 dark:text-gray-400 text-sm mb-6">
                    @if($search || $selectedCategory || $maxPrice)
                        Try adjusting your filters or search term.
                    @else
                        The shop is being stocked. Check back soon!
                    @endif
                </p>
                @if($search || $selectedCategory || $maxPrice)
                <a href="{{ url('/shop') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-primary text-white text-sm font-bold hover:opacity-90 transition-opacity">
                    <span class="material-symbols-outlined text-[18px]">filter_list_off</span>
                    Clear filters
                </a>
                @endif
            </div>
            @endforelse

        </div>
    </main>

    {{-- Footer --}}
    @include('../layouts/include/footer')
</div>
</body>
@endsection

@section('scripts')
<script>
    // ── Carousel scroll helper ────────────────────────────────────────────────
    function scrollCarousel(id, direction) {
        const el = document.getElementById(id);
        if (el) el.scrollBy({ left: direction * 280, behavior: 'smooth' });
    }

    // ── Highlight active sidebar category on page load (no Alpine on this page)
    document.addEventListener('DOMContentLoaded', function () {
        // Smooth-scroll anchor for mobile "View Combos" link
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                const target = document.querySelector(this.getAttribute('href'));
                if (target) { e.preventDefault(); target.scrollIntoView({ behavior: 'smooth' }); }
            });
        });
    });
</script>
@endsection
