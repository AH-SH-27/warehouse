<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:p-8">
                    <h2 class="text-2xl font-bold mb-6 text-gray-800">Order Management</h2>

                    <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative">
                        <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
                            <thead>
                                <tr class="text-left">
                                    <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-3 text-gray-600 font-bold tracking-wider uppercase text-xs">
                                        Order ID
                                    </th>
                                    <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-3 text-gray-600 font-bold tracking-wider uppercase text-xs">
                                        Client
                                    </th>
                                    <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-3 text-gray-600 font-bold tracking-wider uppercase text-xs">
                                        Total Price
                                    </th>
                                    <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-3 text-gray-600 font-bold tracking-wider uppercase text-xs">
                                        Status
                                    </th>
                                    <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-3 text-gray-600 font-bold tracking-wider uppercase text-xs">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                <tr class="hover:bg-gray-50">
                                    <td class="border-b border-gray-200 px-6 py-4">{{ $order->id }}</td>
                                    <td class="border-b border-gray-200 px-6 py-4">{{ $order->client->name }}</td>
                                    <td class="border-b border-gray-200 px-6 py-4 font-medium">
                                        ${{ number_format($order->total_price, 2) }}
                                    </td>
                                    <td class="border-b border-gray-200 px-6 py-4">
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $order->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                                               ($order->status === 'processing' ? 'bg-blue-100 text-blue-800' : 
                                               ($order->status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800')) }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td class="border-b border-gray-200 px-6 py-4">
                                        <a href="{{ route('admin.orders.details', $order->id) }}"
                                            class="text-blue-600 hover:text-blue-900 transition duration-150 ease-in-out">
                                            View Details
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6">
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>