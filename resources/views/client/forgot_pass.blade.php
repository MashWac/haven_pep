@extends('layouts.client')

@section('headers')
@endsection

@section('content')
<body class="bg-background-light dark:bg-background-dark font-display text-slate-900 dark:text-white antialiased min-h-screen flex flex-col">
    @include('layouts.include.dark_header')
    
    <div class="flex min-h-screen flex-1">
        <div class="relative hidden w-0 flex-1 lg:block">
            <div class="absolute inset-0 h-full w-full bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?auto=format&fit=crop&q=80&w=1000');"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-background-dark via-background-dark/40 to-transparent opacity-90"></div>
            
            <div class="absolute inset-0 flex flex-col justify-between p-12 z-10">
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-primary/20 text-primary backdrop-blur-sm">
                        <span class="material-symbols-outlined text-2xl">spa</span>
                    </div>
                    <span class="text-xl font-bold tracking-wide text-white">WellnessFlow</span>
                </div>
                <div class="max-w-md">
                    <h2 class="text-3xl font-bold leading-tight text-white mb-4">
                        "The journey of a thousand miles begins with a single step."
                    </h2>
                    <p class="text-lg text-tertiary font-medium text-white/80">
                        Join over 50,000 community members transforming their lives through daily practice.
                    </p>
                </div>
            </div>
        </div>

        <div class="flex flex-1 flex-col justify-center px-4 py-12 sm:px-6 lg:flex-none lg:px-20 xl:px-24 bg-background-light dark:bg-background-dark">
            <div class="mx-auto w-full max-w-sm lg:w-96">
                
                <div class="flex flex-col gap-2 text-center lg:text-left">
                    <h1 class="text-3xl font-extrabold tracking-tight text-slate-900 dark:text-white">Password Reset</h1>
                    <p class="text-sm text-slate-500 dark:text-[#b5a1b4]">Forgot your password? No problem. Just let us know your email address and we will email you a password reset link.</p>
                </div>

                @if (session('status'))
                    <div class="mt-6 p-4 rounded-lg bg-green-500/10 border border-green-500/50 text-green-500 text-sm font-medium">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="mt-10">
                    <form action="{{ url('/send_password_reset_link') }}" method="POST" class="space-y-6">
                        @csrf

                        <div>
                            <label class="block text-sm font-medium leading-6 text-slate-900 dark:text-white" for="email">Email address</label>
                            <div class="mt-2 relative rounded-lg shadow-sm">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <span class="material-symbols-outlined text-[#b5a1b4] text-[20px]">mail</span>
                                </div>
                                <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                                    class="block w-full rounded-lg border-0 py-3 pl-10 pr-3 text-slate-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-primary sm:text-sm dark:bg-surface-dark dark:text-white dark:ring-border-dark @error('email') ring-red-500 @enderror" 
                                    placeholder="name@example.com">
                            </div>
                            @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="text-sm">
                                <a class="font-semibold text-secondary hover:text-secondary/80 flex items-center gap-1" href="{{ url('/login') }}">
                                    <span class="material-symbols-outlined text-sm">arrow_back</span> Back to Login
                                </a>
                            </div>
                        </div>

                        <div>
                            <button class="flex w-full justify-center rounded-lg bg-primary px-3 py-3 text-sm font-bold leading-6 text-white shadow-sm hover:bg-primary/90 transition-all" type="submit">
                                Email Password Reset Link
                            </button>
                        </div>
                    </form>

                    <div class="mt-8 text-center">
                        <p class="text-sm text-slate-500 dark:text-[#b5a1b4]">
                            New to WellnessFlow?
                            <a class="font-semibold text-secondary hover:text-secondary/80 ml-1" href="{{ url('/register') }}">Create an account</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection