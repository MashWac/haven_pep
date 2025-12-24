@extends('layouts.admin')
@section('content')
<main class="flex-1 flex flex-col h-full overflow-hidden bg-background-light dark:bg-background-dark relative">
    <header class="flex items-center justify-between whitespace-nowrap border-b border-[#e5e2dc] dark:border-gray-800 bg-white dark:bg-[#1f1a12] px-8 py-4 z-10">
        <div class="flex items-center gap-4 text-[#171511] dark:text-white">
            <span class="material-symbols-outlined text-brand-teal text-3xl">grid_view</span>
            <h2 class="text-xl font-bold leading-tight tracking-tight">Book Category Management</h2>
        </div>
        <div class="flex items-center gap-4">
            <button class="flex items-center justify-center p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                <span class="material-symbols-outlined text-gray-500 dark:text-gray-400">notifications</span>
            </button>
            <button class="flex items-center gap-2 px-4 py-2 rounded-lg border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800 transition-all">
                <span class="material-symbols-outlined text-gray-500 text-[20px]">help</span>
                <span class="text-sm font-medium text-gray-600 dark:text-gray-300">Help</span>
            </button>
        </div>
    </header>
    <div class="flex-1 overflow-y-auto p-8">
        <div class="max-w-7xl mx-auto flex flex-col gap-8">
            <div class="flex flex-wrap items-center gap-2">
                <a class="text-gray-500 hover:text-brand-orchid transition-colors text-sm font-medium" href="#">Home</a>
                <span class="material-symbols-outlined text-gray-400 text-sm">chevron_right</span>
                <a class="text-gray-500 hover:text-brand-orchid transition-colors text-sm font-medium" href="{{ url('/admin_books') }}">Books</a>
                <span class="material-symbols-outlined text-gray-400 text-sm">chevron_right</span>
                <span class="text-[#171511] dark:text-white text-sm font-bold bg-primary/30 dark:bg-primary/10 px-2 py-0.5 rounded text-brand-orchid">All Book Categories</span>
            </div>
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div class="flex flex-col gap-1">
                    <h1 class="text-[#171511] dark:text-white text-3xl font-black leading-tight tracking-tight">All Books</h1>
                    <p class="text-gray-500 dark:text-gray-400 text-base">Manage your catalogue, track enrollment, and update content.</p>
                </div>
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <a href="{{ url('/add_book_category') }}" class="flex items-center justify-center px-4 h-10 rounded-lg bg-[#DA70D6] text-white text-sm font-bold shadow-md hover:opacity-90 transition-opacity">
                        <span class="material-symbols-outlined text-[20px] mr-2">add</span>
                        Add Book Category
                    </a>
                </div>
            </div>
            <!-- Success Message -->
            @if(session('success'))
            <div class="mb-6 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-800 dark:text-green-200 px-4 py-3 rounded-lg flex items-center gap-2">
                <span class="material-symbols-outlined">check_circle</span>
                <span>{{ session('success') }}</span>
            </div>
            @endif

            <!-- Error Messages -->
            @if($errors->any())
            <div class="mb-6 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-800 dark:text-red-200 px-4 py-3 rounded-lg">
                <div class="flex items-center gap-2 mb-2">
                    <span class="material-symbols-outlined">error</span>
                    <span class="font-bold">Please correct the following errors:</span>
                </div>
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="bg-white dark:bg-[#2a2415] rounded-xl border border-gray-100 dark:border-gray-800 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm adminTables">
                        <thead class="bg-gray-50 dark:bg-[#332c20] text-gray-500 dark:text-gray-400 uppercase font-bold text-xs">
                            <tr>
                                <th class="px-6 py-4">Category</th>
                                <th class="px-6 py-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                            @foreach($data['book_categories'] as $category)
                            <tr class="group hover:bg-primary/5 dark:hover:bg-white/5 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        <div>
                                            <p class="font-bold text-[#171511] dark:text-white text-sm group-hover:text-brand-orchid transition-colors">{{ $category->category_name }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{url('/admin_book_categories/edit/'. $category->id)}}" class="p-1.5 text-gray-400 hover:text-brand-orchid hover:bg-brand-orchid/10 rounded-md transition-colors" title="Edit">
                                            <span class="material-symbols-outlined text-lg">edit</span>
                                        </a>
                                        <form action="{{ url('/admin_book_categories/delete/' . $category->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-1.5 text-gray-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-md transition-colors show_confirm" title="Delete">
                                                <span class="material-symbols-outlined text-lg">delete</span>
                                            </button>
                                        </form>

                                        <button class="p-1.5 text-gray-400 hover:text-brand-teal hover:bg-brand-teal/10 rounded-md transition-colors" title="View Analytics">
                                            <span class="material-symbols-outlined text-lg">bar_chart</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach

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