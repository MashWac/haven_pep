<header class="sticky top-0 z-50 flex items-center justify-between whitespace-nowrap border-b border-solid border-b-surface-dark dark:border-b-[#362b36] bg-background-light dark:bg-background-dark px-10 py-3">
    <div class="flex items-center gap-8">
        <div class="flex items-center gap-4 dark:text-white text-gray-900">
            <div class="size-20 text-primary">
        <img src="{{ asset('images/logo.png') }}" alt="Haven PEP Logo" class="w-full h-full object-contain">
            </div>
            <!-- <h2 class="text-lg font-bold leading-tight tracking-[-0.015em]">Haven PEP</h2> -->
        </div>
        <nav class="hidden md:flex items-center gap-9">
            <a class="text-sm font-medium leading-normal hover:text-primary transition-colors" href="{{url('/')}}">Home</a>
            <a class="text-sm font-medium leading-normal hover:text-primary transition-colors" href="{{url('/book_listings')}}">Books</a>
            <a class="text-sm font-medium leading-normal hover:text-primary transition-colors" href="{{url('/courses')}}">Course</a>
        </nav>
    </div>

    <div class="flex flex-1 justify-end gap-8 items-center">
        <label class="hidden lg:flex flex-col min-w-40 !h-10 max-w-64">
            <div class="flex w-full flex-1 items-stretch rounded-lg h-full bg-surface-dark/10 dark:bg-surface-dark border border-transparent focus-within:border-primary transition-colors">
                <div class="text-gray-500 dark:text-[#b5a1b4] flex items-center justify-center pl-4 rounded-l-lg">
                    <span class="material-symbols-outlined">search</span>
                </div>
                <input class="form-input flex w-full min-w-0 flex-1 bg-transparent text-inherit focus:outline-0 focus:ring-0 border-none h-full placeholder:text-gray-500 dark:placeholder:text-[#b5a1b4] px-4 pl-2 text-base font-normal" placeholder="Search books, videos..." />
            </div>
        </label>

        <a href="{{url('/cart')}}" class="relative flex items-center justify-center gap-2 rounded-lg h-10 px-4 text-gray-900 dark:text-white hover:bg-black/5 dark:hover:bg-white/5 transition-colors">
            <span class="material-symbols-outlined">shopping_cart</span>
            <span class="text-sm font-bold">Cart</span>
            @if(session('cart') && count(session('cart')) > 0)
            <span class="absolute -top-1 -right-1 flex h-4 w-4 items-center justify-center rounded-full bg-primary text-[10px] font-bold text-white">
                {{ count(session('cart')) }}
            </span>
            @endif
        </a>

        <div class="relative" x-data="{ open: false }" @click.away="open = false">
            <button @click="open = !open" class="focus:outline-none flex items-center">
                @if(session('user_logged_in'))
                <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10 border-2 border-primary transition-transform active:scale-95 cursor-pointer"
                    style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuD-3yNhYwA7KDBmwPf_kKdDn7ZiwRblQX1jYbuGGsvDuTtSXzh5OK51P0vAEq_NBY6y3cOvRVtRWsf8hznTY5Cd4qFq7hY9oD41LmLuQys9IBIk6lBsHos52WR49VMLQsGZMqDWhlS1ov6I5zbV2CyFtGAId8DHyHHBqfaHdGu1qn1Gl3PlaU9hrRxtskGeVeV8HC8T9XAqT35pmPLF5U5QWwgyWkEQrjrM5UieO7zrdlbTRGoqNg0W7GouXA7VLNHiCC6Nl-XYm_c");'>
                </div>
                @else
                <div class="flex items-center justify-center size-10 rounded-full border border-[#362b36] hover:border-primary text-gray-500 dark:text-white transition-colors cursor-pointer">
                    <span class="material-symbols-outlined">account_circle</span>
                </div>
                @endif
            </button>

            <div x-show="open"
                x-cloak
                x-transition:enter="transition ease-out duration-100"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                class="absolute right-0 mt-3 w-56 origin-top-right rounded-xl bg-white dark:bg-[#231b23] border border-slate-200 dark:border-[#362b36] shadow-2xl z-[60] overflow-hidden">

                <div class="py-2">
                    @if(session('user_logged_in'))
                    <div class="px-4 py-3 border-b border-slate-100 dark:border-[#362b36] mb-1">
                        <p class="text-[10px] uppercase tracking-wider text-[#b5a1b4] font-bold">Account</p>
                        <p class="text-sm font-bold dark:text-white truncate">{{ session('user_name') ?? 'User Name' }}</p>
                    </div>
                    @if(session('user_type')==1)

                    <a href="{{ url('/admin_dashboard') }}" class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 dark:text-slate-200 hover:bg-primary/10 hover:text-primary transition-colors">
                        <span class="material-symbols-outlined text-lg">person</span>
                        My Profile
                    </a>
                    @else
                                        <a href="{{ url('/my_profile') }}" class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 dark:text-slate-200 hover:bg-primary/10 hover:text-primary transition-colors">
                        <span class="material-symbols-outlined text-lg">person</span>
                        My Profile
                    </a>
                    @endif

                    <hr class="my-1 border-slate-100 dark:border-[#362b36]">

                    <form method="GET" action="{{ url('logout') }}">
                        @csrf
                        <button type="submit" class="flex w-full items-center gap-3 px-4 py-2 text-sm text-red-500 hover:bg-red-500/10 transition-colors text-left font-medium">
                            <span class="material-symbols-outlined text-lg">logout</span>
                            Sign Out
                        </button>
                    </form>
                    @else
                    <div class="px-4 py-2">
                        <p class="text-xs text-[#b5a1b4] mb-2">Welcome to Wellness Reads</p>
                        <a href="{{ url('login') }}" class="flex w-full items-center justify-center rounded-lg bg-primary py-2 text-sm font-bold text-background-dark transition-opacity hover:opacity-90">
                            Login
                        </a>
                        <a href="{{ url('register') }}" class="mt-2 flex w-full items-center justify-center rounded-lg border border-[#362b36] py-2 text-sm font-bold dark:text-white hover:bg-white/5 transition-colors">
                            Create Account
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</header>