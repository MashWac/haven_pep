@extends('layouts.client')

@section('headers')
@endsection

@section('content')
<body class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-white font-display overflow-x-hidden antialiased selection:bg-primary/30 selection:text-primary">
    @include('layouts.include.dark_header')

    <div class="min-h-screen flex flex-col lg:flex-row">
        <div class="hidden lg:flex w-full lg:w-1/2 relative bg-[#171217] flex-col justify-between p-12 xl:p-16 overflow-hidden">
            <div class="absolute inset-0 z-0 bg-cover bg-center transition-transform duration-700 hover:scale-105" style="background-image: url('https://images.unsplash.com/photo-1506126613408-eca07ce68773?auto=format&fit=crop&q=80&w=1000');"></div>
            <div class="absolute inset-0 z-10 bg-background-dark/50 backdrop-blur-[1px] bg-gradient-to-t from-background-dark via-background-dark/40 to-transparent"></div>
            
            <div class="relative z-20 h-full flex flex-col justify-between">
                <div class="flex items-center gap-3">
                    <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-primary/20 backdrop-blur-md border border-primary/20 text-primary">
                        <span class="material-symbols-outlined">spa</span>
                    </div>
                    <h2 class="text-white text-xl font-bold tracking-tight">Wellness Platform</h2>
                </div>

                <div class="max-w-lg mb-8">
                    <div class="flex gap-1 mb-4">
                        @for($i=0; $i<5; $i++) <span class="material-symbols-outlined text-secondary-teal text-xl fill-1">star</span> @endfor
                    </div>
                    <h1 class="text-4xl xl:text-5xl font-black leading-tight tracking-tight text-white mb-6 drop-shadow-sm">
                        Join over 10,000 learners finding their balance.
                    </h1>
                    <p class="text-lg text-tertiary-cream/90 font-normal leading-relaxed">
                        "Experience calmness and growth. Create an account to access unlimited courses and meditation guides tailored just for you."
                    </p>
                </div>

                <div class="text-sm text-gray-300/60 font-medium">
                    © {{ date('Y') }} Wellness Platform Inc. All rights reserved.
                </div>
            </div>
        </div>

        <div class="w-full lg:w-1/2 flex flex-col justify-center items-center px-6 py-10 sm:px-12 xl:px-24 bg-background-light dark:bg-background-dark relative overflow-y-auto">
            <div class="absolute top-6 right-6 lg:top-10 lg:right-10">
                <p class="text-sm font-medium text-slate-500 dark:text-[#b5a1b4]">
                    Already a member? <a class="text-primary hover:text-primary/80 font-bold ml-1 transition-colors" href="{{ url('/login') }}">Log In</a>
                </p>
            </div>

            <div class="w-full max-w-[480px] flex flex-col gap-8 mt-10 lg:mt-0">
                <div class="flex flex-col gap-2 text-center lg:text-left">
                    <h2 class="text-3xl sm:text-4xl font-bold tracking-tight text-slate-900 dark:text-white">Get Started</h2>
                    <p class="text-slate-500 dark:text-[#b5a1b4] text-base">Start your wellness journey today.</p>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <button class="group flex items-center justify-center gap-3 h-12 rounded-lg border border-slate-200 dark:border-[#503f4f] bg-white dark:bg-[#251d25] hover:bg-slate-50 transition-all">
                        <img alt="Google" class="w-5 h-5" src="https://www.svgrepo.com/show/475656/google-color.svg" />
                        <span class="text-sm font-bold text-slate-700 dark:text-white">Google</span>
                    </button>
                    <button class="group flex items-center justify-center gap-3 h-12 rounded-lg border border-slate-200 dark:border-[#503f4f] bg-white dark:bg-[#251d25] hover:bg-slate-50 transition-all">
                        <span class="material-symbols-outlined text-[22px]">ios</span>
                        <span class="text-sm font-bold text-slate-700 dark:text-white">Apple</span>
                    </button>
                </div>

                <div class="relative flex items-center gap-4">
                    <div class="h-px flex-1 bg-slate-200 dark:bg-[#362b36]"></div>
                    <span class="text-xs font-semibold text-slate-400 dark:text-[#6b586b] uppercase tracking-wider">Or email</span>
                    <div class="h-px flex-1 bg-slate-200 dark:bg-[#362b36]"></div>
                </div>

                <form action="{{ url('register_member') }}" method="POST" class="flex flex-col gap-5">
                    @csrf
                    
                    <label class="flex flex-col gap-2">
                        <span class="text-sm font-medium text-slate-700 dark:text-tertiary-cream">Full Name</span>
                        <div class="relative group">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-primary transition-colors text-[20px]">person</span>
                            <input name="name" type="text" value="{{ old('name') }}" required class="form-input w-full rounded-lg border border-slate-200 dark:border-[#503f4f] bg-white dark:bg-[#251d25] pl-11 pr-4 h-12 text-slate-900 dark:text-white focus:border-primary focus:ring-1 focus:ring-primary transition-all @error('name') border-red-500 @enderror" placeholder="Jane Doe">
                        </div>
                        @error('name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </label>

                    <label class="flex flex-col gap-2">
                        <span class="text-sm font-medium text-slate-700 dark:text-tertiary-cream">Email Address</span>
                        <div class="relative group">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-primary transition-colors text-[20px]">mail</span>
                            <input name="email" type="email" value="{{ old('email') }}" required class="form-input w-full rounded-lg border border-slate-200 dark:border-[#503f4f] bg-white dark:bg-[#251d25] pl-11 pr-4 h-12 text-slate-900 dark:text-white focus:border-primary focus:ring-1 focus:ring-primary transition-all @error('email') border-red-500 @enderror" placeholder="name@example.com">
                        </div>
                        @error('email') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </label>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <label class="flex flex-col gap-2">
                            <span class="text-sm font-medium text-slate-700 dark:text-tertiary-cream">Country Code</span>
                            <div class="relative group">
                                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-primary transition-colors text-[20px]">flag</span>
                                <select name="country_code" required class="form-select w-full rounded-lg border border-slate-200 dark:border-[#503f4f] bg-white dark:bg-[#251d25] pl-11 pr-4 h-12 text-slate-900 dark:text-white focus:border-primary focus:ring-1 focus:ring-primary transition-all @error('password') border-red-500 @enderror">
                                    <option value="">Select Country Code</option>
                                    <option value="+1">USA (+1)</option>
                                    <option value="+44">UK (+44)</option>
                                    <option value="+91">India (+91)</option>
                                </select>
                            </div>
                        </label>
                        <label class="flex flex-col gap-2">
                            <span class="text-sm font-medium text-slate-700 dark:text-tertiary-cream">Phone No.</span>
                            <div class="relative group">
                                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-primary transition-colors text-[20px]">phone</span>
                                <input name="phone_number" type="number" required class="form-input w-full rounded-lg border border-slate-200 dark:border-[#503f4f] bg-white dark:bg-[#251d25] pl-11 pr-4 h-12 text-slate-900 dark:text-white focus:border-primary focus:ring-1 focus:ring-primary transition-all" placeholder="729777288">
                            </div>
                        </label>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <label class="flex flex-col gap-2">
                            <span class="text-sm font-medium text-slate-700 dark:text-tertiary-cream">Password</span>
                            <div class="relative group">
                                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-primary transition-colors text-[20px]">lock</span>
                                <input name="password" type="password" required class="form-input w-full rounded-lg border border-slate-200 dark:border-[#503f4f] bg-white dark:bg-[#251d25] pl-11 pr-4 h-12 text-slate-900 dark:text-white focus:border-primary focus:ring-1 focus:ring-primary transition-all @error('password') border-red-500 @enderror" placeholder="Min. 8 chars">
                            </div>
                        </label>
                        <label class="flex flex-col gap-2">
                            <span class="text-sm font-medium text-slate-700 dark:text-tertiary-cream">Confirm</span>
                            <div class="relative group">
                                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-primary transition-colors text-[20px]">lock_reset</span>
                                <input name="password_confirmation" type="password" required class="form-input w-full rounded-lg border border-slate-200 dark:border-[#503f4f] bg-white dark:bg-[#251d25] pl-11 pr-4 h-12 text-slate-900 dark:text-white focus:border-primary focus:ring-1 focus:ring-primary transition-all" placeholder="Re-enter">
                            </div>
                        </label>
                    </div>
                    @error('password') <span class="text-red-500 text-xs -mt-2">{{ $message }}</span> @enderror

                    <label class="flex items-start gap-3 mt-2 cursor-pointer group">
                        <input name="terms" type="checkbox" required class="peer h-5 w-5 rounded border border-slate-300 dark:border-[#503f4f] bg-white dark:bg-[#251d25] checked:bg-primary transition-all">
                        <span class="text-sm text-slate-600 dark:text-[#b5a1b4] leading-tight select-none">
                            I agree to the <a class="text-primary font-medium hover:underline" href="#">Terms</a>.
                        </span>
                    </label>

                    <button type="submit" class="mt-4 flex w-full items-center justify-center rounded-lg h-12 bg-primary hover:bg-primary/90 text-[#171217] text-base font-bold shadow-lg shadow-primary/20 transition-all">
                        Create Account
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
@endsection