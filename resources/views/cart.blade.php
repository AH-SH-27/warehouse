<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cart') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container mx-auto py-12">
                <h2 class="text-2xl font-bold mb-4">Shopping Cart</h2>
                <div id="cart-container" class="bg-white p-6 shadow-md rounded-md">
                    <div id="cart-items"></div>
                    <div class="my-4 font-semibold">Total: <span id="cart-total">$0.00</span></div>
                    <x-primary-button id="checkout-btn">Checkout</x-primary-button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            loadCart();
        });

        function loadCart() {
            let cart = JSON.parse(localStorage.getItem("cart")) || [];
            let cartContainer = document.getElementById("cart-items");
            let cartTotal = 0;
            cartContainer.innerHTML = "";

            if (cart.length === 0) {
                cartContainer.innerHTML = "<p>Your cart is empty.</p>";
                return;
            }

            cart.forEach((item, index) => {
                let itemTotal = item.price * item.quantity;
                cartTotal += itemTotal;
                cartContainer.innerHTML += `
                <div class="border-b py-2 flex justify-between items-center">
                    <div>
                        <h5 class="font-bold">${item.name} - stock: ${item.stock}</h5>
                        <p class="text-gray-500">
                            ${item.price} x 
                            <input type="number" min="1" max="${item.stock}" value="${item.quantity}" 
                                oninput="validateQuantity(this, ${index}, ${item.stock})" 
                                class="w-20 text-center border rounded" />
                        </p>
                        <p class="text-sm font-semibold">Total: $${itemTotal.toFixed(2)}</p>
                    </div>
                    <x-danger-button onclick="removeFromCart(${index})">Remove</x-danger-button>
                </div>
            `;
            });

            document.getElementById("cart-total").innerText = `$${cartTotal.toFixed(2)}`;
        }

        function validateQuantity(input, index, stock) {
            let newQuantity = parseInt(input.value);
            if (isNaN(newQuantity) || newQuantity < 1) {
                input.value = 1;
            } else if (newQuantity > stock) {
                input.value = stock;
            }
            updateQuantity(index, input.value);
        }

        function updateQuantity(index, newQuantity) {
            let cart = JSON.parse(localStorage.getItem("cart")) || [];
            cart[index].quantity = parseInt(newQuantity);
            localStorage.setItem("cart", JSON.stringify(cart));
            loadCart();
        }

        function removeFromCart(index) {
            let cart = JSON.parse(localStorage.getItem("cart")) || [];
            cart.splice(index, 1);
            localStorage.setItem("cart", JSON.stringify(cart));
            loadCart();
        }

        document.getElementById("checkout-btn").addEventListener("click", function() {
            let cart = JSON.parse(localStorage.getItem("cart")) || [];
            if (cart.length === 0) {
                alert("Your cart is empty!");
                return;
            }
            // Submitting Here - Request to Backend 
            fetch("{{ route('orders.store') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        cart
                    })
                })
                .then(response => response.json())
                .then(data => {
                    alert("Order placed successfully!");
                    localStorage.removeItem("cart");
                    window.location.href = "{{ route('orders.clientOrders') }}";
                })
                .catch(error => console.error("Error:", error));
        });
    </script>
</x-app-layout>