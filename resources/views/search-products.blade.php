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
            <div class="w-full flex flex-col gap-2 mx-auto md:w-1/4 p-4 bg-white rounded-lg shadow-md hover:shadow-lg transition">
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
        @endif
    </div>

    <script>
        function addToCart(productId, productName, productPrice, stockQuantity) {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            let quantityInput = document.getElementById(`quantity-${productId}`);
            let quantity = parseInt(quantityInput.value, 10);

            // Validation: Check stock limit
            if (quantity < 1) {
                alert("Quantity must be at least 1.");
                return;
            }
            if (quantity > stockQuantity) {
                alert(`Only ${stockQuantity} items available in stock.`);
                return;
            }

            // Check if the product already exists in the cart
            let existingProduct = cart.find(item => item.id === productId);
            if (existingProduct) {
                let newQuantity = existingProduct.quantity + quantity;
                if (newQuantity > stockQuantity) {
                    alert(`Only ${stockQuantity} items available in stock.\nYou already have ${existingProduct.quantity} items in cart.\nYou are allowed to add ${Number(stockQuantity) - Number(existingProduct.quantity)} items.`);
                    return;
                }
                existingProduct.quantity = newQuantity;
            } else {
                cart.push({
                    id: productId,
                    name: productName,
                    price: productPrice,
                    stock: stockQuantity,
                    quantity
                });
            }

            localStorage.setItem('cart', JSON.stringify(cart));

            alert(`${quantity} x ${productName} added to cart!`);
        }
    </script>
</x-app-layout>