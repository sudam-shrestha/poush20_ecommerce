<x-frontend-layout>
    <!-- Breadcrumb -->
    <nav class="my-6 text-sm text-(--text-color)/70">
        <ol class="flex items-center gap-2">
            <li><a href="{{ route('home') }}" class="hover:text-(--secondary-color)">Home</a></li>
            <li><i class="fa-solid fa-chevron-right text-xs"></i></li>
            <li class="font-medium text-(--primary-color)">{{ $product->name }}</li>
        </ol>
    </nav>

    <!-- Main Product Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-16 my-8 md:my-12">
        <!-- Left: Images (main + thumbnails) -->
        <div class="space-y-6">
            <!-- Main image (shows selected variant image) -->
            <div class="relative rounded-2xl overflow-hidden shadow-xl bg-gray-50 aspect-square">
                <img src="{{ asset(Storage::url($product->product_varients->first()?->images[0])) }}"
                    alt="{{ $product->name }}" id="mainProductImage"
                    class="w-full h-full object-cover transition-opacity duration-500">

                @if ($product->discount > 0)
                    <div
                        class="absolute top-4 left-4 bg-red-500 text-white text-sm font-bold px-4 py-2 rounded-full shadow-md">
                        -{{ $product->discount }}%
                    </div>
                @endif
            </div>

            <!-- Thumbnail gallery (only if multiple variants or images) -->
            @if (
                $product->product_varients->count() > 1 ||
                    ($product->product_varients->first()?->images && count($product->product_varients->first()->images) > 1))
                <div class="grid grid-cols-5 gap-3">
                    @foreach ($product->product_varients as $varient)
                        @foreach ($varient->images ?? [] as $index => $img)
                            @if ($index < 5)
                                <!-- limit thumbnails for cleanliness -->
                                <button type="button"
                                    class="variant-thumb rounded-lg overflow-hidden border-2 border-transparent hover:border-(--secondary-color) transition focus:outline-none focus:border-(--secondary-color)"
                                    data-main-img="{{ asset(Storage::url($img)) }}" data-varient-id="{{ $varient->id }}">
                                    <img src="{{ asset(Storage::url($img)) }}" alt="Thumbnail" class="w-full h-20 object-cover">
                                </button>
                            @endif
                        @endforeach
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Right: Product Info & Variants -->
        <div class="space-y-8">
            <div>
                <h1 class="text-3xl md:text-4xl font-bold text-(--primary-color) leading-tight">
                    {{ $product->name }}
                </h1>

                <div class="mt-4 flex items-center gap-4 flex-wrap">
                    @php
                        $lowestPrice = $product->product_varients->min('price') ?? 0;
                        $highestPrice = $product->product_varients->max('price') ?? 0;
                    @endphp

                    <div class="text-2xl font-bold text-(--secondary-color)">
                        @if ($lowestPrice == $highestPrice)
                            Rs. {{ number_format($lowestPrice, 2) }}
                        @else
                            Rs. {{ number_format($lowestPrice, 2) }} — {{ number_format($highestPrice, 2) }}
                        @endif
                    </div>

                    @if ($product->discount > 0)
                        <span class="text-lg text-(--text-color)/60 line-through">
                            Rs. {{ number_format(($lowestPrice * (100 + $product->discount)) / 100, 2) }}
                        </span>
                    @endif

                    <span
                        class="text-sm px-3 py-1 rounded-full {{ $product->stock ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                        {{ $product->stock ? 'In Stock' : 'Out of Stock' }}
                    </span>
                </div>

                <p class="mt-2 text-sm text-(--text-color)/70">
                    Sold by: <strong
                        class="text-(--primary-color)">{{ $product->seller->name ?? 'Unknown Seller' }}</strong>
                </p>
            </div>

            <!-- Variant Selection -->
            @if ($product->product_varients->count() > 1)
                <div class="space-y-6">
                    <h3 class="text-xl font-semibold text-(--primary-color)">Select Variant</h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach ($product->product_varients as $varient)
                            <label
                                class="variant-option relative flex items-center p-4 border rounded-xl cursor-pointer transition hover:border-(--secondary-color) has-[:checked]:border-(--secondary-color) has-[:checked]:bg-(--secondary-color)/5">
                                <input type="radio" name="varient_id" value="{{ $varient->id }}"
                                    class="absolute inset-0 opacity-0 cursor-pointer"
                                    {{ $loop->first ? 'checked' : '' }}>
                                <div class="flex-1">
                                    <div class="font-medium">{{ $varient->title }}</div>
                                    <div class="text-sm text-(--secondary-color) mt-1">
                                        Rs. {{ number_format($varient->price, 2) }}
                                    </div>
                                </div>
                                <div class="w-10 h-10 rounded-lg overflow-hidden flex-shrink-0 ml-4">
                                    <img src="{{ asset(Storage::url($varient->images[0])) }}"
                                        alt="{{ $varient->title }}" class="w-full h-full object-cover">
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Description -->
            <div class="prose prose-(--primary-color) max-w-none">
                <h3 class="text-xl font-semibold text-(--primary-color) mb-4">Description</h3>
                {!! $product->description !!}
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-wrap gap-4 pt-6 border-t border-(--primary-color)/10">
                <button
                    class="flex-1 bg-(--primary-color) hover:bg-(--primary-color)/90 text-white font-semibold py-4 px-8 rounded-xl transition shadow-md flex items-center justify-center gap-3 min-w-[180px]"
                    {{ !$product->stock ? 'disabled' : '' }}>
                    <i class="fa-solid fa-cart-plus"></i>
                    Add to Cart
                </button>

                <button
                    class="flex-1 bg-(--secondary-color) hover:bg-(--secondary-color)/90 text-white font-semibold py-4 px-8 rounded-xl transition shadow-md flex items-center justify-center gap-3 min-w-[180px]"
                    {{ !$product->stock ? 'disabled' : '' }}>
                    <i class="fa-solid fa-bolt"></i>
                    Buy Now
                </button>
            </div>

            <!-- Stock / Seller note -->
            @if (!$product->stock)
                <p class="text-center text-red-600 font-medium mt-4">
                    This product is currently out of stock.
                </p>
            @endif
        </div>
    </div>

    <!-- Simple JavaScript for image switching -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const mainImage = document.getElementById('mainProductImage');
            const thumbs = document.querySelectorAll('.variant-thumb');

            thumbs.forEach(thumb => {
                thumb.addEventListener('click', () => {
                    const newSrc = thumb.dataset.mainImg;
                    mainImage.style.opacity = '0';
                    setTimeout(() => {
                        mainImage.src = newSrc;
                        mainImage.style.opacity = '1';
                    }, 300);
                });
            });

            // Optional: change main image when variant radio changes
            document.querySelectorAll('input[name="varient_id"]').forEach(radio => {
                radio.addEventListener('change', () => {
                    const selectedThumb = document.querySelector(
                        `.variant-thumb[data-varient-id="${radio.value}"]`);
                    if (selectedThumb) {
                        const newSrc = selectedThumb.dataset.mainImg;
                        mainImage.style.opacity = '0';
                        setTimeout(() => {
                            mainImage.src = newSrc;
                            mainImage.style.opacity = '1';
                        }, 300);
                    }
                });
            });
        });
    </script>
</x-frontend-layout>
