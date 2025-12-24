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
                    <div class="mt-8 flex items-center gap-4">
                        <div class="flex -space-x-3 overflow-hidden">
                            <img class="inline-block h-10 w-10 rounded-full ring-2 ring-background-dark object-cover" src="https://i.pravatar.cc/150?u=1" alt="User">
                            <img class="inline-block h-10 w-10 rounded-full ring-2 ring-background-dark object-cover" src="https://i.pravatar.cc/150?u=2" alt="User">
                            <img class="inline-block h-10 w-10 rounded-full ring-2 ring-background-dark object-cover" src="https://i.pravatar.cc/150?u=3" alt="User">
                        </div>
                        <div class="text-sm font-semibold text-white">Join the community</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex flex-1 flex-col justify-center px-4 py-12 sm:px-6 lg:flex-none lg:px-20 xl:px-24 bg-background-light dark:bg-background-dark">
            <div class="mx-auto w-full max-w-sm lg:w-96">
                <div class="lg:hidden flex items-center gap-2 mb-8 justify-center">
                    <div class="text-primary"><span class="material-symbols-outlined text-3xl">spa</span></div>
                    <span class="text-2xl font-bold text-slate-900 dark:text-white">WellnessFlow</span>
                </div>

                <div class="flex flex-col gap-2 text-center lg:text-left">
                    <h1 class="text-3xl font-extrabold tracking-tight text-slate-900 dark:text-white">Welcome Back</h1>
                    <p class="text-sm text-slate-500 dark:text-[#b5a1b4]">Please enter your details to sign in.</p>
                </div>

                <div class="mt-10">
                    <form action="{{ url('login_user') }}" method="POST" class="space-y-6">
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

                        <div>
                            <label class="block text-sm font-medium leading-6 text-slate-900 dark:text-white" for="password">Password</label>
                            <div class="mt-2 relative rounded-lg shadow-sm">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <span class="material-symbols-outlined text-[#b5a1b4] text-[20px]">lock</span>
                                </div>
                                <input id="password" name="password" type="password" required
                                    class="block w-full rounded-lg border-0 py-3 pl-10 pr-10 text-slate-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-primary sm:text-sm dark:bg-surface-dark dark:text-white dark:ring-border-dark @error('password') ring-red-500 @enderror" 
                                    placeholder="Enter your password">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer group" onclick="togglePassword()">
                                    <span id="eye-icon" class="material-symbols-outlined text-[#b5a1b4] text-[20px] group-hover:text-primary transition-colors">visibility</span>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input id="remember" name="remember" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-primary focus:ring-primary dark:border-border-dark dark:bg-surface-dark">
                                <label class="ml-2 block text-sm text-slate-700 dark:text-[#b5a1b4]" for="remember">Remember me</label>
                            </div>
                            <div class="text-sm">
                                <a class="font-semibold text-secondary hover:text-secondary/80" href="{{ url('password_reset') }}">Forgot password?</a>
                            </div>
                        </div>

                        <div>
                            <button class="flex w-full justify-center rounded-lg bg-primary px-3 py-3 text-sm font-bold leading-6 text-white shadow-sm hover:bg-primary/90 transition-all" type="submit">
                                Log In
                            </button>
                        </div>
                    </form>

                    <div class="mt-8">
                        <div class="relative">
                            <div class="absolute inset-0 flex items-center" aria-hidden="true">
                                <div class="w-full border-t border-gray-300 dark:border-border-dark"></div>
                            </div>
                            <div class="relative flex justify-center text-sm font-medium">
                                <span class="bg-background-light px-6 text-slate-500 dark:bg-background-dark dark:text-[#b5a1b4]">Or continue with</span>
                            </div>
                        </div>
                        <div class="mt-6 grid grid-cols-2 gap-4">
                            <a href="/auth/google" class="flex w-full items-center justify-center gap-3 rounded-lg bg-white dark:bg-surface-dark px-3 py-2.5 text-sm font-semibold text-slate-900 dark:text-white shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-border-dark hover:bg-gray-50 transition-colors">
                                <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="h-5 w-5" alt="Google">
                                <span>Google</span>
                            </a>
                            <button class="flex w-full items-center justify-center gap-3 rounded-lg bg-white dark:bg-surface-dark px-3 py-2.5 text-sm font-semibold text-slate-900 dark:text-white shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-border-dark hover:bg-gray-50 transition-colors">
                                <svg class="h-5 w-5 fill-current" viewbox="0 0 24 24"><path d="M13.135 6.056c-.533-2.458 1.705-4.183 3.655-4.056.326 2.37-2.018 4.383-3.655 4.056zm-1.848 10.11c-2.31 0-2.863-1.464-4.508-1.464-1.614 0-1.874 1.346-4.508 1.465C-.677 16.485-1.077 8.04 4.39 7.76c2.408.125 3.012 1.583 4.887 1.583 2.134 0 2.408-1.583 4.975-1.583 3.36.16 4.608 2.39 4.608 2.39s-2.6 1.38-2.6 4.69c0 3.513 3.013 4.385 3.013 4.385-1.96 4.63-4.32 4.473-4.32 4.473z"></path></svg>
                                <span>Apple</span>
                            </button>
                        </div>
                    </div>

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

@section('scripts')
<script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eye-icon');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.innerText = 'visibility_off';
        } else {
            passwordInput.type = 'password';
            eyeIcon.innerText = 'visibility';
        }
    }
</script>
@endsection