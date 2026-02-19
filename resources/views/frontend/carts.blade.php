<x-frontend-layout>
    <div class="my-6">
        <!-- Breadcrumb -->
        <nav class="text-sm text-(--text-color)/70 mb-8">
            <ol class="flex items-center gap-2">
                <li><a href="{{ route('home') }}" class="hover:text-(--secondary-color)">Home</a></li>
                <li><i class="fa-solid fa-chevron-right text-xs"></i></li>
                <li class="font-medium text-(--primary-color)">Shopping Cart</li>
            </ol>
        </nav>

        <h1 class="text-3xl md:text-4xl font-bold text-(--primary-color) mb-10">
            Your Cart
        </h1>

        @if ($carts->isEmpty())
            <div class="text-center py-16 bg-gray-50 rounded-2xl border border-dashed border-(--text-color)/30">
                <i class="fa-solid fa-cart-shopping text-6xl text-(--text-color)/40 mb-6"></i>
                <h2 class="text-2xl font-semibold text-(--primary-color) mb-3">Your cart is empty</h2>
                <p class="text-(--text-color)/70 mb-8 max-w-md mx-auto">
                    Looks like you haven't added anything yet. Start shopping now!
                </p>
                <a href="{{ route('home') }}"
                   class="inline-block bg-(--primary-color) text-white font-semibold py-4 px-10 rounded-xl hover:bg-(--primary-color)/90 transition">
                    Continue Shopping
                </a>
            </div>
        @else
            @php
                $groupedCarts = $carts->groupBy('seller_id');
                $grandTotal = $carts->sum(fn($c) => $c->amount * $c->qty);
            @endphp

            @foreach ($groupedCarts as $seller_id => $sellerCarts)
                @php
                    $seller = $sellerCarts->first()->seller;
                    $sellerName = $seller ? $seller->name : 'Unknown Seller';
                    $sellerSubtotal = $sellerCarts->sum(fn($c) => $c->amount * $c->qty);
                @endphp

                <div class="mb-12 bg-white rounded-2xl shadow-sm border border-(--primary-color)/5 overflow-hidden">
                    <!-- Seller Header -->
                    <div class="bg-(--primary-color)/5 px-6 py-4 border-b border-(--primary-color)/10">
                        <div class="flex flex-wrap justify-between items-center gap-4">
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-store text-(--primary-color) text-xl"></i>
                                <h2 class="text-xl font-semibold text-(--primary-color)">
                                    {{ $sellerName }}
                                </h2>
                            </div>
                            <div class="text-right">
                                <span class="text-sm text-(--text-color)/70">Subtotal:</span>
                                <span class="text-lg font-bold text-(--secondary-color) ml-2">
                                    Rs. {{ number_format($sellerSubtotal, 2) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Cart Items -->
                    <div class="divide-y divide-(--primary-color)/5">
                        @foreach ($sellerCarts as $cart)
                            @php
                                $variant = $cart->product_varient;
                                $product = $cart->product;
                                $mainImage = $variant?->images[0] ?? null;
                            @endphp

                            <div class="p-5 md:p-6 flex flex-col sm:flex-row gap-5 hover:bg-gray-50/50 transition">
                                <!-- Image -->
                                <div class="w-28 h-28 sm:w-32 sm:h-32 flex-shrink-0 rounded-xl overflow-hidden bg-gray-50 border border-(--text-color)/10">
                                    @if ($mainImage)
                                        <img src="{{ asset(Storage::url($mainImage)) }}" alt="{{ $product->name }}"
                                             class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-(--text-color)/40">
                                            <i class="fa-solid fa-image text-3xl"></i>
                                        </div>
                                    @endif
                                </div>

                                <!-- Details -->
                                <div class="flex-1 min-w-0">
                                    <h3 class="font-semibold text-lg text-(--primary-color) line-clamp-2 mb-1">
                                        {{ $product->name }}
                                    </h3>

                                    @if ($variant && $variant->title)
                                        <p class="text-sm text-(--text-color)/80 mb-2">
                                            Variant: <span class="font-medium">{{ $variant->title }}</span>
                                        </p>
                                    @endif

                                    <div class="flex flex-wrap items-center gap-4 text-sm mb-3">
                                        <div>
                                            <span class="text-(--text-color)/70">Unit Price:</span>
                                            <span class="font-bold text-(--secondary-color)">
                                                Rs. {{ number_format($cart->product_varient->discounted_price(), 2) }}
                                            </span>
                                        </div>
                                        <div>
                                            <span class="text-(--text-color)/70">Qty:</span>
                                            <span class="font-medium">{{ $cart->qty }}</span>
                                        </div>
                                        @if ($product->discount > 0)
                                            <span class="text-xs bg-red-100 text-red-700 px-2 py-0.5 rounded-full">
                                                -{{ $product->discount }}%
                                            </span>
                                        @endif
                                    </div>

                                    <!-- Actions -->
                                    <div class="flex flex-wrap gap-4 text-sm">
                                        <form action="{{ route('cart.update', $cart->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" name="action" value="increment"
                                                class="text-(--primary-color) hover:text-(--primary-color)/80">
                                                <i class="fa-solid fa-plus-circle"></i> Increase
                                            </button>
                                        </form>

                                        <form action="{{ route('cart.update', $cart->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" name="action" value="decrement"
                                                class="text-(--primary-color) hover:text-(--primary-color)/80">
                                                <i class="fa-solid fa-minus-circle"></i> Decrease
                                            </button>
                                        </form>

                                        <form action="{{ route('cart.destroy', $cart->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-700">
                                                <i class="fa-solid fa-trash-can"></i> Remove
                                            </button>
                                        </form>
                                    </div>
                                </div>

                                <!-- Line Total -->
                                <div class="text-right min-w-[140px] flex flex-col justify-between">
                                    <div>
                                        <div class="text-lg font-bold text-(--secondary-color)">
                                            Rs. {{ number_format($cart->amount, 2) }}
                                        </div>
                                        @if ($cart->qty > 1)
                                            <div class="text-xs text-(--text-color)/60">
                                                {{ $cart->qty }} × Rs. {{ number_format($cart->product_varient->discounted_price(), 2) }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Per-seller Checkout Button -->
                    <div class="p-6 border-t border-(--primary-color)/10 bg-gray-50/40">
                        <form action="{{ route('checkout', $seller_id) }}" method="POST" class="text-right">
                            @csrf
                            <button type="submit"
                                    class="inline-flex items-center bg-(--secondary-color) hover:bg-(--secondary-color)/90 text-white font-semibold py-3 px-8 rounded-xl transition shadow-md gap-3">
                                <i class="fa-solid fa-credit-card"></i>
                                Checkout from {{ $sellerName }}
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach

            <!-- Grand Total (informational only) & Global Continue Shopping -->
            <div class="mt-10 p-6 md:p-8 bg-(--primary-color)/5 rounded-2xl border border-(--primary-color)/10">
                <div class="flex justify-between items-center text-xl mb-6">
                    <span class="font-semibold text-(--primary-color)">Estimated Grand Total</span>
                    <span class="text-2xl font-bold text-(--secondary-color)">
                        Rs. {{ number_format($grandTotal, 2) }}
                    </span>
                </div>

                <p class="text-sm text-(--text-color)/70 mb-6 text-center">
                    Checkout separately for each seller. Shipping & payment handled per seller.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('home') }}"
                       class="flex-1 max-w-sm text-center py-4 px-8 border-2 border-(--primary-color) text-(--primary-color) font-semibold rounded-xl hover:bg-(--primary-color)/5 transition">
                        Continue Shopping
                    </a>
                </div>
            </div>
        @endif
    </div>
</x-frontend-layout>
