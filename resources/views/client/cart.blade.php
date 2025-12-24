@extends('layouts.client')
@section('content')

<body class="bg-background-light dark:bg-background-dark text-[#171217] dark:text-white font-display overflow-x-hidden antialiased">
    <div class="relative flex h-auto min-h-screen w-full flex-col">
        @include('../layouts/include/dark_header')

        <main class="layout-container flex h-full grow flex-col py-8 px-4 md:px-10 lg:px-20 xl:px-40">
            <div class="flex flex-col lg:flex-row gap-10 max-w-[1200px] mx-auto w-full">
                <div class="flex flex-col flex-1 gap-8">
                    <div>
                        <h1 class="text-white text-3xl md:text-4xl font-black leading-tight tracking-[-0.033em]">
                            Your Wellness Cart
                            <span class="text-primary font-medium text-2xl align-middle ml-2">({{ count(session('cart', [])) }} items)</span>
                        </h1>
                    </div>

                    <div class="flex flex-col gap-6">
                        @if(session('cart') && count(session('cart')) > 0)
                        @foreach(session('cart') as $key => $details)
                        <div class="group flex flex-col sm:flex-row gap-5 bg-surface-dark border border-border-dark p-4 rounded-xl hover:border-primary/30 transition-all duration-300" data-id="{{ $key }}">
                            <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-lg w-full sm:w-[120px] shrink-0 shadow-lg" style='background-image: url("{{ $details["image"] }}");'></div>

                            <div class="flex flex-1 flex-col justify-between gap-4">
                                <div>
                                    <span class="inline-block px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider {{ $details['type'] == 'book' ? 'bg-tertiary/20 text-tertiary' : 'bg-secondary/20 text-secondary' }} mb-2">
                                        {{ ucfirst($details['type']) }}
                                    </span>
                                    <h3 class="text-white text-lg font-bold leading-snug">{{ $details['name'] }}</h3>
                                    <p class="text-[#b5a1b4] text-sm mt-1">{{ $details['meta'] }}</p>
                                </div>

                                <div class="flex items-center justify-between mt-auto">
                                    <form action="{{ url('/cart/remove') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $key }}">
                                        <button type="submit" class="flex items-center gap-1 text-[#b5a1b4] hover:text-red-400 text-sm font-medium transition-colors">
                                            <span class="material-symbols-outlined text-[18px]">delete</span>
                                            <span class="hidden sm:inline">Remove</span>
                                        </button>
                                    </form>

                                    <div class="flex items-center gap-6">
                                        <div class="flex items-center bg-background-dark rounded-lg border border-border-dark p-1">
                                            <button class="update-cart-btn text-white hover:text-primary w-8 h-8 flex items-center justify-center rounded" data-action="minus"><span class="material-symbols-outlined text-[16px]">remove</span></button>
                                            <input class="cart-qty w-8 bg-transparent text-center text-white text-sm font-medium focus:outline-none border-none p-0" readonly type="number" value="{{ $details['quantity'] }}" />
                                            <button class="update-cart-btn text-white hover:text-primary w-8 h-8 flex items-center justify-center rounded" data-action="plus"><span class="material-symbols-outlined text-[16px]">add</span></button>
                                        </div>

                                        <div class="flex flex-col items-end min-w-[80px]">
                                            @if($details['discount'] > 0)
                                            <span class="text-[#b5a1b4] text-xs line-through">
                                                ${{ number_format($details['original_price'] * $details['quantity'], 2) }}
                                            </span>
                                            <p class="text-primary text-lg font-bold">
                                                ${{ number_format($details['price'] * $details['quantity'], 2) }}
                                            </p>
                                            @else
                                            <p class="text-white text-lg font-bold">
                                                ${{ number_format($details['price'] * $details['quantity'], 2) }}
                                            </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @else
                        <div class="text-center py-20 bg-surface-dark rounded-xl border border-dashed border-border-dark">
                            <span class="material-symbols-outlined text-6xl text-[#b5a1b4] mb-4">shopping_cart_off</span>
                            <p class="text-[#b5a1b4] text-xl">Your cart is empty.</p>
                            <a href="/shop" class="text-primary font-bold mt-4 inline-block hover:underline">Continue Shopping</a>
                        </div>
                        @endif
                    </div>
                </div>

                <div class="w-full lg:w-[380px] shrink-0">
                    <div class="sticky top-24 flex flex-col gap-6">
                        <div class="bg-surface-dark border border-border-dark p-6 rounded-xl shadow-xl">
                            <h2 class="text-white text-xl font-bold mb-6">Order Summary</h2>

                            <div class="flex flex-col gap-4 mb-6 border-b border-border-dark pb-6">
                                <div class="flex justify-between text-[#b5a1b4]">
                                    <span>Subtotal</span>
                                    <span class="font-medium text-white">${{ number_format($original_subtotal, 2) }}</span>
                                </div>

                                @if($savings > 0)
                                <div class="flex justify-between text-green-400 text-sm">
                                    <span>Total Savings</span>
                                    <span class="font-medium">-${{ number_format($savings, 2) }}</span>
                                </div>
                                @endif

                                <div class="flex justify-between text-[#b5a1b4]">
                                    <span>Shipping</span>
                                    <span class="font-medium text-green-400">Calculated at checkout</span>
                                </div>
                            </div>

                            <div class="flex justify-between items-end mb-8">
                                <span class="text-white font-medium text-lg">Total</span>
                                <div class="flex flex-col items-end">
                                    <span class="text-3xl font-black text-white">${{ number_format($total, 2) }}</span>
                                    <p class="text-[10px] text-[#b5a1b4] uppercase tracking-widest mt-1">Includes VAT</p>
                                </div>
                            </div>
                            <form action="{{ url('/checkout') }}" method="POST">
                                @csrf
                                <button class="w-full bg-primary hover:bg-[#c95cc6] text-[#171217] text-lg font-bold py-3.5 rounded-lg transition-transform active:scale-[0.98] shadow-[0_0_15px_rgba(218,113,215,0.3)] flex items-center justify-center gap-2 group">
                                    <span class="material-symbols-outlined font-bold group-hover:translate-x-0.5 transition-transform">lock</span>
                                    Secure Checkout
                                </button>
                            </form>
                            <div class="mt-6 flex items-center justify-center gap-4 opacity-50 grayscale">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/5/5e/Visa_Inc._logo.svg" class="h-4" alt="Visa">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/2/2a/Mastercard-logo.svg" class="h-6" alt="Mastercard">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/b/b5/PayPal.svg" class="h-5" alt="PayPal">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(".update-cart-btn").click(function(e) {
        e.preventDefault();
        var ele = $(this);
        var action = ele.attr("data-action");
        var parent = ele.parents(".group");
        var quantityInput = parent.find(".cart-qty");
        var currentQty = parseInt(quantityInput.val());

        var newQty = (action === "plus") ? currentQty + 1 : (currentQty > 1 ? currentQty - 1 : 1);

        // Show loading state (optional)
        ele.prop('disabled', true);

        $.ajax({
            url: '{{ url("/cart/update") }}',
            method: "patch",
            data: {
                _token: '{{ csrf_token() }}',
                id: parent.attr("data-id"),
                quantity: newQty
            },
            success: function(response) {
                window.location.reload();
            },
            error: function(err) {
                ele.prop('disabled', false);
                alert("Something went wrong updating the cart.");
            }
        });
    });
</script>
@endsection