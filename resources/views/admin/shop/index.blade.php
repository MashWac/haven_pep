@extends('layouts.admin')
@section('content')
<main class="flex-1 flex flex-col h-full overflow-hidden bg-background-light dark:bg-background-dark relative">
    <header class="flex items-center justify-between whitespace-nowrap border-b border-[#e5e2dc] dark:border-gray-800 bg-white dark:bg-[#1f1a12] px-8 py-4 z-10">
        <div class="flex items-center gap-4 text-[#171511] dark:text-white">
            <span class="material-symbols-outlined text-brand-teal text-3xl">storefront</span>
            <h2 class="text-xl font-bold leading-tight tracking-tight">Shop Management</h2>
        </div>
        <div class="flex items-center gap-4">
            <button class="flex items-center justify-center p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                <span class="material-symbols-outlined text-gray-500 dark:text-gray-400">notifications</span>
            </button>
        </div>
    </header>
    <div class="flex-1 overflow-y-auto p-8">
        <div class="max-w-7xl mx-auto flex flex-col gap-8">
            {{-- Breadcrumbs --}}
            <div class="flex flex-wrap items-center gap-2">
                <a class="text-gray-500 hover:text-brand-orchid transition-colors text-sm font-medium" href="{{ url('/admin_dashboard') }}">Home</a>
                <span class="material-symbols-outlined text-gray-400 text-sm">chevron_right</span>
                <span class="text-[#171511] dark:text-white text-sm font-bold text-brand-orchid">Shop Items</span>
            </div>

            {{-- Flash Messages --}}
            @if(session('success'))
            <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-800 dark:text-green-200 px-4 py-3 rounded-lg flex items-center gap-2">
                <span class="material-symbols-outlined">check_circle</span>
                <span>{{ session('success') }}</span>
            </div>
            @endif
            @if($errors->any())
            <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-800 dark:text-red-200 px-4 py-3 rounded-lg">
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                </ul>
            </div>
            @endif

            {{-- Header row --}}
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div class="flex flex-col gap-1">
                    <h1 class="text-[#171511] dark:text-white text-3xl font-black leading-tight tracking-tight">All Shop Items</h1>
                    <p class="text-gray-500 dark:text-gray-400 text-base">Manage your shop catalogue, pricing and images.</p>
                </div>
                <div class="flex flex-wrap items-center gap-3">
                    <a href="{{ url('/admin_shop_categories') }}" class="flex items-center justify-center px-4 h-10 rounded-lg border border-[#e5e2dc] bg-white dark:bg-[#2c261a] dark:border-[#362f22] dark:text-white text-[#171511] text-sm font-medium hover:bg-gray-50 dark:hover:bg-[#362f22]/80 transition-colors">
                        <span class="material-symbols-outlined text-[18px] mr-1">category</span>
                        Categories
                    </a>
                    <a href="{{ url('/admin_shop_combos') }}" class="flex items-center justify-center px-4 h-10 rounded-lg border border-[#e5e2dc] bg-white dark:bg-[#2c261a] dark:border-[#362f22] dark:text-white text-[#171511] text-sm font-medium hover:bg-gray-50 dark:hover:bg-[#362f22]/80 transition-colors">
                        <span class="material-symbols-outlined text-[18px] mr-1">redeem</span>
                        Combos
                    </a>
                    <a href="{{ url('/admin_shop/add') }}" class="flex items-center justify-center px-4 h-10 rounded-lg bg-[#DA70D6] text-white text-sm font-bold shadow-md hover:opacity-90 transition-opacity">
                        <span class="material-symbols-outlined text-[20px] mr-2">add</span>
                        Add Item
                    </a>
                </div>
            </div>

            {{-- Table --}}
            <div class="bg-white dark:bg-[#2a2415] rounded-xl border border-gray-100 dark:border-gray-800 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm adminTables">
                        <thead class="bg-gray-50 dark:bg-[#332c20] text-gray-500 dark:text-gray-400 uppercase font-bold text-xs">
                            <tr>
                                <th class="px-6 py-4">Item</th>
                                <th class="px-6 py-4">Category</th>
                                <th class="px-6 py-4">Price</th>
                                <th class="px-6 py-4">Discount</th>
                                <th class="px-6 py-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                            @forelse ($data['products'] as $product)
                            <tr class="group hover:bg-primary/5 dark:hover:bg-white/5 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        <div class="w-14 h-14 rounded-lg bg-gray-100 dark:bg-gray-800 overflow-hidden shrink-0 flex items-center justify-center">
                                            @if($product->image)
                                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                            @else
                                                <span class="material-symbols-outlined text-gray-400 text-2xl">image</span>
                                            @endif
                                        </div>
                                        <div>
                                            <p class="font-bold text-[#171511] dark:text-white text-sm group-hover:text-brand-orchid transition-colors">{{ $product->name }}</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">ID: #{{ $product->id }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-orange-100 text-orange-700 dark:bg-orange-900/30 dark:text-orange-300">
                                        <span class="w-1.5 h-1.5 rounded-full bg-orange-500"></span>
                                        {{ $product->category_name }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 font-semibold text-[#171511] dark:text-white">
                                    KES {{ number_format($product->price, 2) }}
                                </td>
                                <td class="px-6 py-4">
                                    @if($product->discount_percentage > 0)
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-bold bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-300">
                                            {{ $product->discount_percentage }}% OFF
                                        </span>
                                    @else
                                        <span class="text-gray-400 text-xs">—</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ url('/admin_shop/edit/'.$product->id) }}" class="p-1.5 text-gray-400 hover:text-brand-orchid hover:bg-brand-orchid/10 rounded-md transition-colors" title="Edit">
                                            <span class="material-symbols-outlined text-lg">edit</span>
                                        </a>
                                        <form action="{{ url('/admin_shop/delete/'.$product->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-1.5 text-gray-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-md transition-colors show_confirm" title="Delete">
                                                <span class="material-symbols-outlined text-lg">delete</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-16 text-center text-gray-400">
                                    <span class="material-symbols-outlined text-4xl mb-2 block">inventory_2</span>
                                    No shop items found. <a href="{{ url('/admin_shop/add') }}" class="text-brand-orchid hover:underline">Add the first one.</a>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
@section('scripts')
@endsection
