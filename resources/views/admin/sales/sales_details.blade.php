@extends('layouts.admin')
@section('content')
<main class="flex-1 flex flex-col h-full relative overflow-y-auto bg-background-light dark:bg-background-dark">
    <div class="layout-container flex flex-col w-full max-w-[1200px] mx-auto px-6 py-8">
        <div class="flex flex-wrap gap-2 mb-6 items-center">
            <a class="text-[#877b64] hover:text-secondary text-sm font-medium leading-normal transition-colors" href="#">Home</a>
            <span class="material-symbols-outlined text-[#877b64] text-sm">chevron_right</span>
            <a class="text-[#877b64] hover:text-secondary text-sm font-medium leading-normal transition-colors" href="#">Sales</a>
            <span class="material-symbols-outlined text-[#877b64] text-sm">chevron_right</span>
            <span class="text-[#171511] dark:text-white text-sm font-medium leading-normal">#ORD-2023-892</span>
        </div>
        <div class="flex flex-wrap justify-between items-end gap-4 mb-8 sticky top-0 bg-background-light dark:bg-background-dark z-20 py-2 border-b border-transparent">
            <div class="flex flex-col gap-2">
                <div class="flex items-center gap-3">
                    <h1 class="text-[#171511] dark:text-white text-3xl font-black leading-tight tracking-tight">Sale #ORD-2023-892</h1>
                    <span class="px-3 py-1 bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400 rounded-full text-xs font-bold uppercase tracking-wider">Paid</span>
                </div>
                <p class="text-[#877b64] text-base font-normal">Transaction processed on Oct 24, 2023 at 10:42 AM</p>
            </div>
            <!-- <div class="flex gap-3">
                <button class="flex items-center justify-center px-4 h-10 rounded-lg border border-[#e5e2dc] bg-white dark:bg-[#2c261a] dark:border-[#362f22] dark:text-white text-[#171511] text-sm font-medium hover:bg-gray-50 dark:hover:bg-[#362f22]/80 transition-colors">
                    <span class="material-symbols-outlined text-[18px] mr-2 text-tertiary">mail</span>
                    Email Buyer
                </button>
                <button class="flex items-center justify-center px-4 h-10 rounded-lg border border-[#e5e2dc] bg-white dark:bg-[#2c261a] dark:border-[#362f22] dark:text-white text-[#171511] text-sm font-medium hover:bg-gray-50 dark:hover:bg-[#362f22]/80 transition-colors">
                    <span class="material-symbols-outlined text-[18px] mr-2 text-tertiary">download</span>
                    Invoice
                </button>
                <button class="flex items-center justify-center px-4 h-10 rounded-lg bg-secondary text-white text-sm font-bold shadow-md hover:opacity-90 transition-opacity">
                    <span class="material-symbols-outlined text-[20px] mr-2">undo</span>
                    Refund Order
                </button>
            </div> -->
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 pb-12">
            <div class="lg:col-span-2 flex flex-col gap-6">
                <section class="bg-white dark:bg-[#2c261a] rounded-xl overflow-hidden shadow-sm border border-[#e5e2dc]/50 dark:border-[#362f22]">
                    <div class="p-6 border-b border-[#e5e2dc] dark:border-[#362f22]">
                        <h2 class="text-[#171511] dark:text-white text-lg font-bold flex items-center gap-2">
                            <span class="material-symbols-outlined text-tertiary">shopping_bag</span>
                            Items Purchased
                        </h2>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead class="bg-background-light dark:bg-[#362f22]/50">
                                <tr>
                                    <th class="p-4 text-xs font-bold text-[#877b64] uppercase tracking-wider">Item Details</th>
                                    <th class="p-4 text-xs font-bold text-[#877b64] uppercase tracking-wider text-center">Type</th>
                                    <th class="p-4 text-xs font-bold text-[#877b64] uppercase tracking-wider text-right">Price</th>
                                    <th class="p-4 text-xs font-bold text-[#877b64] uppercase tracking-wider text-right">Quantity</th>
                                    <th class="p-4 text-xs font-bold text-[#877b64] uppercase tracking-wider text-right">Total Amount</th>

                                </tr>
                            </thead>
                            <tbody class="divide-y divide-[#e5e2dc] dark:divide-[#362f22]">
                                @foreach($data['sales_details'] as $item)
                                @if($item->item_type=='book')
                                <tr class="group hover:bg-background-light dark:hover:bg-[#362f22]/30 transition-colors">
                                    <td class="p-4">
                                        <div class="flex items-center gap-4">
                                            <div class="w-12 h-16 bg-primary/30 rounded flex items-center justify-center shrink-0">
                                                <span class="material-symbols-outlined text-secondary/70">menu_book</span>
                                            </div>
                                            <div class="flex flex-col">
                                                <span class="text-[#171511] dark:text-white font-bold text-sm">{{$item->display_name?? 'Product ID: '.$item->item_id }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-4 text-center">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-tertiary/10 text-tertiary">
                                            E-Book
                                        </span>
                                    </td>
                                    <td class="p-4 text-right text-[#171511] dark:text-white font-medium">{{ number_format($item->price, 2) }}</td>
                                    <td class="p-4 text-right text-[#171511] dark:text-white font-medium">{{ $item->quantity }}</td>
                                    <td class="p-4 text-right text-[#171511] dark:text-white font-medium">{{ number_format($item->price * $item->quantity, 2) }}</td>


                                </tr>
                                @else
                                <tr class="group hover:bg-background-light dark:hover:bg-[#362f22]/30 transition-colors">
                                    <td class="p-4">
                                        <div class="flex items-center gap-4">
                                            <div class="w-12 h-16 bg-primary/30 rounded flex items-center justify-center shrink-0">
                                                <span class="material-symbols-outlined text-secondary/70">video_library</span>
                                            </div>
                                            <div class="flex flex-col">
                                                <span class="text-[#171511] dark:text-white font-bold text-sm">{{$item->display_name?? 'Product ID: '.$item->item_id }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-4 text-center">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-300">
                                            Course
                                        </span>
                                    </td>
                                    <td class="p-4 text-right text-[#171511] dark:text-white font-medium">{{ number_format($item->price, 2) }}</td>
                                    <td class="p-4 text-right text-[#171511] dark:text-white font-medium">{{ $item->quantity }}</td>
                                    <td class="p-4 text-right text-[#171511] dark:text-white font-medium">{{ number_format($item->price * $item->quantity, 2) }}</td>
                                </tr>
                                @endif
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
            <div class="flex flex-col gap-6">
                <section class="bg-white dark:bg-[#2c261a] rounded-xl p-6 shadow-sm border border-[#e5e2dc]/50 dark:border-[#362f22]">
                    <h2 class="text-[#171511] dark:text-white text-lg font-bold mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-tertiary">person</span>
                        Buyer Details
                    </h2>
                    <div class="flex flex-col items-center mb-6">
                        <div class="w-20 h-20 rounded-full bg-gray-200 mb-3 overflow-hidden border-2 border-primary">
                            <div class="w-full h-full flex items-center justify-center bg-primary text-[#171511]">
                                <span class="material-symbols-outlined text-4xl opacity-50">person</span>
                            </div>
                        </div>
                        <h3 class="text-[#171511] dark:text-white text-lg font-bold">{{$data['user_sales']->full_name}}</h3>
                        <p class="text-[#877b64] text-sm">Member since {{$data['user_sales']->created_at}}</p>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-start gap-3 p-3 bg-background-light dark:bg-[#362f22] rounded-lg">
                            <span class="material-symbols-outlined text-[#877b64] text-[20px] mt-0.5">mail</span>
                            <div class="flex flex-col">
                                <span class="text-xs text-[#877b64]">Email Address</span>
                                <a class="text-sm font-medium text-secondary hover:underline break-all" href="#">{{$data['user_sales']->email_address}}</a>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 p-3 bg-background-light dark:bg-[#362f22] rounded-lg">
                            <span class="material-symbols-outlined text-[#877b64] text-[20px] mt-0.5">phone</span>
                            <div class="flex flex-col">
                                <span class="text-xs text-[#877b64]">Phone</span>
                                <span class="text-sm font-medium text-[#171511] dark:text-white">{{$data['user_sales']->phone_number}}</span>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="bg-white dark:bg-[#2c261a] rounded-xl p-6 shadow-sm border border-[#e5e2dc]/50 dark:border-[#362f22]">
                    <h2 class="text-[#171511] dark:text-white text-lg font-bold mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-tertiary">calculate</span>
                        Order Summary
                    </h2>
                    <div class="flex flex-col gap-3 pb-4 border-b border-[#e5e2dc] dark:border-[#362f22] mb-4">
                        <div class="flex justify-between items-center">
                            <span class="text-[#877b64] text-sm">Number of Items</span>
                            <span class="text-[#171511] dark:text-white font-medium">{{$data['user_sales']->number_of_items}}</span>
                        </div>
                    </div>
                    <div class="flex justify-between items-center mb-6">
                        <span class="text-[#171511] dark:text-white text-lg font-bold">Total Paid</span>
                        <span class="text-2xl font-black text-secondary">{{$data['user_sales']->total_sales}}</span>
                    </div>
                    <div class="bg-background-light dark:bg-[#362f22] p-4 rounded-lg border border-[#e5e2dc] dark:border-[#4a402e]">
                        <div class="flex items-center gap-3 mb-2">
                            <span class="material-symbols-outlined text-tertiary">credit_card</span>
                            <span class="text-[#171511] dark:text-white font-bold text-sm">Payment Method</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <div class="flex items-center gap-2">
                                <span class="text-sm text-[#171511] dark:text-gray-300">{{$data['user_sales']->delivery_method}}</span>
                            </div>
                            <!-- <span class="text-xs text-[#877b64]">Exp 12/25</span> -->
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</main>
@endsection
@section('scripts')
@endsection