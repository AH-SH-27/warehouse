<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="p-6">
                    <h2 class="text-2xl font-bold mb-6 flex items-center">
                        <svg class="h-8 w-8 text-gray-800 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        Your Orders
                    </h2>

                    @if($orders->isEmpty())
                    <div class="text-center py-8">
                        <svg class="mx-auto h-12 w-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                        </svg>
                        <p class="mt-2 text-sm font-medium text-gray-500">You haven't placed any orders yet.</p>
                    </div>
                    @else
                    <div class="space-y-6">
                        @foreach ($orders as $order)
                        <div class="bg-gray-50 border rounded-lg shadow-md overflow-hidden">
                            <div class="p-4 sm:p-6">
                                <div class="flex items-center justify-between mb-4">
                                    <h3 class="text-lg font-semibold text-gray-900">
                                        Order #{{ $order->id }}
                                        @if(is_null($order->store))
                                        <span class="ml-2 text-sm font-medium text-red-600">Store Removed</span>
                                        @else
                                        <span class="ml-2 text-sm font-medium text-gray-500">from {{ $order->store->name }}</span>
                                        @endif
                                    </h3>
                                    <span class="text-sm text-gray-500">{{ $order->created_at->format('d M Y, h:i A') }}</span>
                                </div>

                                <div class="flex items-center mb-4">
                                    <svg class="h-5 w-5 text-gray-400 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                                    </svg>
                                    <span class="text-sm text-gray-500">Status:</span>
                                    @if(!is_null($order->store))
                                    <span class="ml-2 px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                {{ $order->status == 'completed' ? 'bg-green-100 text-green-800' : 
                                                   ($order->status == 'processing' ? 'bg-blue-100 text-blue-800' : 
                                                   ($order->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800')) }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                    @else
                                    <span class="ml-2 px-2 inline-flex text-xs leading-5 font-semibold rounded-full text-red-500">
                                       Cancelled
                                    </span>
                                    @endif
                                </div>

                                <div class="flex items-center mb-4">
                                    <svg class="h-5 w-5 text-gray-400 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="text-sm text-gray-500">Total:</span>
                                    <span class="ml-2 font-semibold">${{ number_format($order->total_price, 2) }}</span>
                                </div>

                                @if(!is_null($order->store))
                                <div class="mt-4">
                                    <h4 class="text-md font-semibold mb-2 flex items-center">
                                        <svg class="h-5 w-5 text-gray-400 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                        </svg>
                                        Products:
                                    </h4>
                                    <ul class="divide-y divide-gray-200">
                                        @foreach ($order->items as $item)
                                        <li class="py-3 flex justify-between items-center">
                                            <div class="flex items-center">
                                                <span class="font-medium">{{ $item->product->name }}</span>
                                                <span class="ml-2 text-sm text-gray-500">{{ $item->quantity }} x ${{ number_format($item->price, 2) }}</span>
                                            </div>
                                            <span class="font-semibold text-gray-900">${{ number_format($item->quantity * $item->price, 2) }}</span>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>