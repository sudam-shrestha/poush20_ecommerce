@props(['product'])

@php
    $image = $product->product_varients->first()->images[0];
@endphp

<div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition overflow-hidden group">
    <div
        class="h-48 bg-linear-to-br from-(--primary-color)/10 to-(--secondary-color)/10 flex items-center justify-center relative">
        <img class="w-full h-48 object-cover" src="{{ asset(Storage::url($image)) }}" alt="{{ $product->name }}">

        <!-- badge -->
        @if ($product->discount > 0)
            <span
                class="absolute top-3 left-3 bg-(--secondary-color) text-white text-xs font-bold px-2 py-1 rounded-full">-{{ $product->discount }}%</span>
        @endif
    </div>
    <div class="p-4">
        <h3 class="font-semibold text-lg truncate">{{ $product->name }}</h3>
        <div class="text-sm line-clamp-1 text-gray-500 mb-2">{!! $product->description !!}</div>
        <a href="{{route('product', $product->id)}}"
            class="mt-3 w-full bg-(--primary-color) text-white py-2 rounded-xl hover:bg-(--secondary-color) transition flex items-center justify-center gap-2 text-sm font-medium">
            <i class="fa-solid fa-arrow-right"></i> View Product
        </a>
    </div>
</div>
