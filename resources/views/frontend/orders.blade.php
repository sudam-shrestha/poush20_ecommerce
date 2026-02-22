<x-frontend-layout>
    <div class="my-6">

        <!-- Breadcrumb -->
        <nav class="text-sm text-(--text-color)/70 mb-8">
            <ol class="flex items-center gap-2">
                <li><a href="{{ route('home') }}" class="hover:text-(--secondary-color)">Home</a></li>
                <li><i class="fa-solid fa-chevron-right text-xs"></i></li>
                <li class="font-medium text-(--primary-color)">My Orders</li>
            </ol>
        </nav>

        <h1 class="text-3xl md:text-4xl font-bold text-(--primary-color) mb-10">
            My Orders
        </h1>

        @if ($orders->isEmpty())
            <div class="bg-white rounded-2xl shadow-sm border border-(--primary-color)/5 p-8 text-center">
                <i class="fa-solid fa-box-open text-6xl text-(--text-color)/30 mb-4"></i>
                <h3 class="text-xl font-semibold text-(--text-color)/80 mb-2">No orders yet</h3>
                <p class="text-(--text-color)/60 mb-6">When you place an order, it will appear here.</p>
                <a href="{{ route('home') }}"
                    class="inline-block bg-(--secondary-color) hover:bg-(--secondary-color)/90 text-white font-semibold py-3 px-8 rounded-xl transition">
                    Start Shopping
                </a>
            </div>
        @else
            <div class="space-y-8">
                @foreach ($orders as $order)
                    <div class="bg-white rounded-2xl shadow-sm border border-(--primary-color)/5 overflow-hidden">
                        <!-- Order Header -->
                        <div
                            class="bg-(--primary-color)/5 px-6 py-4 border-b border-(--primary-color)/10 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                            <div>
                                <h2 class="text-lg font-semibold text-(--primary-color)">
                                    Order #{{ $order->id }}
                                </h2>
                                <p class="text-sm text-(--text-color)/70 mt-1">
                                    Placed on {{ $order->created_at->format('d M Y, h:i A') }}
                                </p>
                            </div>

                            <div class="flex items-center gap-4 flex-wrap">
                                <span class="text-sm font-medium text-(--text-color)/80">
                                    {{ $order->order_items->count() }}
                                    item{{ $order->order_items->count() != 1 ? 's' : '' }}
                                </span>

                                @php
                                    $status = $order->status ?? 'pending'; // fallback if status column missing
                                    $statusClasses = [
                                        'pending' => 'bg-yellow-100 text-yellow-800 border-yellow-300',
                                        'processing' => 'bg-blue-100 text-blue-800 border-blue-300',
                                        'shipped' => 'bg-indigo-100 text-indigo-800 border-indigo-300',
                                        'delivered' => 'bg-green-100 text-green-800 border-green-300',
                                        'cancelled' => 'bg-red-100 text-red-800 border-red-300',
                                    ];
                                    $statusBadge =
                                        $statusClasses[strtolower($status)] ??
                                        'bg-gray-100 text-gray-800 border-gray-300';
                                @endphp

                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium border {{ $statusBadge }}">
                                    {{ ucfirst($status) }}
                                </span>
                            </div>
                        </div>

                        <!-- Order Items -->
                        <div class="p-6 space-y-5">
                            @foreach ($order->order_items as $item)
                                @php
                                    $product = $item->product;
                                    $variant = $item->product_varient;
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
                                        <p class="font-medium text-(--primary-color) line-clamp-2">
                                            {{ $product->name }}
                                        </p>
                                        @if ($variant && $variant->title)
                                            <p class="text-sm text-(--text-color)/70">Variant: {{ $variant->title }}
                                            </p>
                                        @endif
                                        <p class="text-sm mt-1">
                                            {{ $item->qty }} × Rs.
                                            {{ number_format($item->amount / $item->qty, 2) }}
                                        </p>
                                    </div>

                                    <div class="text-right font-medium text-(--secondary-color)">
                                        Rs. {{ number_format($item->amount, 2) }}
                                    </div>
                                </div>
                            @endforeach

                            <!-- Totals -->
                            <div class="border-t border-(--primary-color)/10 pt-5 mt-5 space-y-3">
                                <div class="flex justify-between text-(--text-color)/80">
                                    <span>Total Amount</span>
                                    <span class="font-semibold text-(--primary-color)">
                                        Rs. {{ number_format($order->total_amount, 2) }}
                                    </span>
                                </div>

                                <div class="flex justify-between text-sm text-(--text-color)/70">
                                    <span>Payment Method</span>
                                    <span
                                        class="capitalize">{{ $order->payment_method === 'cod' ? 'Cash on Delivery' : $order->payment_method }}</span>
                                </div>

                                @if ($order->payment_status)
                                    <div class="flex justify-between text-sm">
                                        <span>Payment Status</span>
                                        <span
                                            class="font-medium capitalize {{ $order->payment_status === 'success' || $order->payment_status === 'paid' ? 'text-green-600' : 'text-red-600' }}">
                                            {{ $order->payment_status }}
                                        </span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Footer Actions -->
                        <div
                            class="px-6 py-4 bg-(--primary-color)/5 border-t border-(--primary-color)/10 flex justify-between items-center flex-wrap gap-4">
                            <a href="#" class="text-(--secondary-color) hover:underline text-sm font-medium">
                                View Order Details / Invoice
                            </a>

                            @if (strtolower($order->status ?? '') === 'pending' || strtolower($order->status ?? '') === 'processing')
                                <form action="{{route('order.cancel', $order->id)}}" method="post">
                                    @csrf
                                    @method("patch")
                                    <button type="submit" class="text-red-600 hover:text-red-700 text-sm font-medium">
                                        Cancel Order
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </div>
</x-frontend-layout>
