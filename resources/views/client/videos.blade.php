<!-- Video Lessons -->
<!DOCTYPE html>

<html class="dark" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Video Lessons - Wellness Hub</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;700;900&amp;family=Noto+Sans:wght@400;500;700&amp;display=swap" rel="stylesheet" />
    <!-- Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <!-- Theme Configuration -->
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#da71d7",
                        "secondary": "#40B5AD",
                        "tertiary": "#F8E9CA",
                        "background-light": "#f8f6f8",
                        "background-dark": "#1f131f",
                        "surface-dark": "#2d242d",
                        "surface-light": "#ffffff",
                    },
                    fontFamily: {
                        "display": ["Lexend", "Noto Sans", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "2xl": "1rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
    <style>
        /* Custom scrollbar for a cleaner look */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #1f131f;
        }

        ::-webkit-scrollbar-thumb {
            background: #362b36;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #da71d7;
        }
    </style>
</head>

<body class="bg-background-light dark:bg-background-dark text-[#171217] dark:text-white font-display min-h-screen flex flex-col overflow-x-hidden selection:bg-primary selection:text-white">
    <!-- Top Navigation -->
    <header class="sticky top-0 z-50 flex items-center justify-between whitespace-nowrap border-b border-solid border-black/5 dark:border-white/10 bg-background-light/95 dark:bg-background-dark/95 backdrop-blur-md px-10 py-3">
        <div class="flex items-center gap-8">
            <div class="flex items-center gap-4 text-[#171217] dark:text-white">
                <div class="size-8 flex items-center justify-center text-primary">
                    <span class="material-symbols-outlined text-3xl">spa</span>
                </div>
                <!-- <h2 class="text-lg font-bold leading-tight tracking-[-0.015em]">Wellness Hub</h2> -->
            </div>
            <div class="hidden md:flex items-center gap-9">
                <a class="text-[#171217] dark:text-white hover:text-primary transition-colors text-sm font-medium leading-normal" href="#">Dashboard</a>
                <a class="text-primary text-sm font-bold leading-normal" href="#">Lessons</a>
                <a class="text-[#171217] dark:text-white hover:text-primary transition-colors text-sm font-medium leading-normal" href="#">Community</a>
                <a class="text-[#171217] dark:text-white hover:text-primary transition-colors text-sm font-medium leading-normal" href="#">Profile</a>
            </div>
        </div>
        <div class="flex flex-1 justify-end gap-8">
            <label class="flex flex-col min-w-40 !h-10 max-w-64 hidden sm:flex">
                <div class="flex w-full flex-1 items-stretch rounded-lg h-full ring-1 ring-black/5 dark:ring-white/10 focus-within:ring-primary dark:focus-within:ring-primary transition-shadow">
                    <div class="text-[#b5a1b4] flex border-none bg-[#f0eff0] dark:bg-[#362b36] items-center justify-center pl-4 rounded-l-lg border-r-0">
                        <span class="material-symbols-outlined text-[20px]">search</span>
                    </div>
                    <input class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-r-lg text-[#171217] dark:text-white focus:outline-0 focus:ring-0 border-none bg-[#f0eff0] dark:bg-[#362b36] focus:border-none h-full placeholder:text-[#b5a1b4] px-4 rounded-l-none border-l-0 pl-2 text-sm font-normal leading-normal" placeholder="Search lessons..." value="" />
                </div>
            </label>
            <button class="flex min-w-[40px] size-10 items-center justify-center rounded-full bg-surface-light dark:bg-surface-dark border border-black/5 dark:border-white/10 md:hidden">
                <span class="material-symbols-outlined text-xl">menu</span>
            </button>
            <button class="hidden md:flex min-w-[84px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-primary hover:bg-primary/90 transition-colors text-[#171217] text-sm font-bold leading-normal tracking-[0.015em]">
                <span class="truncate">Log Out</span>
            </button>
            <div class="size-10 rounded-full bg-cover bg-center border-2 border-primary cursor-pointer" data-alt="User profile picture showing a smiling woman" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBSq6EKY0ZqFkQzRMJ7JLG8ns503q56w8iuU6rKMMEOAyYmR8sCLRIQ46b2V8TK60545kokErZtjvPZL49N659qp8TCRSZ1SjMxfW8fLikuRM2eO8VLxwHXE2tOAZsW14sSnMiZtavWkvENjUBHUE3L6vT3-dMZ4dXPE9PueejGfhnPi_LMZL9toFdnS5-Z-WEBctb0ZSar-YkGzVIpp862HDuc5EV98cPhkMS8T0WyRZvp2G9jU5JCS02RnHDdPK1xAMXoxZpl0hA");'></div>
        </div>
    </header>
    <div class="layout-container flex h-full grow flex-col">
        <div class="px-4 md:px-10 lg:px-40 flex flex-1 justify-center py-5">
            <div class="layout-content-container flex flex-col max-w-[1200px] flex-1">
                <!-- Hero Section -->
                <div class="@container mb-8">
                    <div class="@[480px]:p-0">
                        <div class="relative flex min-h-[480px] flex-col gap-6 bg-cover bg-center bg-no-repeat rounded-2xl items-start justify-end px-6 pb-10 @[480px]:px-10 overflow-hidden shadow-2xl shadow-black/40 group cursor-pointer" data-alt="Woman practicing yoga outdoors during sunset" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCH3qQKlIH7VRbTePWgTjxPWzKXyEMbi8U6W0eS_pwjhbzn6qmUJWQk_aTuoIp5Myzk-2_Jgfq7eWA5y1C3Xtg1dak5sfQ2kA88f7VQJBko0uf3bd-LUhf5oVmj1OAAWHmcSEW4ACQhLAETTdu6A4Iw5QeU8T647ecZNJ52-mr-ED1zCbIMG4FhdbBiY_y7dDSFBRwxMXIicKP5Kcz1Q0bTStzXIBi_iyoXkwaUyZ13dVwNG2jP4zZWtSEJl-5LuAqLh1U1BqO5rqM");'>
                            <!-- Overlay Gradient -->
                            <div class="absolute inset-0 bg-gradient-to-t from-background-dark via-background-dark/50 to-transparent"></div>
                            <div class="relative z-10 flex flex-col gap-4 text-left max-w-2xl">
                                <span class="inline-flex items-center justify-center px-3 py-1 rounded-full bg-secondary text-white text-xs font-bold uppercase tracking-wider w-fit">
                                    Resume Session
                                </span>
                                <h1 class="text-white text-4xl font-black leading-tight tracking-[-0.033em] @[480px]:text-6xl drop-shadow-lg">
                                    Morning Yoga Flow
                                </h1>
                                <div class="flex items-center gap-3">
                                    <div class="h-1.5 w-32 bg-white/20 rounded-full overflow-hidden">
                                        <div class="h-full bg-primary w-[45%] rounded-full"></div>
                                    </div>
                                    <p class="text-tertiary text-sm font-medium leading-normal">
                                        45% complete • 12m remaining
                                    </p>
                                </div>
                                <p class="text-white/80 text-base max-w-lg line-clamp-2">
                                    Start your day with intention. This flow focuses on opening the hips and chest to release tension and invite positive energy.
                                </p>
                            </div>
                            <button class="relative z-10 flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-6 bg-primary hover:bg-primary/90 hover:scale-105 transition-all text-[#171217] text-base font-bold leading-normal tracking-[0.015em] mt-2 shadow-lg shadow-primary/20">
                                <span class="material-symbols-outlined mr-2">play_arrow</span>
                                <span class="truncate">Resume Lesson</span>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Filters -->
                <div class="flex items-center justify-between mb-2">
                    <div class="flex gap-3 py-3 flex-wrap overflow-x-auto no-scrollbar mask-gradient">
                        <button class="flex h-9 shrink-0 items-center justify-center gap-x-2 rounded-full bg-primary px-5 transition-transform hover:scale-105 active:scale-95 shadow-lg shadow-primary/20">
                            <p class="text-[#1f131f] text-sm font-bold leading-normal">All</p>
                        </button>
                        <button class="flex h-9 shrink-0 items-center justify-center gap-x-2 rounded-full bg-surface-dark border border-white/5 hover:border-secondary/50 px-5 transition-all hover:bg-surface-dark/80 group">
                            <p class="text-white text-sm font-medium leading-normal group-hover:text-secondary">Mindfulness</p>
                        </button>
                        <button class="flex h-9 shrink-0 items-center justify-center gap-x-2 rounded-full bg-surface-dark border border-white/5 hover:border-secondary/50 px-5 transition-all hover:bg-surface-dark/80 group">
                            <p class="text-white text-sm font-medium leading-normal group-hover:text-secondary">Body &amp; Fitness</p>
                        </button>
                        <button class="flex h-9 shrink-0 items-center justify-center gap-x-2 rounded-full bg-surface-dark border border-white/5 hover:border-secondary/50 px-5 transition-all hover:bg-surface-dark/80 group">
                            <p class="text-white text-sm font-medium leading-normal group-hover:text-secondary">Nutrition</p>
                        </button>
                        <button class="flex h-9 shrink-0 items-center justify-center gap-x-2 rounded-full bg-surface-dark border border-white/5 hover:border-secondary/50 px-5 transition-all hover:bg-surface-dark/80 group">
                            <p class="text-white text-sm font-medium leading-normal group-hover:text-secondary">Spirituality</p>
                        </button>
                    </div>
                    <button class="text-secondary text-sm font-medium hidden sm:block hover:underline">View All Categories</button>
                </div>
                <!-- Section: Recommended -->
                <div class="flex flex-col mb-8">
                    <h2 class="text-[#171217] dark:text-white text-[22px] font-bold leading-tight tracking-[-0.015em] pb-4 pt-2 flex items-center gap-2">
                        <span class="material-symbols-outlined text-secondary">recommend</span>
                        Recommended for You
                    </h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        <!-- Card 1 -->
                        <div class="group flex flex-col gap-3 cursor-pointer">
                            <div class="relative w-full aspect-video bg-surface-dark rounded-xl overflow-hidden shadow-md">
                                <div class="w-full h-full bg-center bg-no-repeat bg-cover transition-transform duration-500 group-hover:scale-110" data-alt="Close up of hands in meditation pose" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBEgF6wl8C355PCMeUX2xOE2wFv2grP6k-3W9Vo83S1ubk6NJZSPslerJG4F4E-6p9zIx1l7JO92-17sb29bgK3DzspoJdBR64-bcxq5TjRWk_k6Fav_uRU-utdLcKmD4cl9NXN4n6NpZLOCKAQM7wBTkRf_CDjM9_-cZ2VGTfaLMTBqBudLyvsUsESpnZmhZn-4YRpnYuOWtNG1DeHTco67lQPwx9LrO1aGFyEpn-6DyZw_hIKU1fVQEK61YnjyHE-TsKjAh2MjRU");'></div>
                                <div class="absolute inset-0 bg-black/20 group-hover:bg-black/40 transition-colors flex items-center justify-center opacity-0 group-hover:opacity-100">
                                    <div class="size-12 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center">
                                        <span class="material-symbols-outlined text-white text-3xl">play_arrow</span>
                                    </div>
                                </div>
                                <div class="absolute bottom-2 right-2 bg-black/60 backdrop-blur-md px-2 py-0.5 rounded text-xs font-medium text-white">
                                    10:00
                                </div>
                                <div class="absolute top-2 left-2 bg-secondary px-2 py-0.5 rounded text-xs font-bold text-white shadow-sm">
                                    Beginner
                                </div>
                            </div>
                            <div class="flex flex-col gap-1">
                                <div class="flex justify-between items-start">
                                    <p class="text-[#171217] dark:text-white text-lg font-bold leading-tight group-hover:text-primary transition-colors">Intro to Meditation</p>
                                    <span class="material-symbols-outlined text-white/30 hover:text-primary text-xl" title="Save">bookmark_border</span>
                                </div>
                                <p class="text-tertiary text-sm font-medium leading-normal">Sarah Jenkins</p>
                                <p class="text-[#b5a1b4] text-xs font-normal leading-normal mt-1">Mindfulness • 2.5k views</p>
                            </div>
                        </div>
                        <!-- Card 2 -->
                        <div class="group flex flex-col gap-3 cursor-pointer">
                            <div class="relative w-full aspect-video bg-surface-dark rounded-xl overflow-hidden shadow-md">
                                <div class="w-full h-full bg-center bg-no-repeat bg-cover transition-transform duration-500 group-hover:scale-110" data-alt="Athletic man doing high intensity workout" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuB2kMX5lIH4sc4E7L_EWyFD3MyQbUh--_5s5YYY4mm1VsbX7vC4pANiio5LuwFMeL2U3UiHUz1FO7D7x8vbJQkcTPEN2kjRaqnnlDAgnGZWFTsV3hxKQkyhklqMoZho9gV7MOOKtFWhi23FFKJXWKL9bjKIeHDep7PlMBZd6B4lpExDyXl1qtSyw-NpjHgjAUD3sK2Misgpuj4lkI1OBD-JO8Ssci-rHWXWKDR0ASjaMyQS7Sag-c7bKlLi2DIlaT9SuMR9rLdJyoY");'></div>
                                <div class="absolute inset-0 bg-black/20 group-hover:bg-black/40 transition-colors flex items-center justify-center opacity-0 group-hover:opacity-100">
                                    <div class="size-12 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center">
                                        <span class="material-symbols-outlined text-white text-3xl">play_arrow</span>
                                    </div>
                                </div>
                                <div class="absolute bottom-2 right-2 bg-black/60 backdrop-blur-md px-2 py-0.5 rounded text-xs font-medium text-white">
                                    25:00
                                </div>
                                <div class="absolute top-2 left-2 bg-primary px-2 py-0.5 rounded text-xs font-bold text-[#1f131f] shadow-sm">
                                    Popular
                                </div>
                            </div>
                            <div class="flex flex-col gap-1">
                                <div class="flex justify-between items-start">
                                    <p class="text-[#171217] dark:text-white text-lg font-bold leading-tight group-hover:text-primary transition-colors">HIIT Blast</p>
                                    <span class="material-symbols-outlined text-white/30 hover:text-primary text-xl" title="Save">bookmark_border</span>
                                </div>
                                <p class="text-tertiary text-sm font-medium leading-normal">Mike T.</p>
                                <p class="text-[#b5a1b4] text-xs font-normal leading-normal mt-1">Fitness • 12k views</p>
                            </div>
                        </div>
                        <!-- Card 3 -->
                        <div class="group flex flex-col gap-3 cursor-pointer">
                            <div class="relative w-full aspect-video bg-surface-dark rounded-xl overflow-hidden shadow-md">
                                <div class="w-full h-full bg-center bg-no-repeat bg-cover transition-transform duration-500 group-hover:scale-110" data-alt="Cozy bedroom setting with soft lighting" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuAmIKBllwkQEp8it-g1PLw1grhclVWCZ-xRvAyIposOINeyf6GCtGuA5pGsXKVRlAUBQVKVwla89eh5JPakeQK9Xk_y1QD5Bp6H_r7WuwKSw6c_jbOFEDcBwTIiazV9BegdsXT6InFgcUwqDbGFipmMoyHYydEgG0FVHjRdK8TvPCHf6OjJ4-ZVsAlgccjH1oeUqF8ZHC0qyvf_dOGEY6uVJNoCEGkY54KQoESpgR0Tw5rtTGsRiliNDnpMv_KiBAU2j0RI_dHE5rI");'></div>
                                <div class="absolute inset-0 bg-black/20 group-hover:bg-black/40 transition-colors flex items-center justify-center opacity-0 group-hover:opacity-100">
                                    <div class="size-12 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center">
                                        <span class="material-symbols-outlined text-white text-3xl">play_arrow</span>
                                    </div>
                                </div>
                                <div class="absolute bottom-2 right-2 bg-black/60 backdrop-blur-md px-2 py-0.5 rounded text-xs font-medium text-white">
                                    15:00
                                </div>
                            </div>
                            <div class="flex flex-col gap-1">
                                <div class="flex justify-between items-start">
                                    <p class="text-[#171217] dark:text-white text-lg font-bold leading-tight group-hover:text-primary transition-colors">Sleep Hygiene</p>
                                    <span class="material-symbols-outlined text-white/30 hover:text-primary text-xl" title="Save">bookmark_border</span>
                                </div>
                                <p class="text-tertiary text-sm font-medium leading-normal">Dr. Lee</p>
                                <p class="text-[#b5a1b4] text-xs font-normal leading-normal mt-1">Wellness • 800 views</p>
                            </div>
                        </div>
                        <!-- Card 4 -->
                        <div class="group flex flex-col gap-3 cursor-pointer">
                            <div class="relative w-full aspect-video bg-surface-dark rounded-xl overflow-hidden shadow-md">
                                <div class="w-full h-full bg-center bg-no-repeat bg-cover transition-transform duration-500 group-hover:scale-110" data-alt="Fresh colorful salad bowl" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBI4pV2PvNsxONazaC2Smc-bRNdJJjY0Ur1xux07V62FTSkoy5HGe7FPQB-g2ppXG6-mG7JiBTgmeTAxRJXMLVTQcYj8sSZ7a-2o16KhcsktfoOuVA-dp_v5HVNYUUjTsEWzuKxwzTzOsdsDNL3r3Dh9aEGgbQzSkgvxgcwyz8Y8MH6crJy3uWDucZ_6Jmlr3Fg4j-yPWTjR3WETRs-9U6KWv9UstdlEPQpfSPAU3i9uXOTcIN3GDHFRP7VfiSv7sXluGiaeTOM8GI");'></div>
                                <div class="absolute inset-0 bg-black/20 group-hover:bg-black/40 transition-colors flex items-center justify-center opacity-0 group-hover:opacity-100">
                                    <div class="size-12 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center">
                                        <span class="material-symbols-outlined text-white text-3xl">play_arrow</span>
                                    </div>
                                </div>
                                <div class="absolute bottom-2 right-2 bg-black/60 backdrop-blur-md px-2 py-0.5 rounded text-xs font-medium text-white">
                                    20:00
                                </div>
                                <div class="absolute top-2 left-2 bg-secondary px-2 py-0.5 rounded text-xs font-bold text-white shadow-sm">
                                    Series
                                </div>
                            </div>
                            <div class="flex flex-col gap-1">
                                <div class="flex justify-between items-start">
                                    <p class="text-[#171217] dark:text-white text-lg font-bold leading-tight group-hover:text-primary transition-colors">Plant-Based Basics</p>
                                    <span class="material-symbols-outlined text-white/30 hover:text-primary text-xl" title="Save">bookmark_border</span>
                                </div>
                                <p class="text-tertiary text-sm font-medium leading-normal">Chef Anna</p>
                                <p class="text-[#b5a1b4] text-xs font-normal leading-normal mt-1">Nutrition • 5.1k views</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Section: New Releases -->
                <div class="flex flex-col mb-12">
                    <h2 class="text-[#171217] dark:text-white text-[22px] font-bold leading-tight tracking-[-0.015em] pb-4 pt-5 flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">new_releases</span>
                        New Releases
                    </h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        <!-- Card 5 -->
                        <div class="group flex flex-col gap-3 cursor-pointer">
                            <div class="relative w-full aspect-video bg-surface-dark rounded-xl overflow-hidden shadow-md">
                                <div class="w-full h-full bg-center bg-no-repeat bg-cover transition-transform duration-500 group-hover:scale-110" data-alt="Person writing in a journal with coffee" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuD_uOCgeO2mmlWnmjggoGGdMoAPyBQ7qCiUQ-q6N3Gm0Rj3cSt3YoTuUzlhbtidCVwXE1bL-ttqAIxSpMImky6dB_X3XgxOiPXOKL2FHem-8a0yRQAqPQ9fwuti26QxESelH11Br5uKYdfUlTXDXUG_FuUhVB1d0fP7QyA1dDgSTzJ5nniBNeukKysKUBM2FrHPcNa-M7joDpJ_mSzRppWzHCJPF_NXKTNBJ-Aa10Mrb5gVOnO349pCAPTQvG3efJDmKgtfsXsWLz0");'></div>
                                <div class="absolute inset-0 bg-black/20 group-hover:bg-black/40 transition-colors flex items-center justify-center opacity-0 group-hover:opacity-100">
                                    <div class="size-12 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center">
                                        <span class="material-symbols-outlined text-white text-3xl">play_arrow</span>
                                    </div>
                                </div>
                                <div class="absolute bottom-2 right-2 bg-black/60 backdrop-blur-md px-2 py-0.5 rounded text-xs font-medium text-white">
                                    08:00
                                </div>
                                <div class="absolute top-2 left-2 bg-purple-600 px-2 py-0.5 rounded text-xs font-bold text-white shadow-sm">
                                    New
                                </div>
                            </div>
                            <div class="flex flex-col gap-1">
                                <div class="flex justify-between items-start">
                                    <p class="text-[#171217] dark:text-white text-lg font-bold leading-tight group-hover:text-primary transition-colors">Journaling 101</p>
                                    <span class="material-symbols-outlined text-white/30 hover:text-primary text-xl" title="Save">bookmark_border</span>
                                </div>
                                <p class="text-tertiary text-sm font-medium leading-normal">Marcus Well</p>
                                <p class="text-[#b5a1b4] text-xs font-normal leading-normal mt-1">Mental Health • 120 views</p>
                            </div>
                        </div>
                        <!-- Card 6 -->
                        <div class="group flex flex-col gap-3 cursor-pointer">
                            <div class="relative w-full aspect-video bg-surface-dark rounded-xl overflow-hidden shadow-md">
                                <div class="w-full h-full bg-center bg-no-repeat bg-cover transition-transform duration-500 group-hover:scale-110" data-alt="Person stretching legs on a yoga mat" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuD9gPntCdjEZqBzSN73FdfblzdgrDujVIEzpJYV0oDqsFOE3OjPiezvvHCfpydT6hrA7E5NkSuyrdnLOwfPdZ-uEMQ5ShgRgucpqn_Y_rZC3cWWSiH2qeq6tFiwlJNheF4t5ZGlvzTvWlXcD1cCOnjp6fP22pBz9fuu-MDqLB7-yBh0Zkp9H3WUjpxJZp_YLJUpZa6IGtyfrt7dm91V7J_3GgGSMxmMfSQK_mJD9W_wM1y8XxBdN-qpc3fBVPJ1MAWjL9nWkPdgde8");'></div>
                                <div class="absolute inset-0 bg-black/20 group-hover:bg-black/40 transition-colors flex items-center justify-center opacity-0 group-hover:opacity-100">
                                    <div class="size-12 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center">
                                        <span class="material-symbols-outlined text-white text-3xl">play_arrow</span>
                                    </div>
                                </div>
                                <div class="absolute bottom-2 right-2 bg-black/60 backdrop-blur-md px-2 py-0.5 rounded text-xs font-medium text-white">
                                    45:00
                                </div>
                            </div>
                            <div class="flex flex-col gap-1">
                                <div class="flex justify-between items-start">
                                    <p class="text-[#171217] dark:text-white text-lg font-bold leading-tight group-hover:text-primary transition-colors">Deep Stretch</p>
                                    <span class="material-symbols-outlined text-white/30 hover:text-primary text-xl" title="Save">bookmark_border</span>
                                </div>
                                <p class="text-tertiary text-sm font-medium leading-normal">Elena R.</p>
                                <p class="text-[#b5a1b4] text-xs font-normal leading-normal mt-1">Yoga • 340 views</p>
                            </div>
                        </div>
                        <!-- Card 7 -->
                        <div class="group flex flex-col gap-3 cursor-pointer">
                            <div class="relative w-full aspect-video bg-surface-dark rounded-xl overflow-hidden shadow-md">
                                <div class="w-full h-full bg-center bg-no-repeat bg-cover transition-transform duration-500 group-hover:scale-110" data-alt="Glass of water with lemon slices" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDa0KKNy91XhqdgUpWdsoAEORoDwtHmy6MvBflB3zY3k3EFdFCu_S1HjkUaYhycYFdHcfWU8eSpeiFhTmLoieXMgWoO5eRPapy49Zlo57OYO1XX6-OmkpbyHj7ToIppKI0VcNijLWlU2tzqcg_SdJL010_fUXgFx6w61ZkaDFk3fmfuKgB4adt6-w5XKVNYx_sZUivLaA9X6VjaT8ZdSiKSM8lf6AFKfkrL6ZNxSHeg9yRDpGfDRKBZGCmhkOOUYdWUqYySG7XOalc");'></div>
                                <div class="absolute inset-0 bg-black/20 group-hover:bg-black/40 transition-colors flex items-center justify-center opacity-0 group-hover:opacity-100">
                                    <div class="size-12 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center">
                                        <span class="material-symbols-outlined text-white text-3xl">play_arrow</span>
                                    </div>
                                </div>
                                <div class="absolute bottom-2 right-2 bg-black/60 backdrop-blur-md px-2 py-0.5 rounded text-xs font-medium text-white">
                                    05:00
                                </div>
                            </div>
                            <div class="flex flex-col gap-1">
                                <div class="flex justify-between items-start">
                                    <p class="text-[#171217] dark:text-white text-lg font-bold leading-tight group-hover:text-primary transition-colors">Hydration Myths</p>
                                    <span class="material-symbols-outlined text-white/30 hover:text-primary text-xl" title="Save">bookmark_border</span>
                                </div>
                                <p class="text-tertiary text-sm font-medium leading-normal">Dr. Lee</p>
                                <p class="text-[#b5a1b4] text-xs font-normal leading-normal mt-1">Health Tips • 1.1k views</p>
                            </div>
                        </div>
                        <!-- Card 8 -->
                        <div class="group flex flex-col gap-3 cursor-pointer">
                            <div class="relative w-full aspect-video bg-surface-dark rounded-xl overflow-hidden shadow-md">
                                <div class="w-full h-full bg-center bg-no-repeat bg-cover transition-transform duration-500 group-hover:scale-110" data-alt="Woman doing pilates on a reformer machine" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuD5bG7RWg-y7wrrTy4WE0Ds5vfG7zR0zj5AdjOrvJ9QKHoHZMwVTvQuaOkcADJz5tvr2WTlKot9hL1kUNIFOe4QrbYtTc-jBN67azN5g71A3LhIx7yaX9i67dUfsM_6YLFBcoGr1thuBaMfYGNk9BY2_6S_OQzoLKQpPOlR_K_DZ8X3b2vnuMscUdc0NtU9Won8H27b8ElDa4MCHPgaA_EuxJvQvakL42C_xKbrBL4S7wTS4T5SkZB75F4QxdTuja416ErYCO0yKiM");'></div>
                                <div class="absolute inset-0 bg-black/20 group-hover:bg-black/40 transition-colors flex items-center justify-center opacity-0 group-hover:opacity-100">
                                    <div class="size-12 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center">
                                        <span class="material-symbols-outlined text-white text-3xl">play_arrow</span>
                                    </div>
                                </div>
                                <div class="absolute bottom-2 right-2 bg-black/60 backdrop-blur-md px-2 py-0.5 rounded text-xs font-medium text-white">
                                    30:00
                                </div>
                            </div>
                            <div class="flex flex-col gap-1">
                                <div class="flex justify-between items-start">
                                    <p class="text-[#171217] dark:text-white text-lg font-bold leading-tight group-hover:text-primary transition-colors">Pilates Core</p>
                                    <span class="material-symbols-outlined text-white/30 hover:text-primary text-xl" title="Save">bookmark_border</span>
                                </div>
                                <p class="text-tertiary text-sm font-medium leading-normal">Coach Sarah</p>
                                <p class="text-[#b5a1b4] text-xs font-normal leading-normal mt-1">Fitness • 500 views</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>