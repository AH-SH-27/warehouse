<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Order Details') }}
        </h2>
    </x-slot>

    <div class="border p-4 rounded-md">
    <p><strong>Order ID:</strong> {{ $order->id }}</p>
    <p><strong>Client:</strong> {{ $order->client->name }}</p>
    <p><strong>Total Price:</strong> ${{ number_format($order->total_price, 2) }}</p>
    <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
    <p><strong>Created At:</strong> {{ $order->created_at->format('Y-m-d H:i A') }}</p>
</div>

<h3 class="text-xl font-bold mt-6">Products</h3>

<ul class="mt-4">
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

<a href="{{ route('admin.orders') }}" class="mt-4 inline-block bg-gray-500 text-white px-4 py-2 rounded">Back to Orders</a>
</x-app-layout>
