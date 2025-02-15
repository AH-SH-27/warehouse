<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-2xl font-bold mb-4">Your Orders</h2>

                @if($orders->isEmpty())
                <p class="text-gray-500">You haven't placed any orders yet.</p>
                @else
                @foreach ($orders as $order)
                <div class="border rounded-lg p-4 mb-4">
                    <h3 class="text-lg font-semibold">Order #{{ $order->id }} - from {{ $order->store->name }} -
                        <span class="text-gray-600">{{ $order->created_at->format('d M Y, h:i A') }}</span>

                    </h3>
                    <p class="text-sm text-gray-500">Status:
                        <span class="font-semibold {{ $order->status == 'completed' ? 'text-green-600' : 'text-blue-600' }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </p>
                    <p class="text-sm text-gray-500">Total: <span class="font-semibold">${{ number_format($order->total_price, 2) }}</span></p>

                    <div class="mt-2">
                        <h4 class="text-md font-semibold">Prodcuts:</h4>
                        <ul class="mt-2 space-y-2">
                            @foreach ($order->items as $item)
                            <li class="border p-3 rounded-md flex justify-between">
                                <div>
                                    <p class="font-semibold">{{ $item->product->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $item->quantity }} x ${{ $item->price }}</p>
                                </div>
                                <p class="font-semibold text-gray-700">${{ number_format($item->quantity * $item->price, 2) }}</p>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
</x-app-layout>