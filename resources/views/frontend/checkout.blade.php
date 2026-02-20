<x-frontend-layout>
    <div class="my-6">

        <!-- Breadcrumb -->
        <nav class="text-sm text-(--text-color)/70 mb-8">
            <ol class="flex items-center gap-2">
                <li><a href="{{ route('home') }}" class="hover:text-(--secondary-color)">Home</a></li>
                <li><i class="fa-solid fa-chevron-right text-xs"></i></li>
                <li><a href="{{ route('carts') }}" class="hover:text-(--secondary-color)">Cart</a></li>
                <li><i class="fa-solid fa-chevron-right text-xs"></i></li>
                <li class="font-medium text-(--primary-color)">Checkout</li>
            </ol>
        </nav>

        <h1 class="text-3xl md:text-4xl font-bold text-(--primary-color) mb-10">
            Checkout - {{ $seller->name ?? 'Seller' }}
        </h1>

        <form action="{{ route('order.store', $seller->id) }}" method="post">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- Left / Center - Form Section -->
                <div class="lg:col-span-2 space-y-8">

                    <!-- Contact Information -->
                    <div class="bg-white rounded-2xl shadow-sm border border-(--primary-color)/5 overflow-hidden">
                        <div class="bg-(--primary-color)/5 px-6 py-4 border-b border-(--primary-color)/10">
                            <h2 class="text-xl font-semibold text-(--primary-color) flex items-center gap-3">
                                <i class="fa-solid fa-phone-volume"></i>
                                Contact Information
                            </h2>
                        </div>

                        <div class="p-6 space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                                <div>
                                    <label class="block text-sm font-medium text-(--text-color)/80 mb-2">
                                        Contact Number <span class="text-red-500">*</span>
                                    </label>
                                    <input type="tel" name="contact"
                                        value="{{ old('contact', Auth::user()->delivery_address->contact ?? '') }}"
                                        placeholder="98XXXXXXXX"
                                        class="w-full px-4 py-3 rounded-xl border border-(--text-color)/20 focus:border-(--primary-color) focus:ring-2 focus:ring-(--primary-color)/20 outline-none transition"
                                        required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Shipping Address -->
                    <div class="bg-white rounded-2xl shadow-sm border border-(--primary-color)/5 overflow-hidden">
                        <div class="bg-(--primary-color)/5 px-6 py-4 border-b border-(--primary-color)/10">
                            <h2 class="text-xl font-semibold text-(--primary-color) flex items-center gap-3">
                                <i class="fa-solid fa-location-dot"></i>
                                Shipping Address
                            </h2>
                        </div>

                        <div class="p-6 space-y-6">
                            <div>
                                <label class="block text-sm font-medium text-(--text-color)/80 mb-2">
                                    Additional Details
                                </label>
                                <textarea name="address_detail" rows="2"
                                    class="w-full px-4 py-3 rounded-xl border border-(--text-color)/20 focus:border-(--primary-color) focus:ring-2 focus:ring-(--primary-color)/20 outline-none transition">{{ old('address_detail', Auth::user()->delivery_address->address_detail ?? '') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Method -->
                    <div class="bg-white rounded-2xl shadow-sm border border-(--primary-color)/5 overflow-hidden">
                        <div class="bg-(--primary-color)/5 px-6 py-4 border-b border-(--primary-color)/10">
                            <h2 class="text-xl font-semibold text-(--primary-color) flex items-center gap-3">
                                <i class="fa-solid fa-credit-card"></i>
                                Payment Method
                            </h2>
                        </div>

                        <div class="p-6">
                            <div class="space-y-4">
                                <label
                                    class="flex items-center gap-4 p-4 border rounded-xl cursor-pointer hover:border-(--primary-color) transition has-[:checked]:border-(--primary-color) has-[:checked]:bg-(--primary-color)/5">
                                    <input type="radio" name="payment_method" value="cod" checked required
                                        class="w-5 h-5 text-(--primary-color) border-(--text-color)/30 focus:ring-(--primary-color)">
                                    <div>
                                        <div class="font-medium text-(--primary-color)">Cash on Delivery (COD)</div>
                                        <div class="text-sm text-(--text-color)/70">Pay when you receive your order
                                        </div>
                                    </div>
                                </label>

                                @if ($seller->khalti_secret_key)
                                    <label
                                        class="flex items-center gap-4 p-4 border rounded-xl cursor-pointer hover:border-(--primary-color) transition has-[:checked]:border-(--primary-color) has-[:checked]:bg-(--primary-color)/5">
                                        <input type="radio" name="payment_method" value="khalti" required
                                            class="w-5 h-5 text-(--primary-color) border-(--text-color)/30 focus:ring-(--primary-color)">
                                        <div class="flex items-center gap-3">
                                            <div class="font-medium text-(--primary-color)">Pay with Khalti</div>
                                            <!-- You can add Khalti logo if you have it -->
                                            <span
                                                class="text-xs bg-purple-100 text-purple-700 px-2 py-0.5 rounded-full">Digital
                                                Wallet</span>
                                        </div>
                                    </label>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right - Order Summary -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl shadow-sm border border-(--primary-color)/5 sticky top-6">
                        <div class="p-6 border-b border-(--primary-color)/10">
                            <h3 class="text-xl font-semibold text-(--primary-color)">Order Summary</h3>
                        </div>

                        <div class="p-6 space-y-5">
                            @foreach ($carts as $cart)
                                @php
                                    $variant = $cart->product_varient;
                                    $product = $cart->product;
                                @endphp
                                <div class="flex gap-4">
                                    <div
                                        class="w-20 h-20 flex-shrink-0 rounded-lg overflow-hidden bg-gray-50 border border-(--text-color)/10">
                                        @if ($variant?->images[0])
                                            <img src="{{ asset(Storage::url($variant->images[0])) }}"
                                                alt="{{ $product->name }}" class="w-full h-full object-cover">
                                        @else
                                            <div
                                                class="w-full h-full flex items-center justify-center text-(--text-color)/40">
                                                <i class="fa-solid fa-image"></i>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="flex-1 min-w-0">
                                        <p class="font-medium text-(--primary-color) line-clamp-2">{{ $product->name }}
                                        </p>
                                        @if ($variant && $variant->title)
                                            <p class="text-sm text-(--text-color)/70">Variant: {{ $variant->title }}</p>
                                        @endif
                                        <p class="text-sm mt-1">
                                            {{ $cart->qty }} × Rs.
                                            {{ number_format($variant->discounted_price() ?? $cart->amount, 2) }}
                                        </p>
                                    </div>

                                    <div class="text-right font-medium text-(--secondary-color)">
                                        Rs. {{ number_format($cart->amount, 2) }}
                                    </div>
                                </div>
                            @endforeach

                            <div class="border-t border-(--primary-color)/10 pt-5 mt-5 space-y-3">
                                <div class="flex justify-between text-(--text-color)/80">
                                    <span>Subtotal</span>
                                    <span>Rs.
                                        {{ number_format($carts->sum(fn($c) => $c->amount), 2) }}</span>
                                </div>
                                <div
                                    class="flex justify-between text-lg font-bold text-(--primary-color) pt-3 border-t border-(--primary-color)/10">
                                    <span>Total</span>
                                    <span class="text-(--secondary-color)">
                                        Rs. {{ number_format($carts->sum(fn($c) => $c->amount), 2) }}
                                    </span>
                                </div>
                            </div>

                            <button type="submit"
                                class="w-full bg-(--secondary-color) hover:bg-(--secondary-color)/90 text-white font-semibold py-4 px-8 rounded-xl transition shadow-md flex items-center justify-center gap-3 text-lg">
                                <i class="fa-solid fa-check-circle"></i>
                                Place Order
                            </button>

                            <p class="text-xs text-center text-(--text-color)/60 mt-4">
                                By placing order you agree to our Terms & Conditions
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</x-frontend-layout>
