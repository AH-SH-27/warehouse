<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $store->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-md rounded-md">
                <h3 class="text-lg font-semibold mb-4">{{ $store->name }}</h3>
                <p class="text-gray-600 mb-4">{{ $store->description }}</p>

                <h4 class="text-xl font-semibold mt-6 mb-4">Products</h4>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach ($products as $product)
                    <div class="border p-4 rounded-md space-y-2">
                        <h5 class="text-lg font-bold">{{ $product->name }}</h5>
                        <p class="text-gray-500">{{ $product->description }}</p>
                        <p class="text-sm text-gray-600">Stock: <span id="stock-{{ $product->id }}">{{ $product->stock_quantity }}</span></p>
                        <p class="font-semibold mt-2">${{ $product->price }}</p>

                        @if(auth()->check() && auth()->user()->role === 'client')
                        <div class="flex items-center space-x-2">
                            <input type="number" id="quantity-{{ $product->id }}"
                                min="1" max="{{ $product->stock_quantity }}" value="1"
                                class="w-16 border p-1 rounded-md text-center">

                            <x-primary-button onclick="addToCart('{{ $product->id }}', '{{ $product->name }}', '{{ $product->price }}', '{{ $product->stock_quantity}}')">
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
            </div>
        </div>
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