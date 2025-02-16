<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Vendor Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl space-y-5 mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Message -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>

            <!-- Store Section -->
            <div class="bg-green-500 text-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if($vendor->store)
                <h2 class="text-xl font-semibold mb-4">Your Store: {{ $vendor->store->name }}</h2>
                <p class="mb-4">{{ $vendor->store->description }}</p>

                <!-- Store Actions -->
                <div class="flex items-center gap-4 mb-6">
                    <a href="{{ route('vendor.store.edit') }}" class="bg-white text-green-700 px-4 py-2 rounded-md text-sm font-semibold hover:bg-gray-100">
                        {{ __('Edit Store') }}
                    </a>
                    <form method="POST" action="{{ route('vendor.store.delete') }}">
                        @csrf
                        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md text-sm font-semibold hover:bg-red-700"
                            onclick="return confirm('Are you sure you want to delete this store?')">
                            {{ __('Delete Store') }}
                        </button>
                    </form>
                </div>

                <!-- Categories Section -->
                <h3 class="text-lg font-semibold mb-2">Categories</h3>
                @if($vendor->store->categories->isNotEmpty())
                <div class="flex flex-wrap gap-2 mb-4">
                    @foreach($vendor->store->categories as $category)
                    <span class="bg-white text-green-700 px-3 py-1 rounded-full text-sm">
                        {{ $category->name }}
                    </span>
                    @endforeach
                </div>
                <div class="space-x-4">
                    <a href="{{ route('category.index') }}" class="underline text-sm hover:text-gray-300">
                        {{ __('View Categories') }}
                    </a>
                    <a href="{{ route('category.create') }}" class="underline text-sm hover:text-gray-300">
                        {{ __('Create Category') }}
                    </a>
                </div>
                @else
                <p class="mb-4">No categories found for your store.</p>
                <a href="{{ route('category.create') }}" class="underline text-sm hover:text-gray-300">
                    {{ __('Create Category') }}
                </a>
                @endif

                <!-- Products Section -->
                <h3 class="text-lg font-semibold mt-6 mb-2">Products</h3>
                @if($vendor->store->products->isNotEmpty())
                <div class="space-x-4">
                    <a href="{{ route('product.index') }}" class="underline text-sm hover:text-gray-300">
                        {{ __('View Products') }}
                    </a>
                    <a href="{{ route('product.create') }}" class="underline text-sm hover:text-gray-300">
                        {{ __('Add Product') }}
                    </a>
                </div>
                @else
                <p class="mb-4">No products found for your store.</p>
                <a href="{{ route('product.create') }}" class="underline text-sm hover:text-gray-300">
                    {{ __('Add Product') }}
                </a>
                @endif
                @else
                <!-- No Store Message -->
                <p class="mb-4">You do not have a store yet.</p>
                <a href="{{ route('vendor.store.create') }}" class="underline text-sm hover:text-gray-300">
                    {{ __('Create Store') }}
                </a>
                @endif

                <a href="{{ route('vendor.orders') }}" class="underline text-sm hover:text-gray-300">
                    {{ __('Check Orders') }}
                </a>
            </div>
        </div>
    </div>
</x-app-layout>