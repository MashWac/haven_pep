@extends('layouts.admin')
@section('content')
<main class="flex-1 flex flex-col h-full overflow-y-auto overflow-x-hidden relative">
    <div class="flex-1 p-4 md:p-8 lg:p-12 max-w-[1400px] mx-auto w-full">
        <!-- Page Heading -->
        <header class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <div>
                <h2 class="text-3xl md:text-4xl font-black tracking-tight text-[#171511] dark:text-white">Dashboard</h2>
                <p class="text-gray-500 dark:text-gray-400 mt-1">Monitor revenue, subscriptions, and financial health.</p>
            </div>
        </header>
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <!-- Card 1 -->
            <div class="p-5 rounded-xl bg-white dark:bg-surface-dark shadow-[0_2px_8px_rgba(0,0,0,0.04)] dark:shadow-none border border-transparent dark:border-neutral-700 flex flex-col gap-3">
                <div class="flex justify-between items-start">
                    <p class="text-gray-500 dark:text-gray-400 text-sm font-medium">Total Revenue</p>
                    <div class="p-1.5 rounded-full bg-secondary/10 text-secondary">
                        <span class="material-symbols-outlined text-[20px] filled">payments</span>
                    </div>
                </div>
                <div>
                    <p class="text-2xl font-bold tracking-tight text-[#171511] dark:text-white">USD{{$total_sales}}</p>
                    <!-- <div class="flex items-center gap-1 mt-1 text-tertiary">
                                <span class="material-symbols-outlined text-[16px]">trending_up</span>
                                <span class="text-xs font-bold">+12% from last month</span>
                            </div> -->
                </div>
            </div>
            <!-- Card 2 -->
            <div class="p-5 rounded-xl bg-white dark:bg-surface-dark shadow-[0_2px_8px_rgba(0,0,0,0.04)] dark:shadow-none border border-transparent dark:border-neutral-700 flex flex-col gap-3">
                <div class="flex justify-between items-start">
                    <p class="text-gray-500 dark:text-gray-400 text-sm font-medium">Active Subscriptions</p>
                    <div class="p-1.5 rounded-full bg-tertiary/10 text-tertiary">
                        <span class="material-symbols-outlined text-[20px]">loyalty</span>
                    </div>
                </div>
                <div>
                    <p class="text-2xl font-bold tracking-tight text-[#171511] dark:text-white">Users: {{$user_count}}</p>
                    <!-- <div class="flex items-center gap-1 mt-1 text-tertiary">
                                <span class="material-symbols-outlined text-[16px]">trending_up</span>
                                <span class="text-xs font-bold">+5% new members</span>
                            </div> -->
                </div>
            </div>
            <!-- Card 3 -->
            <div class="p-5 rounded-xl bg-white dark:bg-surface-dark shadow-[0_2px_8px_rgba(0,0,0,0.04)] dark:shadow-none border border-transparent dark:border-neutral-700 flex flex-col gap-3">
                <div class="flex justify-between items-start">
                    <p class="text-gray-500 dark:text-gray-400 text-sm font-medium">Course Sales</p>
                    <div class="p-1.5 rounded-full bg-primary/50 text-orange-800">
                        <span class="material-symbols-outlined text-[20px]">local_library</span>
                    </div>
                </div>
                <div>
                    <p class="text-2xl font-bold tracking-tight text-[#171511] dark:text-white">{{$courses_count}}</p>
                    <!-- <div class="flex items-center gap-1 mt-1 text-tertiary">
                                <span class="material-symbols-outlined text-[16px]">trending_up</span>
                                <span class="text-xs font-bold">+8% increase</span>
                            </div> -->
                </div>
            </div>
            <!-- Card 4 -->
            <div class="p-5 rounded-xl bg-white dark:bg-surface-dark shadow-[0_2px_8px_rgba(0,0,0,0.04)] dark:shadow-none border border-transparent dark:border-neutral-700 flex flex-col gap-3">
                <div class="flex justify-between items-start">
                    <p class="text-gray-500 dark:text-gray-400 text-sm font-medium">Books</p>
                    <div class="p-1.5 rounded-full bg-gray-100 dark:bg-neutral-700 text-gray-600 dark:text-gray-300">
                        <span class="material-symbols-outlined text-[20px]">book</span>
                    </div>
                </div>
                <div>
                    <p class="text-2xl font-bold tracking-tight text-[#171511] dark:text-white">{{$books_count}}</p>
                    <!-- <div class="flex items-center gap-1 mt-1 text-gray-500">
                                <span class="material-symbols-outlined text-[16px]">remove</span>
                                <span class="text-xs font-bold">No change</span>
                            </div> -->
                </div>
            </div>
        </div>
        <!-- Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            <!-- Main Line Chart -->
            <div class="lg:col-span-2 rounded-xl bg-white dark:bg-surface-dark shadow-sm border border-transparent dark:border-neutral-700 p-6">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                    <div>
                        <h3 class="text-lg font-bold text-[#171511] dark:text-white">Visitor Activity</h3>
                        <p class="text-sm text-gray-500">Unique visitors per period</p>
                    </div>
                    <div class="flex bg-gray-100 dark:bg-neutral-800 p-1 rounded-lg">
                        <button onclick="updateChart('daily', this)" class="visitor-filter-btn px-4 py-1.5 text-xs font-bold rounded-md transition-all bg-white dark:bg-neutral-700 shadow-sm text-secondary">Daily</button>
                        <button onclick="updateChart('weekly', this)" class="visitor-filter-btn px-4 py-1.5 text-xs font-bold rounded-md transition-all text-gray-500 hover:text-gray-700 dark:hover:text-gray-300">Weekly</button>
                        <button onclick="updateChart('monthly', this)" class="visitor-filter-btn px-4 py-1.5 text-xs font-bold rounded-md transition-all text-gray-500 hover:text-gray-700 dark:hover:text-gray-300">Monthly</button>
                    </div>
                </div>
                <div class="relative w-full aspect-[2/1] min-h-[250px]">
                    <canvas id="visitorChart"></canvas>
                </div>
            </div>
            <!-- Donut/Bar Chart Sidebar -->
            {{--<div class="rounded-xl bg-white dark:bg-surface-dark shadow-sm border border-transparent dark:border-neutral-700 p-6 flex flex-col">
                        <div class="mb-6">
                            <h3 class="text-lg font-bold text-[#171511] dark:text-white">Revenue by Category</h3>
                            <p class="text-sm text-gray-500">Breakdown of earnings</p>
                        </div>
                        <div class="flex-1 flex flex-col justify-center gap-6">
                            <!-- Item 1 -->
                            <div class="flex flex-col gap-2">
                                <div class="flex justify-between text-sm font-bold text-gray-700 dark:text-gray-200">
                                    <span>Yoga Classes</span>
                                    <span>$22,400</span>
                                </div>
                                <div class="w-full h-3 bg-gray-100 dark:bg-neutral-800 rounded-full overflow-hidden">
                                    <div class="h-full bg-secondary rounded-full" style="width: 55%"></div>
                                </div>
                            </div>
                            <!-- Item 2 -->
                            <div class="flex flex-col gap-2">
                                <div class="flex justify-between text-sm font-bold text-gray-700 dark:text-gray-200">
                                    <span>Meditation Apps</span>
                                    <span>$14,200</span>
                                </div>
                                <div class="w-full h-3 bg-gray-100 dark:bg-neutral-800 rounded-full overflow-hidden">
                                    <div class="h-full bg-tertiary rounded-full" style="width: 30%"></div>
                                </div>
                            </div>
                            <!-- Item 3 -->
                            <div class="flex flex-col gap-2">
                                <div class="flex justify-between text-sm font-bold text-gray-700 dark:text-gray-200">
                                    <span>Nutritional Plans</span>
                                    <span>$8,600</span>
                                </div>
                                <div class="w-full h-3 bg-gray-100 dark:bg-neutral-800 rounded-full overflow-hidden">
                                    <div class="h-full bg-primary rounded-full" style="width: 15%"></div>
                                </div>
                            </div>
                        </div>
                    </div>--}}
        </div>
        <!-- Recent Transactions Table -->
        <div class="rounded-xl bg-white dark:bg-surface-dark shadow-sm border border-transparent dark:border-neutral-700 overflow-hidden">
            <div class="flex items-center justify-between p-6 border-b border-gray-100 dark:border-neutral-700">
                <h3 class="text-lg font-bold text-[#171511] dark:text-white">Recent Transactions</h3>
                <button class="text-secondary text-sm font-bold hover:underline">View All</button>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-background-light dark:bg-neutral-800 text-xs uppercase text-gray-500 font-bold tracking-wider">
                            <th class="px-6 py-4">Order ID</th>
                            <th class="px-6 py-4">Customer</th>
                            <th class="px-6 py-4">Date</th>
                            <th class="px-6 py-4">Amount</th>
                            <th class="px-6 py-4 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-neutral-700 text-sm">
                        <!-- Row 1 -->
                        @foreach($recent_sales as $item)
                        <tr class="hover:bg-primary/10 dark:hover:bg-neutral-700/50 transition-colors group">
                            <td class="px-6 py-4 font-mono text-gray-500">{{$item->transaction_reference}}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <span class="font-bold text-[#171511] dark:text-gray-200">{{$item->full_name}}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-gray-500">{{$item->created_at}}</td>
                            <td class="px-6 py-4 font-bold text-[#171511] dark:text-white">{{$item->total_price}}</td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{url('/admin_sales/details/'. $item->id)}}" class="text-gray-400 hover:text-secondary transition-colors">
                                    <span class="material-symbols-outlined text-[20px]">visibility</span>
                                </a>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    let visitorChart;

    function initChart(labels, data) {
        const ctx = document.getElementById('visitorChart').getContext('2d');
        
        if (visitorChart) {
            visitorChart.destroy();
        }

        visitorChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Visitors',
                    data: data,
                    borderColor: '#DA70D6',
                    backgroundColor: 'rgba(218, 112, 214, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointRadius: 4,
                    pointBackgroundColor: '#DA70D6',
                    pointBorderColor: '#fff',
                    pointHoverRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                        backgroundColor: '#1a160e',
                        titleFont: { family: 'Manrope', size: 13 },
                        bodyFont: { family: 'Manrope', size: 12 },
                        padding: 12,
                        cornerRadius: 8
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(0,0,0,0.05)', drawBorder: false },
                        ticks: { font: { family: 'Manrope', size: 11 }, color: '#877b64', stepSize: 1 }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { font: { family: 'Manrope', size: 11 }, color: '#877b64' }
                    }
                },
                interaction: {
                    mode: 'nearest',
                    axis: 'x',
                    intersect: false
                }
            }
        });
    }

    async function updateChart(filter, btnElement) {
        document.querySelectorAll('.visitor-filter-btn').forEach(btn => {
            btn.classList.remove('bg-white', 'dark:bg-neutral-700', 'shadow-sm', 'text-secondary');
            btn.classList.add('text-gray-500', 'hover:text-gray-700', 'dark:hover:text-gray-300');
        });
        
        if (btnElement) {
            btnElement.classList.remove('text-gray-500', 'hover:text-gray-700', 'dark:hover:text-gray-300');
            btnElement.classList.add('bg-white', 'dark:bg-neutral-700', 'shadow-sm', 'text-secondary');
        }

        try {
            const response = await fetch(`{{ url('/admin_visitor_stats') }}?filter=${filter}`);
            const data = await response.json();
            initChart(data.labels, data.data);
        } catch (error) {
            console.error('Error fetching visitor stats:', error);
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        updateChart('daily');
    });
</script>
@endsection