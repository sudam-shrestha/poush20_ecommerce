<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order #{{ $order->id }} - Receipt | Seller Panel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Google+Sans:ital,opsz,wght@0,17..18,400..700;1,17..18,400..700&display=swap');

        :root {
            --primary-color: #642571;
            --secondary-color: #ea0c95;
            --text-color: #3b3b3b;
            --bg-color: #dfdfdf;
        }

        body {
            background-color: var(--bg-color);
            color: var(--text-color);
            font-family: "Google Sans", sans-serif;
        }

        .container {
            width: 90%;
            margin: 0 auto;
        }

        button {
            cursor: pointer;
        }
    </style>

    <style>
        @media print {
            .no-print {
                display: none !important;
            }

            body {
                background: white;
                color: black;
            }

            .shadow-sm,
            .shadow-md {
                box-shadow: none !important;
            }

            .border {
                border-color: #d1d5db !important;
            }
        }

        .receipt-header {
            border-bottom: 2px dashed #e5e7eb;
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen font-sans antialiased">

    <main class="max-w-4xl mx-auto px-4 sm:px-6 py-8">

        <div class="bg-white rounded-2xl shadow-md border border-(--primary-color)/10 overflow-hidden">

            <!-- Receipt Header -->
            <div class="receipt-header px-8 py-6 text-center">
                <h2 class="text-2xl md:text-3xl font-bold text-(--primary-color) mb-1">
                    Order Receipt
                </h2>
                <p class="text-sm text-(--text-color)/70">
                    Order #{{ $order->id }} • {{ $order->created_at->format('d M Y  —  h:i A') }}
                </p>
            </div>

            <!-- Two-column layout: Customer & Shop Info + Items -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 p-8 border-b border-(--primary-color)/10">

                <!-- Left: Customer Information -->
                <div>
                    <h3 class="text-lg font-semibold text-(--primary-color) mb-4 flex items-center gap-2">
                        <i class="fa-solid fa-user"></i>
                        Customer Details
                    </h3>

                    <div class="space-y-2 text-sm">
                        <p><strong>Name:</strong> {{ $order->user?->name ?? '—' }}</p>
                        <p><strong>Contact:</strong>
                            {{ $order->user->delivery_address?->contact ?? ($order->user?->phone ?? '—') }}</p>
                        <p><strong>Address:</strong></p>
                        <p class="pl-4 text-(--text-color)/90 whitespace-pre-line">
                            {{ $order->user->delivery_address?->address_detail ?? 'No address saved' }}
                        </p>
                    </div>
                </div>

                <!-- Right: Seller / Shop Information -->
                <div>
                    <h3 class="text-lg font-semibold text-(--primary-color) mb-4 flex items-center gap-2">
                        <i class="fa-solid fa-store"></i>
                        Sold By
                    </h3>

                    <div class="space-y-2 text-sm">
                        <p><strong>Shop:</strong> {{ $order->seller->name ?? 'Your Shop' }}</p>
                        <p><strong>Payment Method:</strong>
                            <span class="capitalize">
                                {{ $order->payment_method === 'cod' ? 'Cash on Delivery' : ucfirst($order->payment_method) }}
                            </span>
                        </p>
                        <p><strong>Payment Status:</strong>
                            <span
                                class="{{ $order->payment_status === 'success' || $order->payment_status === 'paid' ? 'text-green-600' : 'text-red-600' }} font-medium capitalize">
                                {{ $order->payment_status ?? 'Pending' }}
                            </span>
                        </p>
                        @if ($order->status)
                            <p><strong>Order Status:</strong>
                                <span class="font-medium">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Order Items Table -->
            <div class="p-8">
                <h3 class="text-xl font-semibold text-(--primary-color) mb-5">
                    Order Items
                </h3>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-(--primary-color)/5 text-(--primary-color)">
                                <th class="px-4 py-3 font-semibold rounded-tl-lg">Item</th>
                                <th class="px-4 py-3 font-semibold text-center">Qty</th>
                                <th class="px-4 py-3 font-semibold text-right">Unit Price</th>
                                <th class="px-4 py-3 font-semibold text-right rounded-tr-lg">Total</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-(--primary-color)/10 text-sm">
                            @foreach ($order->order_items as $item)
                                @php
                                    $variant = $item->product_varient;
                                    $product = $item->product;
                                @endphp
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-4 py-4">
                                        <div class="font-medium text-(--primary-color)">
                                            {{ $product->name }}
                                        </div>
                                        @if ($variant && $variant->title)
                                            <div class="text-(--text-color)/70 text-xs mt-0.5">
                                                Variant: {{ $variant->title }}
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-4 py-4 text-center">{{ $item->qty }}</td>
                                    <td class="px-4 py-4 text-right">
                                        Rs. {{ number_format($item->amount / $item->qty, 2) }}
                                    </td>
                                    <td class="px-4 py-4 text-right font-medium text-(--secondary-color)">
                                        Rs. {{ number_format($item->amount, 2) }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Totals -->
                <div class="mt-8 border-t border-(--primary-color)/10 pt-6 max-w-md ml-auto space-y-3">
                    <div class="flex justify-between text-(--text-color)/80">
                        <span>Subtotal</span>
                        <span>Rs. {{ number_format($order->total_amount, 2) }}</span>
                    </div>

                    <!-- Add delivery charge / discount rows here if your model supports them -->
                    <!-- <div class="flex justify-between text-(--text-color)/80">
                        <span>Delivery Charge</span>
                        <span>Rs. 0.00</span>
                    </div> -->

                    <div
                        class="flex justify-between text-xl font-bold text-(--primary-color) pt-4 border-t border-(--primary-color)/20">
                        <span>Grand Total</span>
                        <span class="text-(--secondary-color)">
                            Rs. {{ number_format($order->total_amount, 2) }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div
                class="px-8 py-6 bg-(--primary-color)/5 border-t border-(--primary-color)/10 text-center text-sm text-(--text-color)/70">
                <p>Thank you for your order!</p>
                <p class="mt-1">For any questions, contact the seller directly.</p>
                <p class="mt-3 text-xs">Generated on {{ now()->format('d M Y h:i A') }}</p>
            </div>
        </div>

        <!-- Action Buttons (hide on print) -->
        <div class="no-print mt-8 flex flex-wrap gap-4 justify-center md:justify-end">
            <button onclick="window.print()"
                class="bg-(--secondary-color) hover:bg-(--secondary-color)/90 text-white font-medium py-3 px-8 rounded-xl transition flex items-center gap-2 shadow-sm">
                <i class="fa-solid fa-print"></i>
                Print Receipt
            </button>
        </div>

    </main>

</body>

</html>
