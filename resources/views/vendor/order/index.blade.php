<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Store Orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-2xl font-bold mb-4">Orders List</h3>

                @if(session('success'))
                    <div class="bg-green-500 text-white p-3 mb-4 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-300">
                        <thead>
                            <tr class="bg-gray-100 border-b">
                                <th class="py-2 px-4 text-left">Order ID</th>
                                <th class="py-2 px-4 text-left">Client</th>
                                <th class="py-2 px-4 text-left">Items</th>
                                <th class="py-2 px-4 text-left">Total Price</th>
                                <th class="py-2 px-4 text-left">Status</th>
                                <th class="py-2 px-4 text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr class="border-b">
                                    <td class="py-2 px-4">{{ $order->id }}</td>
                                    <td class="py-2 px-4">{{ $order->client->name }}</td>
                                    <td class="py-2 px-4">
                                        <ul>
                                            @foreach ($order->items as $item)
                                                <li>{{ $item->product->name }} (x{{ $item->quantity }})</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td class="py-2 px-4">${{ number_format($order->items->sum(fn($item) => $item->quantity * $item->price), 2) }}</td>
                                    <td class="py-2 px-4">
                                        <form action="{{ route('vendor.orders.updateStatus', $order->id) }}" method="POST">
                                            @csrf
                                            <select name="status" class="border rounded px-8 py-1">
                                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                                <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                                <option value="rejected" {{ $order->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                            </select>
                                            <button type="submit" class="bg-blue-500 text-white px-2 py-1 rounded ml-2">Update</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @if ($orders->isEmpty())
                        <p class="text-gray-500 mt-4">No orders found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
