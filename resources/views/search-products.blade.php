<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Search Results for Products') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-6">
        @if ($products->isEmpty())
        <p class="text-gray-500">No products found.</p>
        @else
        <div class="flex flex-wrap gap-6">
            @foreach ($products as $product)
            <div class="w-full flex flex-col gap-2 md:w-1/4 p-4 bg-white rounded-lg shadow-md hover:shadow-lg transition">
                <img src="{{ asset('storage/' . $product->image) }}"
                    class="w-full h-48 object-cover rounded-lg"
                    alt="{{ $product->name }} Image">
                <h5 class="text-lg font-bold text-gray-900">{{ $product->name }}</h5>
                <p class="text-sm text-gray-600">Store: {{ $product->store->name }}</p>
                <p class="text-sm text-gray-600 line-clamp-2">{{ $product->description }}</p>
                <p class="text-sm text-gray-600">Stock: <span id="stock-{{ $product->id }}" class="font-medium">{{ $product->stock_quantity }}</span></p>
                <p class="text-lg font-semibold text-gray-900">${{ number_format($product->price, 2) }}</p>
                @if(auth()->check() && auth()->user()->role === 'client')
                <div class="flex items-center space-x-2 mt-4">
                    <input type="number" id="quantity-{{ $product->id }}"
                        min="1" max="{{ $product->stock_quantity }}" value="1"
                        class="w-32 border border-gray-300 p-1 rounded-md text-center focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                    <x-primary-button onclick="addToCart('{{ $product->id }}', '{{ $product->name }}', '{{ $product->price }}', '{{ $product->stock_quantity}}')"
                        class="w-full justify-center">
                        {{ __('Add to Cart')}}
                    </x-primary-button>
                </div>
                @endif
            </div>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $products->links() }}
        </div>
        @endif
    </div>

</x-app-layout>