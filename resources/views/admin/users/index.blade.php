@extends('layouts.admin')
@section('content')
<main class="flex-1 flex flex-col h-full overflow-hidden bg-background-light dark:bg-background-dark relative">
    <header class="flex items-center justify-between whitespace-nowrap border-b border-[#e5e2dc] dark:border-gray-800 bg-white dark:bg-[#1f1a12] px-8 py-4 z-10">
        <div class="flex items-center gap-4 text-[#171511] dark:text-white">
            <span class="material-symbols-outlined text-brand-teal text-3xl">grid_view</span>
            <h2 class="text-xl font-bold leading-tight tracking-tight">Course Management</h2>
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
                <a class="text-gray-500 hover:text-brand-orchid transition-colors text-sm font-medium" href="#">Courses</a>
                <span class="material-symbols-outlined text-gray-400 text-sm">chevron_right</span>
                <span class="text-[#171511] dark:text-white text-sm font-bold bg-primary/30 dark:bg-primary/10 px-2 py-0.5 rounded text-brand-orchid">All Courses</span>
            </div>
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div class="flex flex-col gap-1">
                    <h1 class="text-[#171511] dark:text-white text-3xl font-black leading-tight tracking-tight">All Courses</h1>
                    <p class="text-gray-500 dark:text-gray-400 text-base">Manage your catalogue, track enrollment, and update content.</p>
                </div>
                <button class="px-6 py-3 rounded-lg bg-brand-orchid text-white font-bold text-sm hover:bg-[#c55bc1] shadow-md hover:shadow-lg transition-all flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">add</span>
                    Create New Course
                </button>
            </div>
            <div class="bg-white dark:bg-[#2a2415] p-4 rounded-xl border border-gray-100 dark:border-gray-800 shadow-sm flex flex-col md:flex-row gap-4 items-center justify-between">
                <div class="relative w-full md:w-96">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-xl">search</span>
                    <input class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-sm focus:border-brand-orchid focus:ring-1 focus:ring-brand-orchid outline-none transition-all dark:text-white dark:placeholder-gray-500" placeholder="Search courses by title..." type="text" />
                </div>
                <div class="flex items-center gap-3 w-full md:w-auto overflow-x-auto pb-2 md:pb-0">
                    <div class="relative min-w-[140px]">
                        <select class="w-full appearance-none pl-3 pr-8 py-2.5 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm text-gray-700 dark:text-gray-200 focus:border-brand-orchid outline-none cursor-pointer">
                            <option>Category: All</option>
                            <option>Yoga</option>
                            <option>Meditation</option>
                            <option>Nutrition</option>
                        </select>
                        <span class="material-symbols-outlined absolute right-2 top-1/2 -translate-y-1/2 text-gray-500 pointer-events-none text-lg">expand_more</span>
                    </div>
                    <div class="relative min-w-[130px]">
                        <select class="w-full appearance-none pl-3 pr-8 py-2.5 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm text-gray-700 dark:text-gray-200 focus:border-brand-orchid outline-none cursor-pointer">
                            <option>Status: All</option>
                            <option>Published</option>
                            <option>Draft</option>
                            <option>Archived</option>
                        </select>
                        <span class="material-symbols-outlined absolute right-2 top-1/2 -translate-y-1/2 text-gray-500 pointer-events-none text-lg">expand_more</span>
                    </div>
                    <div class="flex items-center border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden bg-white dark:bg-gray-800">
                        <button class="p-2.5 bg-gray-100 dark:bg-gray-700 text-brand-orchid">
                            <span class="material-symbols-outlined text-xl">list</span>
                        </button>
                        <button class="p-2.5 hover:bg-gray-50 dark:hover:bg-gray-700 text-gray-400 dark:text-gray-500">
                            <span class="material-symbols-outlined text-xl">grid_view</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="bg-white dark:bg-[#2a2415] rounded-xl border border-gray-100 dark:border-gray-800 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead class="bg-gray-50 dark:bg-[#332c20] text-gray-500 dark:text-gray-400 uppercase font-bold text-xs">
                            <tr>
                                <th class="px-6 py-4">Course Name</th>
                                <th class="px-6 py-4">Category</th>
                                <th class="px-6 py-4">Instructor</th>
                                <th class="px-6 py-4 text-center">Enrolled</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4">Price</th>
                                <th class="px-6 py-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                            <tr class="group hover:bg-primary/5 dark:hover:bg-white/5 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        <div class="w-16 h-10 rounded bg-gray-200 bg-cover bg-center shrink-0" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuC5f3DxEAo2JaXZR_Ybcl1NSmNMlnf04H2UBy9bBo5Cchl5GBp3dgTB8lC1x8L7xG_crkQJR6V6hlriy38vbSXH-mcToj8yC1ktFnsbH337UKqNCDKI_xdGAfCKhhMQ7lfe7mgmPK9sRsLMZW5P3BtMdSBuFTYbnJb9Yu9tIjw20RjQYqDluwIoyGDM5uRTme52nvTFEK5PE4nbWr_YJ0Ty3NGAd06S4uxxW--m5wJP3ybnqrn_6DtK486ENYoOxNOE9OFfjCDTnv8');"></div>
                                        <div>
                                            <p class="font-bold text-[#171511] dark:text-white text-sm group-hover:text-brand-orchid transition-colors">Morning Yoga Flow</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">ID: #CS-8921</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-orange-100 text-orange-700 dark:bg-orange-900/30 dark:text-orange-300">
                                        <span class="w-1.5 h-1.5 rounded-full bg-orange-500"></span>
                                        Yoga
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <div class="size-6 rounded-full bg-gray-200 bg-cover bg-center" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuCbKPUZrvLc9_ySAJnztfcsXP2MZYrWo7Rdk6C0SyNbshpUb1VPMXLB6T2y2098o5H1nJgj3IC0TWUwXlwlccoO5M1Ytk_5M04r1udjt7pR6OkJJ5vITctrK0JfwKkQl9IcBg0LmYZC__OIMnxKiqbu_qOrSRwT7_mhSKJYoxvbjoGVrxU0m01eDw4bv0zxZspFT5537MVq1PuJXH7IxwCpWEhQChuiMQ9dtSp9uyG5PYhnz4tKeUGVYMtVN3CDjfPfYRJAO5myoC0');"></div>
                                        <span class="text-gray-700 dark:text-gray-300">Sarah Jenkins</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center font-semibold text-gray-700 dark:text-gray-300">
                                    1,245
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400">
                                        Active
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-gray-700 dark:text-gray-300 font-medium">$49.99</td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <button class="p-1.5 text-gray-400 hover:text-brand-orchid hover:bg-brand-orchid/10 rounded-md transition-colors" title="Edit">
                                            <span class="material-symbols-outlined text-lg">edit</span>
                                        </button>
                                        <button class="p-1.5 text-gray-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-md transition-colors" title="Delete">
                                            <span class="material-symbols-outlined text-lg">delete</span>
                                        </button>
                                        <button class="p-1.5 text-gray-400 hover:text-brand-teal hover:bg-brand-teal/10 rounded-md transition-colors" title="View Analytics">
                                            <span class="material-symbols-outlined text-lg">bar_chart</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="group hover:bg-primary/5 dark:hover:bg-white/5 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        <div class="w-16 h-10 rounded bg-gray-200 bg-cover bg-center shrink-0" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuAkEcpRgLiuf73dJaNW49KKOzVueQMJMJwQO4x3zxnB_YBwm1XwwT4EoP9fRwH702unCsWREFUiUPE960P9d5VVQrMDR1khFRS4QzIoLHPVNgl0SJH4AJlUS9LG76EwX-AqPE7Q3Q2C8bHbVO_89-N_2Xol_cylumDaFEaEc6sqNMnn1buntH8RC-jUcBfSNnnYdHuzMnpRC2brQDj_axsuzwAc2LEhgbZrZyBbpUrOMfMCRNFxaAqqlWrK2Wff_jMY3qrikWIKbcE');"></div>
                                        <div>
                                            <p class="font-bold text-[#171511] dark:text-white text-sm group-hover:text-brand-orchid transition-colors">Mindfulness Meditation</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">ID: #CS-8922</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-300">
                                        <span class="w-1.5 h-1.5 rounded-full bg-purple-500"></span>
                                        Meditation
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <div class="size-6 rounded-full bg-gray-200 bg-cover bg-center" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuA3h0vdUpPiGNCb3D3yxNxqsxF29aL1Lu7MF60CXPh454EROUr4JhB1SUSbE6OM-zswdMAnvAn_4fV3EfgNOB1fOtCn4NWqBBTA4qL4p_jPaPk86um7LAA_tJVoOcjhoyS7yreujlYCpKIeT2k-AnR9sNiNhUHpraBD4KCmBBNwEGZlKVkAQjGHR32V7FXDH8cBV5qyVk9Ht7rnUo3jRTkmYeXInBVzrdaYMBYLPlilKUn50Za7FB55PyRKq16iG6ljREjuY1qJO7Y');"></div>
                                        <span class="text-gray-700 dark:text-gray-300">David Chen</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center font-semibold text-gray-700 dark:text-gray-300">
                                    856
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400">
                                        Active
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-gray-700 dark:text-gray-300 font-medium">$29.99</td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <button class="p-1.5 text-gray-400 hover:text-brand-orchid hover:bg-brand-orchid/10 rounded-md transition-colors" title="Edit">
                                            <span class="material-symbols-outlined text-lg">edit</span>
                                        </button>
                                        <button class="p-1.5 text-gray-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-md transition-colors" title="Delete">
                                            <span class="material-symbols-outlined text-lg">delete</span>
                                        </button>
                                        <button class="p-1.5 text-gray-400 hover:text-brand-teal hover:bg-brand-teal/10 rounded-md transition-colors" title="View Analytics">
                                            <span class="material-symbols-outlined text-lg">bar_chart</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="group hover:bg-primary/5 dark:hover:bg-white/5 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        <div class="w-16 h-10 rounded bg-gray-200 bg-cover bg-center shrink-0" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuD8ehZklntjbJ6--hZIauIemM52aEtB9ZIN_cu283_73K47OxiFxL3LzUFa-Gz5Po2QR0rx2mIrE9meeSJ2VdychACTs6XZ5vwxJ0W9AKSDC7jDATv85CzFJvTsz06pgsyVmwOu4nauWVPHfdTunZLUOMlZRDHHQhuaB61XZeOLTFX8UVP3BWfjzA4Fd3LcGLKlI_VnnF_WKimJrJa8pCH58prhlR0UdP_vUIXLkWzr44BJezna5_V4MPVKEiK4nkh6gRdoRVfUxUQ');"></div>
                                        <div>
                                            <p class="font-bold text-[#171511] dark:text-white text-sm group-hover:text-brand-orchid transition-colors">Plant-Based Nutrition 101</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">ID: #CS-8923</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                        Nutrition
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <div class="size-6 rounded-full bg-gray-200 bg-cover bg-center" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuB9PjSTz4ENBryQW7IIaIQ-EDq49HjkhVGpIQ-hO7bnNtR_xf-XvvZ2wlKZrdEbDUPeqmF_H2h2FUmtmLJbH01-oIN3dypopU6pVwQgYFxsg4kyY9_unHGbNt6oDW3MN2zaTj1iYNMxgCDhdOCauzqqRfnL2_J3mtpgrMPTndZR2TyRx0TCx-EEuS9HSDGtGZ-Tm7w90ZOnQBObeUll-VuupSaOjMZzvJEKHGmdRP-UVyRkX01M0ItL3SbDhRuucIqu3kk_kGDETAA');"></div>
                                        <span class="text-gray-700 dark:text-gray-300">Elena Gomez</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center font-semibold text-gray-700 dark:text-gray-300">
                                    0
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-600 dark:bg-gray-800 dark:text-gray-400">
                                        Draft
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-gray-700 dark:text-gray-300 font-medium">$59.99</td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <button class="p-1.5 text-brand-orchid hover:bg-brand-orchid/10 rounded-md transition-colors" title="Continue Editing">
                                            <span class="material-symbols-outlined text-lg">edit_note</span>
                                        </button>
                                        <button class="p-1.5 text-gray-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-md transition-colors" title="Delete">
                                            <span class="material-symbols-outlined text-lg">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="group hover:bg-primary/5 dark:hover:bg-white/5 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        <div class="w-16 h-10 rounded bg-gray-200 bg-cover bg-center shrink-0" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuB9lf1Fo6VF-lt2-ZAq3hMTprdOaE53fowlic50NEfSkLfxNxNCvFAwciXWHRrqhLvrB8xVqju_H7a2aFD25WCyjQeAC_140Q4p857oHSApFFPoSSgOSVoOu7n38Gv2OaZS_JCXCmKisogBOFegB7ZvQZuhLVhntlPwkyd3V1fI7nJIUYKy8kr7xCqiOxA3xoR7UV_SEc5nkNst716HZrT0xaj-5gK8Y0q7vuYn7E2XEjZE1XksaBpqcHLch32ftaRZ7Tm1bpFB6aU');"></div>
                                        <div>
                                            <p class="font-bold text-[#171511] dark:text-white text-sm group-hover:text-brand-orchid transition-colors">Advanced HIIT Cardio</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">ID: #CS-8924</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-300">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                        Fitness
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <div class="size-6 rounded-full bg-gray-200 bg-cover bg-center" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDO_o4rJnUkDVygQba1wd4AEyqDfMnGOSOtOIF1H6Lqku2M6wyeYTIxnNRUZEVDlewIZfyGXUpqM0TYhM1DeAx3PgnOXd8UEsgyk2P_w8GE3Kv_palgOGfN92m97b_q9Nl1mAXdYdCwFj7dr_Xkd6guRx1gul5Zb5TfBpOSfSgKJrCv0qEW50NKLhaXSOqKdHhSYMqZiaEnDyxuy1UONN2nICJqcNkISemG4XJtHzGNVuW249jzGMBUXN7FtcxmmXD1MDuopi_Lah4');"></div>
                                        <span class="text-gray-700 dark:text-gray-300">Marcus Johnson</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center font-semibold text-gray-700 dark:text-gray-300">
                                    2,100
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400">
                                        Active
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-gray-700 dark:text-gray-300 font-medium">$39.99</td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <button class="p-1.5 text-gray-400 hover:text-brand-orchid hover:bg-brand-orchid/10 rounded-md transition-colors" title="Edit">
                                            <span class="material-symbols-outlined text-lg">edit</span>
                                        </button>
                                        <button class="p-1.5 text-gray-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-md transition-colors" title="Delete">
                                            <span class="material-symbols-outlined text-lg">delete</span>
                                        </button>
                                        <button class="p-1.5 text-gray-400 hover:text-brand-teal hover:bg-brand-teal/10 rounded-md transition-colors" title="View Analytics">
                                            <span class="material-symbols-outlined text-lg">bar_chart</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="group hover:bg-primary/5 dark:hover:bg-white/5 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        <div class="w-16 h-10 rounded bg-gray-200 bg-cover bg-center shrink-0" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuAefQMb7fvcr6PV9Fn9HgIuDs0Yg6U3rJ3BwIASMXgMG0aFEihYEEpUVGif22TidlaSvJF9YFkpXTRKfe2-T-HpJOwroDTMxskwk6AmvTHIkQbOzT4u1NsM8dpQ2nzQVedP0NWr-KwtJrCGwegN5Dx9fEY9Y7vtDPr9tm0FQKjCXI2daeJl7gqpvqhyPdjbAEXFuMbZb2ExtSQw06cONcM546YNckXHXq6DfJXtr83zA8gWmDaF2fw3jAKCgjNYfeLAxu1OFfiwsVo');"></div>
                                        <div>
                                            <p class="font-bold text-[#171511] dark:text-white text-sm group-hover:text-brand-orchid transition-colors">Sound Healing Basics</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">ID: #CS-8925</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-300">
                                        <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                                        Therapy
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <div class="size-6 rounded-full bg-gray-200 bg-cover bg-center" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuC7TlnDl9GijlMKBdIYeoZw7R7nGwwR1wTQeOkHcz2S4qmGgkLdfDIQE0BxwygHrdO7l5GNa2dtp_9bsX62CXose6GQr0cmre9Rum4fxP0So8ZHqgz7DagGID9-OjZ4_vay_2tx46okOCWc2zWeN9WuSE2a3of_U1PlQA7etn6Ju1_Iic0xv-XOkrWknPSwPM7UTLsb1k7d4--iVd2XZykmngSiRv7gwqnCO4eeVYYwFT0_zTP5TlHL0biG3O4x-amukw-stWMn45w');"></div>
                                        <span class="text-gray-700 dark:text-gray-300">Aisha Patel</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center font-semibold text-gray-700 dark:text-gray-300">
                                    150
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400">
                                        Review
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-gray-700 dark:text-gray-300 font-medium">$79.99</td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <button class="p-1.5 text-brand-teal hover:bg-brand-teal/10 rounded-md transition-colors" title="Approve">
                                            <span class="material-symbols-outlined text-lg">check_circle</span>
                                        </button>
                                        <button class="p-1.5 text-gray-400 hover:text-brand-orchid hover:bg-brand-orchid/10 rounded-md transition-colors" title="Edit">
                                            <span class="material-symbols-outlined text-lg">edit</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-4 border-t border-gray-100 dark:border-gray-800 bg-gray-50 dark:bg-[#2a2415] flex flex-col md:flex-row items-center justify-between gap-4">
                    <p class="text-sm text-gray-500 dark:text-gray-400">Showing <span class="font-bold text-gray-900 dark:text-white">1-5</span> of <span class="font-bold text-gray-900 dark:text-white">24</span> courses</p>
                    <div class="flex items-center gap-2">
                        <button class="px-3 py-1.5 text-sm font-medium text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 disabled:opacity-50 transition-colors" disabled="">
                            Previous
                        </button>
                        <button class="px-3 py-1.5 text-sm font-bold text-white bg-brand-orchid rounded-lg hover:bg-[#c55bc1] transition-colors">1</button>
                        <button class="px-3 py-1.5 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">2</button>
                        <button class="px-3 py-1.5 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">3</button>
                        <span class="text-gray-400">...</span>
                        <button class="px-3 py-1.5 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">8</button>
                        <button class="px-3 py-1.5 text-sm font-medium text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                            Next
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
@section('scripts')
@endsection