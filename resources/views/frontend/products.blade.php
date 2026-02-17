<x-frontend-layout>
    <section>
        <div class="flex items-center justify-between mb-5 py-16">
            <h2 class="text-2xl md:text-3xl font-bold text-(--primary-color)">
                <i class="fa-regular fa-star mr-2 text-(--secondary-color)"></i>Trending now
            </h2>
        </div>

        <!-- Card grid: responsive (1 on mobile, 2-4 on larger) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ($products as $product)
                <x-product-card :product="$product" />
            @endforeach
        </div>
    </section>
</x-frontend-layout>
