@extends('layouts.client')
@section('headers')
<style>
        [x-cloak] { display: none !important; }
    </style>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endsection
@section('content')
<body class="bg-background-light dark:bg-background-dark font-display text-slate-900 dark:text-white antialiased overflow-x-hidden" x-data="{ activeTab: 'info' }">
    
    @include('layouts.include.dark_header')

    <div class="min-h-screen w-full">
        <main class="flex-1 flex flex-col min-w-0">
            <div class="px-6 md:px-12 py-8 max-w-7xl mx-auto w-full">
                
                <div class="flex flex-col gap-6 md:flex-row md:items-center justify-between p-6 rounded-2xl bg-white dark:bg-surface-dark shadow-sm border border-slate-200 dark:border-slate-800 mb-8">
                    <div class="flex items-center gap-6">
                        <div class="relative">
                            <div class="bg-center bg-no-repeat bg-cover rounded-full h-24 w-24 ring-4 ring-primary/20" style='background-image: url("https://i.pravatar.cc/150?u=7");'></div>
                            <div class="absolute bottom-0 right-0 h-6 w-6 bg-secondary rounded-full border-4 border-white dark:border-surface-dark flex items-center justify-center">
                                <span class="material-symbols-outlined text-white text-[12px] font-bold">check</span>
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <h2 class="text-2xl md:text-3xl font-bold text-slate-900 dark:text-white">{{ $user_data->full_name }}</h2>
                            <p class="text-slate-500 dark:text-text-subtle text-sm mt-1">Member since {{ $user_data->created_at->format('F Y') }}</p>
                        </div>
                    </div>
                    <button class="flex items-center gap-2 px-4 py-2 rounded-lg border border-red-500/30 text-red-500 hover:bg-red-500/10 transition-colors">
                        <span class="material-symbols-outlined text-sm">logout</span> Log Out
                    </button>
                </div>

                <div class="border-b border-slate-200 dark:border-slate-800 mb-8 overflow-x-auto">
                    <div class="flex gap-8 min-w-max">
                        <button @click="activeTab = 'info'" :class="activeTab === 'info' ? 'border-primary text-primary' : 'border-transparent text-slate-500'" class="flex flex-col items-center justify-center border-b-[3px] pb-3 px-1 transition-all">
                            <p class="text-sm font-bold tracking-wide">Personal Info</p>
                        </button>
                        <button @click="activeTab = 'activity'" :class="activeTab === 'activity' ? 'border-primary text-primary' : 'border-transparent text-slate-500'" class="flex flex-col items-center justify-center border-b-[3px] pb-3 px-1 transition-all">
                            <p class="text-sm font-bold tracking-wide">My Activity</p>
                        </button>
                        <button @click="activeTab = 'orders'" :class="activeTab === 'orders' ? 'border-primary text-primary' : 'border-transparent text-slate-500'" class="flex flex-col items-center justify-center border-b-[3px] pb-3 px-1 transition-all">
                            <p class="text-sm font-bold tracking-wide">Order History</p>
                        </button>
                    </div>
                </div>

                <div x-show="activeTab === 'info'" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <div class="lg:col-span-2 space-y-8">
                        <section class="bg-white dark:bg-surface-dark rounded-xl p-6 shadow-sm border border-slate-200 dark:border-slate-800">
                            <h3 class="text-xl font-bold mb-6">Basic Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <label class="flex flex-col gap-2">
                                    <span class="text-sm font-medium">Name</span>
                                    <input class="w-full h-12 px-4 rounded-lg bg-slate-50 dark:bg-background-dark border border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-primary outline-none" type="text" value="{{ $user_data->full_name }}" />
                                </label>
                                <label class="flex flex-col gap-2">
                                    <span class="text-sm font-medium">Email Address</span>
                                    <input class="w-full h-12 px-4 rounded-lg bg-slate-50 dark:bg-background-dark border border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-primary outline-none" type="email" value="{{ $user_data->email_address }}" />
                                </label>
                            </div>
                            <div class="mt-8 flex justify-end">
                                <button class="px-6 py-2.5 rounded-lg bg-primary text-white font-bold">Save Changes</button>
                            </div>
                        </section>
                    </div>
                </div>

                <div x-show="activeTab === 'activity'" x-cloak class="space-y-10">
                    <section>
                        <h3 class="text-2xl font-bold mb-6 flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">auto_stories</span> My Library
                        </h3>
              
                    </section>

                    <section>
                        <h3 class="text-2xl font-bold mb-6 flex items-center gap-2">
                            <span class="material-symbols-outlined text-red-400">favorite</span> Wishlist
                        </h3>
                       
                    </section>
                </div>

                <div x-show="activeTab === 'orders'" x-cloak class="space-y-6">
                    <h3 class="text-2xl font-bold mb-6">Order History</h3>

                </div>

            </div>
        </main>
    </div>
</body>
@endsection
@section('scripts') 

@endsection