<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-md sm:rounded-lg">
                <h3 class="text-2xl font-bold">{{ $product->name }}</h3>
                <p class="text-gray-600 mt-2">Price: <span class="text-green-600 font-semibold">${{ $product->price }}</span></p>
                <p class="text-gray-600 mt-2">Stock: <span class="text-green-600 font-semibold">{{ $product->stock_quantity }}</span></p>
                <p class="mt-4">{{ $product->description }}</p>

                @if($product->category)
                    <p class="mt-4">Category: <span class="text-indigo-500">{{ $product->category->name }}</span></p>
                @endif

                <div class="mt-6 flex space-x-4">
                    <a href="{{ route('product.edit', $product->id) }}" class="text-blue-500 hover:underline">Edit Product</a>

                    <form method="POST" action="{{ route('product.destroy', $product->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure?')" class="text-red-500 hover:underline">Delete Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
