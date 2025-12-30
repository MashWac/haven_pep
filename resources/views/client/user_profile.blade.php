@extends('layouts.client')
@section('headers')
<style>
    [x-cloak] {
        display: none !important;
    }
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
                    <a href="{{url('logout')}}" class="flex items-center gap-2 px-4 py-2 rounded-lg border border-red-500/30 text-red-500 hover:bg-red-500/10 transition-colors">
                        <span class="material-symbols-outlined text-sm">logout</span> Log Out
                    </a>
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
                    <section class="space-y-12">
                        <div>
                            <h3 class="text-2xl font-bold mb-6 flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary">auto_stories</span> My Library
                            </h3>

                            <div class="mb-10">
                                <h4 class="text-sm font-bold uppercase tracking-widest text-[#b5a1b4] mb-4 flex items-center gap-2">
                                    <span class="w-8 h-[1px] bg-border-dark"></span> Active Courses
                                </h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    @forelse($myCourses as $item)
                                    <div class="bg-surface-dark border border-border-dark rounded-xl p-4 flex gap-4 hover:border-secondary/50 transition-all group">
                                        <div class="w-24 h-24 bg-cover bg-center rounded-lg shrink-0 shadow-lg" style="background-image: url('{{ $item->course->cover_image ?? asset('default-course.jpg') }}')"></div>
                                        <div class="flex flex-col justify-between py-1">
                                            <div>
                                                <h5 class="text-white font-bold leading-tight line-clamp-1">{{ $item->course->title ?? 'Course Title' }}</h5>
                                                <p class="text-xs text-[#b5a1b4] mt-1">Purchased on {{ $item->created_at->format('M d, Y') }}</p>
                                            </div>
                                            <a href="{{ url('/courses/continue/'.$item->item_id) }}" class="inline-flex items-center gap-2 text-secondary text-sm font-bold hover:gap-3 transition-all">
                                                Continue Learning <span class="material-symbols-outlined text-sm">arrow_forward</span>
                                            </a>
                                        </div>
                                    </div>
                                    @empty
                                    <p class="text-[#b5a1b4] text-sm italic">No courses purchased yet.</p>
                                    @endforelse
                                </div>
                            </div>

                            <div>
                                <h4 class="text-sm font-bold uppercase tracking-widest text-[#b5a1b4] mb-4 flex items-center gap-2">
                                    <span class="w-8 h-[1px] bg-border-dark"></span> My E-Books
                                </h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                    @forelse($myBooks as $item)
                                    <div class="bg-surface-dark border border-border-dark rounded-xl p-5 hover:border-primary/50 transition-all group relative overflow-hidden">
                                        <div class="absolute -right-4 -top-4 w-20 h-20 bg-primary/5 blur-3xl rounded-full"></div>

                                        <div class="flex gap-4">
                                            <div class="w-16 h-20 bg-cover bg-center rounded shadow-md group-hover:scale-105 transition-transform" style="background-image: url('{{ $item->book->image ?? asset('default-book.jpg') }}')"></div>
                                            <div class="flex flex-col justify-center">
                                                <h5 class="text-white font-bold text-sm leading-tight">{{ $item->book->title ?? 'Book Title' }}</h5>
                                                <p class="text-[10px] text-tertiary font-bold uppercase mt-1">{{ $item->book->author ?? 'Wellness Author' }}</p>
                                            </div>
                                        </div>

                                        <a href="" class="mt-4 w-full bg-background-dark border border-border-dark hover:border-primary text-white py-2 rounded-lg text-xs font-bold flex items-center justify-center gap-2 transition-all">
                                            <span class="material-symbols-outlined text-sm text-primary">download</span>
                                            Download PDF
                                        </a>
                                    </div>
                                    @empty
                                    <p class="text-[#b5a1b4] text-sm italic">No books in your library.</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </section>

                    <section>
                        <h3 class="text-2xl font-bold mb-6 flex items-center gap-2">
                            <span class="material-symbols-outlined text-red-400">favorite</span> Wishlist
                        </h3>

                    </section>
                </div>

                <div x-show="activeTab === 'orders'" x-cloak class="space-y-6">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                        <h3 class="text-2xl font-bold">Order History</h3>
                        <span class="px-3 py-1 bg-primary/10 text-primary text-xs font-bold rounded-full uppercase tracking-widest">
                            {{ count($orders) }} Total Purchases
                        </span>
                    </div>

                    <div class="bg-surface-dark border border-border-dark rounded-xl overflow-hidden shadow-xl">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-background-dark/50 border-b border-border-dark">
                                        <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-[#b5a1b4]">Receipt #</th>
                                        <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-[#b5a1b4]">Date</th>
                                        <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-[#b5a1b4]">Items</th>
                                        <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-[#b5a1b4]">Amount</th>
                                        <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-[#b5a1b4]">Status</th>
                                        <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-[#b5a1b4] text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-border-dark/50">
                                    @forelse($orders as $order)
                                    <tr class="hover:bg-white/[0.02] transition-colors group">
                                        <td class="px-6 py-4 font-mono text-sm text-white">{{ $order->receipt_number }}</td>
                                        <td class="px-6 py-4 text-sm text-[#b5a1b4]">{{ $order->created_at->format('M d, Y') }}</td>
                                        <td class="px-6 py-4 text-sm text-[#b5a1b4]">{{ $order->number_of_items }} items</td>
                                        <td class="px-6 py-4 font-bold text-white">${{ number_format($order->total_price, 2) }}</td>
                                        <td class="px-6 py-4">
                                            <span class="px-2 py-1 rounded text-[10px] font-bold uppercase {{ $order->status_payment === 'Completed' ? 'bg-green-400/10 text-green-400' : 'bg-yellow-400/10 text-yellow-400' }}">
                                                {{ $order->status_payment }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <a href="{{ url('/orders/receipt/'.$order->id) }}"
                                                class="inline-flex items-center gap-2 px-3 py-1.5 bg-background-dark border border-border-dark rounded-lg text-xs font-bold text-white hover:border-primary hover:text-primary transition-all group-hover:shadow-[0_0_10px_rgba(218,113,215,0.2)]">
                                                <span class="material-symbols-outlined text-sm">download</span>
                                                Receipt
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-20 text-center">
                                            <span class="material-symbols-outlined text-5xl text-border-dark mb-2">history</span>
                                            <p class="text-[#b5a1b4]">You haven't made any purchases yet.</p>
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
    </div>
</body>
@endsection
@section('scripts')

@endsection