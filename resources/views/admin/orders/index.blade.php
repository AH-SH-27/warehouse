<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Orders') }}
        </h2>
    </x-slot>

    <table class="w-full border-collapse border">
    <thead>
        <tr class="bg-gray-200">
            <th class="border p-2">Order ID</th>
            <th class="border p-2">Client</th>
            <th class="border p-2">Total Price</th>
            <th class="border p-2">Status</th>
            <th class="border p-2">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $order)
            <tr class="border">
                <td class="border p-2">{{ $order->id }}</td>
                <td class="border p-2">{{ $order->client->name }}</td>
                <td class="border p-2">${{ number_format($order->total_price, 2) }}</td>
                <td class="border p-2">{{ ucfirst($order->status) }}</td>
                <td class="border p-2">
                    <a href="{{ route('admin.orders.details', $order->id) }}" class="bg-blue-500 text-white px-3 py-1 rounded">View</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
</x-app-layout>
