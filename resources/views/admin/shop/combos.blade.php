@extends('layouts.admin')
@section('content')
<main class="flex-1 flex flex-col h-full overflow-hidden bg-background-light dark:bg-background-dark relative">
    <header class="flex items-center justify-between whitespace-nowrap border-b border-[#e5e2dc] dark:border-gray-800 bg-white dark:bg-[#1f1a12] px-8 py-4 z-10">
        <div class="flex items-center gap-4 text-[#171511] dark:text-white">
            <span class="material-symbols-outlined text-brand-teal text-3xl">redeem</span>
            <h2 class="text-xl font-bold leading-tight tracking-tight">Shop Combos</h2>
        </div>
    </header>
    <div class="flex-1 overflow-y-auto p-8">
        <div class="max-w-7xl mx-auto flex flex-col gap-8">
            {{-- Breadcrumbs --}}
            <div class="flex flex-wrap items-center gap-2">
                <a class="text-gray-500 hover:text-brand-orchid transition-colors text-sm font-medium" href="{{ url('/admin_dashboard') }}">Home</a>
                <span class="material-symbols-outlined text-gray-400 text-sm">chevron_right</span>
                <a class="text-gray-500 hover:text-brand-orchid transition-colors text-sm font-medium" href="{{ url('/admin_shop') }}">Shop</a>
                <span class="material-symbols-outlined text-gray-400 text-sm">chevron_right</span>
                <span class="text-[#171511] dark:text-white text-sm font-bold text-brand-orchid">Combos</span>
            </div>

            @if(session('success'))
            <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-800 dark:text-green-200 px-4 py-3 rounded-lg flex items-center gap-2">
                <span class="material-symbols-outlined">check_circle</span>
                <span>{{ session('success') }}</span>
            </div>
            @endif

            {{-- Header row --}}
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div class="flex flex-col gap-1">
                    <h1 class="text-[#171511] dark:text-white text-3xl font-black leading-tight">Combos</h1>
                    <p class="text-gray-500 dark:text-gray-400 text-base">Bundle multiple shop items together as a combo deal.</p>
                </div>
                <a href="{{ url('/admin_shop_combos/add') }}" class="flex items-center justify-center px-4 h-10 rounded-lg bg-[#DA70D6] text-white text-sm font-bold shadow-md hover:opacity-90 transition-opacity">
                    <span class="material-symbols-outlined text-[20px] mr-2">add</span>
                    Create Combo
                </a>
            </div>

            {{-- Grid of Combo Cards --}}
            @if($data['combos']->count())
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                @foreach($data['combos'] as $combo)
                <div class="bg-white dark:bg-[#2a2415] rounded-xl border border-gray-100 dark:border-gray-800 shadow-sm overflow-hidden group hover:shadow-md transition-shadow">
                    {{-- Combo Image --}}
                    <div class="h-44 bg-gray-100 dark:bg-gray-800 relative overflow-hidden">
                        @if($combo->image)
                            <img src="{{ asset($combo->image) }}" alt="{{ $combo->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <span class="material-symbols-outlined text-gray-300 dark:text-gray-600 text-6xl">redeem</span>
                            </div>
                        @endif
                        @if($combo->discount_percentage > 0)
                        <span class="absolute top-3 right-3 inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-green-500 text-white shadow">
                            {{ $combo->discount_percentage }}% OFF
                        </span>
                        @endif
                    </div>
                    {{-- Combo Info --}}
                    <div class="p-5">
                        <h3 class="font-black text-[#171511] dark:text-white text-lg mb-1 group-hover:text-brand-orchid transition-colors">{{ $combo->name }}</h3>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-3 line-clamp-2">{{ $combo->description ?? 'No description.' }}</p>

                        <div class="flex items-center gap-2 mb-3">
                            <span class="material-symbols-outlined text-[#DA70D6] text-sm">inventory_2</span>
                            <span class="text-xs text-gray-600 dark:text-gray-300 font-medium">{{ $combo->item_count }} item{{ $combo->item_count != 1 ? 's' : '' }} included</span>
                        </div>
                        @if($combo->item_names)
                        <p class="text-[11px] text-gray-400 dark:text-gray-500 mb-4 line-clamp-1" title="{{ $combo->item_names }}">{{ $combo->item_names }}</p>
                        @endif

                        <div class="flex items-center justify-between">
                            <span class="text-xl font-black text-[#171511] dark:text-white">USD {{ number_format($combo->price, 2) }}</span>
                            <div class="flex items-center gap-1">
                                <a href="{{ url('/admin_shop_combos/edit/'.$combo->id) }}" class="p-1.5 text-gray-400 hover:text-brand-orchid hover:bg-brand-orchid/10 rounded-md transition-colors" title="Edit">
                                    <span class="material-symbols-outlined text-lg">edit</span>
                                </a>
                                <form action="{{ url('/admin_shop_combos/delete/'.$combo->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 text-gray-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-md transition-colors show_confirm" title="Delete">
                                        <span class="material-symbols-outlined text-lg">delete</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="bg-white dark:bg-[#2a2415] rounded-xl border border-gray-100 dark:border-gray-800 shadow-sm p-16 text-center text-gray-400">
                <span class="material-symbols-outlined text-5xl mb-3 block">redeem</span>
                <p class="text-lg font-semibold mb-1">No combos yet</p>
                <p class="text-sm mb-4">Start bundling shop items to create great value deals.</p>
                <a href="{{ url('/admin_shop_combos/add') }}" class="inline-flex items-center px-4 h-10 rounded-lg bg-[#DA70D6] text-white text-sm font-bold hover:opacity-90 transition-opacity">
                    <span class="material-symbols-outlined text-[18px] mr-1">add</span> Create First Combo
                </a>
            </div>
            @endif
        </div>
    </div>
</main>
@endsection
@section('scripts')
@endsection
