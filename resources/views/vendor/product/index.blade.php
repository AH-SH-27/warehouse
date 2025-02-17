<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <a href="{{ route('product.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md">
                    {{ __('Add Product') }}
                </a>

                <table class="min-w-full mt-4 bg-white">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-left">Image</th>
                            <th class="px-6 py-3 text-left">Name</th>
                            <th class="px-6 py-3 text-left">Price</th>
                            <th class="px-6 py-3 text-left">Stock</th>
                            <th class="px-6 py-3 text-left">Category</th>
                            <th class="px-6 py-3 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                        <tr class="border-b">
                            <td>
                                <img src="{{ asset('storage/' . $product->image) }}" width="100" alt="Product Image">
                            </td>
                            <td class="px-6 py-4">{{ $product->name }}</td>
                            <td class="px-6 py-4">${{ number_format($product->price, 2) }}</td>
                            <td class="px-6 py-4">{{ $product->stock_quantity }}</td>
                            <td class="px-6 py-4">{{ $product->category->name ?? 'No Category' }}</td>
                            <td class="px-6 py-4">
                                <a href="{{ route('product.show', $product) }}" class="text-blue-500">View</a>
                                <a href="{{ route('product.edit', $product) }}" class="text-green-500 ml-2">Edit</a>
                                <form action="{{ route('product.destroy', $product) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 ml-2" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>