<x-frontend-layout>
    <section class="py-10 bg-gray-100 min-h-screen">
        <div class="container mx-auto px-4">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-8 text-center">
                Your Checkout History
            </h1>

            @if (session('error'))
                <div class="mb-6 p-4 bg-red-100 text-red-700 rounded-md">
                    {{ session('error') }}
                </div>
            @endif

            @if (!$checkouts || $checkouts->isEmpty())
                <div class="text-center p-8 bg-white rounded-lg shadow-md">
                    <p class="text-lg text-gray-600">You have no checkouts yet.</p>
                    <a href="{{ route('/') }}"
                        class="mt-4 inline-block bg-pink-500 text-white px-6 py-2 rounded-md hover:bg-pink-600">
                        Browse Now
                    </a>
                </div>
            @else
                <!-- Desktop: Table View -->
                <div class="hidden md:block bg-white rounded-lg shadow-md overflow-hidden">
                    <table class="w-full table-auto">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Event</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Date</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Quantity</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Total</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Status</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Action</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Invoice</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($checkouts as $checkout)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        <div class="flex -space-x-2">
                                            @php
                                                $images = is_string($checkout->event->images)
                                                    ? json_decode($checkout->event->images, true)
                                                    : $checkout->event->images;
                                            @endphp
                                            @if ($images && is_array($images) && !empty($images))
                                                <img class="w-10 h-10 rounded-full"
                                                    src="{{ asset('storage/' . $images[0]) }}" alt="Event Image">
                                            @else
                                                <span
                                                    class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center">No
                                                    Image</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        {{ $checkout->created_at->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        {{ $checkout->quantity ?? 0 }} ticket(s)
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        {{ $checkout->total_amount ? 'Rs. ' . number_format($checkout->total_amount, 2) : 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        {{ ucfirst(str_replace('_', ' ', $checkout->payment_method ?? 'N/A')) }}
                                    </td>
                                    <td class="px-6 py-4 text-sm">
                                        @php
                                            $statusClasses = [
                                                'pending' => 'bg-yellow-100 text-yellow-800',
                                                'paid' => 'bg-green-100 text-green-800',
                                                'cancelled' => 'bg-red-100 text-red-800',
                                            ];
                                            $statusClass =
                                                $statusClasses[$checkout->status] ?? 'bg-gray-100 text-gray-800';
                                        @endphp
                                        <span
                                            class="inline-block px-3 py-1 rounded-full text-xs font-semibold {{ $statusClass }}">
                                            {{ ucfirst($checkout->status ?? 'Unknown') }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 space-x-2">
                                        <a href="{{ route('voucher', $checkout->id) }}" target="_blank"
                                            class="text-black  hover:bg-[var(--primary)] px-4 py-2 rounded-lg font-semibold">
                                            View Details
                                        </a>
                                        @if ($checkout->status === 'pending' && in_array($checkout->payment_method, ['khalti']))
                                            <a href="{{ route('payment.retry', $checkout->id) }}"
                                                class="inline-block text-sm text-yellow-600 hover:text-yellow-700 font-semibold border border-yellow-400 px-3 py-1 rounded-md ml-2">
                                                Retry Payment
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- <!-- Mobile: Card View -->
                <div class="md:hidden space-y-6">
                    @foreach ($checkouts as $checkout)
                        <div class="bg-white rounded-lg shadow-md p-6">
                            <div class="flex justify-between items-center mb-4">
                                <h2 class="text-lg font-semibold text-gray-800">
                                    Checkout #{{ $checkout->id }}
                                </h2>
                                @php
                                    $statusClasses = [
                                        'pending' => 'bg-yellow-100 text-yellow-800',
                                        'paid' => 'bg-green-100 text-green-800',
                                        'cancelled' => 'bg-red-100 text-red-800',
                                    ];
                                    $statusClass = $statusClasses[$checkout->status] ?? 'bg-gray-100 text-gray-800';
                                @endphp
                                <span
                                    class="inline-block px-3 py-1 rounded-full text-xs font-semibold {{ $statusClass }}">
                                    {{ ucfirst($checkout->status ?? 'Unknown') }}
                                </span>
                            </div>
                            <div class="space-y-2">
                                <p class="text-sm text-gray-600">
                                    <span class="font-semibold">Date:</span>
                                    {{ $checkout->created_at->format('M d, Y') }}
                                </p>
                                <p class="text-sm text-gray-600">
                                    <span class="font-semibold">Items:</span>
                                    {{ $checkout->order_descriptions->sum('qty') }} item(s)
                                </p>
                                <p class="text-sm text-gray-600">
                                    <span class="font-semibold">Total:</span>
                                    <span class="checkout-total" data-price-npr="{{ $checkout->total_amount ?? 0 }}"></span>
                                </p>
                                <p class="text-sm text-gray-600">
                                    <span class="font-semibold">Payment:</span>
                                    {{ ucfirst(str_replace('_', ' ', $checkout->payment_method ?? 'N/A')) }}
                                </p>
                            </div>
                            <div class="mt-4 space-y-2">
                                <a href="{{ route('voucher', $checkout->id) }}"
                                    class="block w-full text-center bg-pink-500 text-white px-4 py-2 rounded-md hover:bg-pink-600">
                                    View Details
                                </a>
                                @if ($checkout->status === 'pending' && in_array($checkout->payment_method, ['khalti', 'card']))
                                    <a href="{{ route('payment.retry', $checkout->id) }}"
                                        class="block w-full text-center bg-yellow-500 text-white px-4 py-2 rounded-md hover:bg-yellow-600">
                                        Retry Payment
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div> --}}
            @endif
        </div>
    </section>
</x-frontend-layout>
