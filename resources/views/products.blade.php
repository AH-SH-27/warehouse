<x-app-layout>
    <div class="relative h-64 sm:h-80 md:h-96 overflow-hidden">
        <img src="{{ asset('storage/' . $store->image) }}"
            class="w-full h-full object-cover"
            alt="{{ $store->name }} Image">
        <div class="absolute inset-0 bg-black bg-opacity-50 capitalize flex flex-col justify-end p-6">
            <h3 class="text-3xl font-bold text-white mb-2">{{ $store->name }}</h3>
            <p class="text-white text-lg">{{ $store->description }}</p>
        </div>
    </div>

    <div class="bg-white overflow-hidden mb-5">
        <div class="p-6 sm:p-8">
            <div class="flex justify-end mb-6">
                <form method="GET" action="{{ route('public.store.products', ['store' => $store->id]) }}">
                    <label for="category" class="font-semibold mr-2">Filter by Category:</label>
                    <select name="category" id="category" class="border rounded p-2 px-8" onchange="this.form.submit()">
                        <option value="">All Categories</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $categoryId == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                </form>
            </div>

            <h4 class="text-xl font-semibold mb-6 text-gray-800">Products</h4>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach ($products as $product)
                <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden transition-all duration-300 hover:shadow-md">
                    <img src="{{ asset('storage/' . $product->image) }}"
                        class="w-full h-48 object-cover"
                        alt="{{ $product->name }} Image">
                    <div class="p-4 space-y-2">
                        <h5 class="text-lg font-bold text-gray-900">{{ $product->name }}</h5>
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
                </div>
                @endforeach
            </div>
            <div class="mt-8">
                {{ $products->links() }}
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