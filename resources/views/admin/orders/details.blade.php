<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Order Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gray-100 p-6 rounded-lg shadow-sm">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Order Information</h3>
                            <div class="space-y-3">
                                <p class="flex justify-between">
                                    <span class="text-gray-600">Order ID:</span>
                                    <span class="font-medium">{{ $order->id }}</span>
                                </p>
                                <p class="flex justify-between">
                                    <span class="text-gray-600">Client:</span>
                                    <span class="font-medium">{{ $order->client->name }}</span>
                                </p>
                                <p class="flex justify-between">
                                    <span class="text-gray-600">Total Price:</span>
                                    <span class="font-medium">${{ number_format($order->total_price, 2) }}</span>
                                </p>
                                <p class="flex justify-between">
                                    <span class="text-gray-600">Status:</span>
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        {{ $order->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                                           ($order->status === 'processing' ? 'bg-blue-100 text-blue-800' : 
                                           ($order->status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800')) }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </p>
                                <p class="flex justify-between">
                                    <span class="text-gray-600">Created At:</span>
                                    <span class="font-medium">{{ $order->created_at->format('Y-m-d H:i A') }}</span>
                                </p>
                            </div>
                        </div>

                        <div class="bg-gray-100 p-6 rounded-lg shadow-sm">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Order Summary</h3>
                            <div class="space-y-3">
                                <p class="flex justify-between">
                                    <span class="text-gray-600">Subtotal:</span>
                                    <span class="font-medium">${{ number_format($order->total_price, 2) }}</span>
                                </p>
                                <p class="flex justify-between">
                                    <span class="text-gray-600">Tax:</span>
                                    <span class="font-medium">$0.00</span>
                                </p>
                                <p class="flex justify-between">
                                    <span class="text-gray-600">Shipping:</span>
                                    <span class="font-medium">$0.00</span>
                                </p>
                                <div class="border-t pt-3">
                                    <p class="flex justify-between text-lg font-semibold">
                                        <span>Total:</span>
                                        <span>${{ number_format($order->total_price, 2) }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Order Items</h3>
                        <div class="bg-white shadow overflow-hidden sm:rounded-md">
                            <ul class="divide-y divide-gray-200">
                                @foreach ($order->items as $item)
                                    <li class="px-6 py-4 flex items-center justify-between">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 bg-gray-200 rounded-full overflow-hidden">
                                                <img src="{{ asset('storage/' . $item->product->image) }}" alt="" >
                                            </div>
                                            <div class="ml-4">
                                                <p class="text-sm font-medium text-gray-900">{{ $item->product->name }}</p>
                                                <p class="text-sm text-gray-500">{{ $item->quantity }} x ${{ number_format($item->price, 2) }}</p>
                                            </div>
                                        </div>
                                        <p class="text-sm font-semibold text-gray-900">${{ number_format($item->quantity * $item->price, 2) }}</p>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end">
                        <a href="{{ route('admin.orders') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                            Back to Orders
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>