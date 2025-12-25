@extends('layouts.client')

@section('content')
<body class="bg-background-light dark:bg-background-dark text-[#171217] dark:text-white font-display overflow-x-hidden antialiased">
    <div class="relative flex h-auto min-h-screen w-full flex-col">
        @include('../layouts/include/dark_header')

        <main class="layout-container flex h-full grow flex-col py-8 px-4 md:px-10 lg:px-20 xl:px-40">
            <div class="max-w-[1000px] mx-auto w-full">
                
                <div class="mb-8">
                    <h1 class="text-white text-3xl md:text-4xl font-black leading-tight tracking-[-0.033em] flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary text-4xl">shield_person</span>
                        Complete Your Payment
                    </h1>
                    <p class="text-[#b5a1b4] mt-2">Please select your payment method below to finalize your wellness order.</p>
                </div>

                <div class="bg-surface-dark border border-border-dark rounded-2xl shadow-2xl overflow-hidden relative">
                    
                    <div id="iframe-loader" class="absolute inset-0 flex flex-col items-center justify-center bg-surface-dark z-10">
                        <div class="w-12 h-12 border-4 border-primary border-t-transparent rounded-full animate-spin"></div>
                        <p class="mt-4 text-[#b5a1b4] font-medium">Securing connection to PesaPal...</p>
                    </div>

                    <div class="w-full h-full min-h-[700px]">
                        <iframe 
                            src="{{ $iframe_src }}" 
                            width="100%" 
                            height="700px" 
                            scrolling="yes" 
                            frameBorder="0"
                            onload="document.getElementById('iframe-loader').style.display='none';"
                            class="w-full border-none"
                        >
                            <p class="text-white p-10 text-center">Your browser is unable to load the payment module.</p>
                        </iframe>
                    </div>
                </div>

                <div class="mt-8 flex flex-col sm:flex-row items-center justify-between gap-4 border-t border-border-dark pt-6">
                    <div class="flex items-center gap-2 text-[#b5a1b4] text-sm">
                        <span class="material-symbols-outlined text-green-400">verified_user</span>
                        Your transaction is encrypted and secure
                    </div>
                    <div class="flex items-center gap-4 opacity-40 grayscale hover:grayscale-0 transition-all">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/5/5e/Visa_Inc._logo.svg" class="h-4" alt="Visa">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/2/2a/Mastercard-logo.svg" class="h-6" alt="Mastercard">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/b/b5/PayPal.svg" class="h-5" alt="PayPal">
                    </div>
                </div>

                <div class="mt-6 text-center">
                    <a href="{{ url('/cart') }}" class="text-[#b5a1b4] hover:text-white text-sm font-medium transition-colors flex items-center justify-center gap-1">
                        <span class="material-symbols-outlined text-base">arrow_back</span>
                        Back to Cart
                    </a>
                </div>
            </div>
        </main>
    </div>
</body>
@endsection