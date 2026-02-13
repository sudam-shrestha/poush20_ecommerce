<x-frontend-layout>
    <section class="relative rounded-3xl overflow-hidden my-12 md:my-16 shadow-xl">
        <!-- background gradient with secondary/primary -->
        <div class="absolute inset-0 bg-gradient-to-r from-(--primary-color) to-(--secondary-color) opacity-90">
        </div>
        <!-- abstract pattern overlay (optional) -->
        <div class="absolute inset-0 opacity-10"
            style="background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI0MCIgaGVpZ2h0PSI0MCIgdmlld0JveD0iMCAwIDQwIDQwIj48cGF0aCBkPSJNMjAgMjBhMTAgMTAgMCAwIDEgMTAgMTAgMTAgMTAgMCAwIDEtMTAgMTAgMTAgMTAgMCAwIDEtMTAtMTAgMTAgMTAgMCAwIDEgMTAtMTB6IiBmaWxsPSIjZmZmIi8+PC9zdmc+'); background-repeat: repeat;">
        </div>

        <div
            class="relative px-6 py-10 md:py-16 md:px-12 text-white flex flex-col md:flex-row items-center justify-between gap-8">
            <!-- left text -->
            <div class="max-w-xl text-center md:text-left">
                <h1 class="text-3xl md:text-5xl font-bold leading-tight">
                    Fresh styles, <br>
                    <span class="underline decoration-white/30">just a click away</span>
                </h1>
                <p class="mt-4 text-white/90 text-base md:text-lg max-w-md mx-auto md:mx-0">
                    Discover the latest trends. Exclusive discounts for new members.
                </p>
                <div class="mt-6 flex flex-wrap gap-3 justify-center md:justify-start">
                    <a href="#"
                        class="bg-white text-(--primary-color) px-6 py-3 rounded-full font-semibold shadow-md hover:bg-gray-100 transition flex items-center gap-2">
                        <i class="fa-solid fa-bolt"></i> Shop now
                    </a>
                    <a href="#"
                        class="border border-white text-white px-6 py-3 rounded-full font-semibold hover:bg-white/20 transition flex items-center gap-2">
                        <i class="fa-regular fa-compass"></i> Explore
                    </a>
                </div>
            </div>
            <!-- right side (hero graphic) using FA icon stack as visual -->
            <div class="flex items-center justify-center bg-white/10 p-6 rounded-full backdrop-blur-sm">
                <div class="relative">
                    <i class="fa-solid fa-shirt text-8xl text-white drop-shadow-2xl"></i>
                    <i class="fa-solid fa-tag absolute -bottom-2 -right-4 text-4xl text-yellow-300 rotate-12"></i>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="flex items-center justify-between mb-5">
            <h2 class="text-2xl md:text-3xl font-bold text-(--primary-color)">
                <i class="fa-regular fa-star mr-2 text-(--secondary-color)"></i>Trending now
            </h2>
            <a href="#"
                class="text-(--secondary-color) hover:underline flex items-center gap-1 text-sm md:text-base">
                View all <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>

        <!-- Card grid: responsive (1 on mobile, 2-4 on larger) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <x-product-card />
            <x-product-card />
            <x-product-card />
            <x-product-card />
            <x-product-card />
            <x-product-card />
            <x-product-card />
            <x-product-card />
        </div>
    </section>


    <section
        class="bg-white/90 backdrop-blur-sm my-12 md:my-16 rounded-3xl shadow-soft border border-(--primary-color)/10 overflow-hidden">

        <!-- decorative top bar with gradient -->
        <div class="h-2 bg-gradient-to-r from-(--primary-color) to-(--secondary-color)"></div>

        <div class="p-6 md:p-8 lg:p-10">
            <!-- heading area -->
            <div class="flex items-center gap-3 mb-6">
                <div class="bg-(--primary-color)/10 p-3 rounded-full">
                    <i class="fa-solid fa-store text-2xl" style="color: var(--primary-color);"></i>
                </div>
                <div>
                    <h2 class="text-2xl md:text-3xl font-bold text-(--primary-color) tracking-tight">
                        Become a seller
                    </h2>
                    <p class="text-(--text-color)/70 text-sm md:text-base mt-1">
                        Register your shop — we’ll review and get you onboarded.
                    </p>
                </div>
            </div>

            <!-- seller registration form (name, email, shop_name, contact) -->
            <form action="{{route('seller.request')}}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-5 gap-y-5">
                @csrf
                <!-- full name field (first row, spans full width on mobile, single on md) -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-(--primary-color) mb-1.5" for="fullname">
                        <i class="fa-regular fa-user mr-1.5 text-(--secondary-color)"></i>Full name
                    </label>
                    <input type="text" id="fullname" name="name" placeholder="e.g. John Doe" required
                        class="w-full px-5 py-3 rounded-xl border border-(--primary-color)/20 bg-white/80 focus:border-(--secondary-color) focus:ring-2 focus:ring-(--secondary-color)/30 outline-none transition text-(--text-color)">
                    @error('name')
                        <p class="text-xs text-red-500 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- email field -->
                <div>
                    <label class="block text-sm font-semibold text-(--primary-color) mb-1.5" for="email">
                        <i class="fa-regular fa-envelope mr-1.5 text-(--secondary-color)"></i>Email address
                    </label>
                    <input type="email" id="email" name="email" placeholder="seller@example.com" required
                        class="w-full px-5 py-3 rounded-xl border border-(--primary-color)/20 bg-white/80 focus:border-(--secondary-color) focus:ring-2 focus:ring-(--secondary-color)/30 outline-none transition">
                    @error('email')
                        <p class="text-xs text-red-500 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- shop name field -->
                <div>
                    <label class="block text-sm font-semibold text-(--primary-color) mb-1.5" for="shop_name">
                        <i class="fa-solid fa-shop mr-1.5 text-(--secondary-color)"></i>Shop name
                    </label>
                    <input type="text" id="shop_name" name="shop_name" placeholder="e.g. TrendyCorner" required
                        class="w-full px-5 py-3 rounded-xl border border-(--primary-color)/20 bg-white/80 focus:border-(--secondary-color) focus:ring-2 focus:ring-(--secondary-color)/30 outline-none transition">
                    @error('shop_name')
                        <p class="text-xs text-red-500 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- contact field (phone) - spans full width under on md, but we'll keep in same row if space, but using grid we set md:col-span-2 so it goes to second row, better put it separate row for clarity: change to col-span-2 -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-(--primary-color) mb-1.5" for="contact">
                        <i class="fa-solid fa-phone mr-1.5 text-(--secondary-color)"></i>Contact number
                    </label>
                    <input type="tel" id="contact" name="contact" placeholder="+1 234 567 890" required
                        class="w-full px-5 py-3 rounded-xl border border-(--primary-color)/20 bg-white/80 focus:border-(--secondary-color) focus:ring-2 focus:ring-(--secondary-color)/30 outline-none transition">
                    @error('contact')
                        <p class="text-xs text-red-500 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- additional hint or note (could be terms, not a field) -->
                <div class="md:col-span-2 text-xs text-(--text-color)/60 flex items-center gap-2 mt-2">
                    <i class="fa-regular fa-clock"></i>
                    <span>After registration, our team will review your details and send an approval email within 2–3
                        business days.</span>
                </div>

                <!-- submit button (full width) -->
                <div class="md:col-span-2 mt-2">
                    <button type="submit"
                        class="w-full bg-(--primary-color) hover:bg-(--secondary-color) text-white font-semibold py-3.5 px-6 rounded-xl transition duration-200 flex items-center justify-center gap-3 text-base shadow-md">
                        <i class="fa-solid fa-paper-plane"></i>
                        <span>Submit registration request</span>
                    </button>
                </div>

                <!-- small note: existing seller? (optional) -->
                <div class="md:col-span-2 -mt-2 text-center text-sm text-(--text-color)/60">
                    Already have a seller account? <a href="#"
                        class="text-(--secondary-color) hover:underline font-medium">Log in here</a>
                </div>
            </form>
        </div>

        <!-- extra bottom illustration / brand strip (optional) -->
        <div
            class="bg-(--bg-color)/50 px-6 py-3 flex flex-wrap items-center justify-between text-xs text-(--primary-color) border-t border-(--primary-color)/10">
            <span class="flex items-center gap-1"><i
                    class="fa-solid fa-circle-check text-(--secondary-color)"></i> No joining fee</span>
            <span class="flex items-center gap-1"><i
                    class="fa-solid fa-circle-check text-(--secondary-color)"></i> 7% commission</span>
            <span class="flex items-center gap-1"><i
                    class="fa-solid fa-circle-check text-(--secondary-color)"></i> Payouts twice a
                month</span>
        </div>
    </section>
</x-frontend-layout>
