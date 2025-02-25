<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center">
            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
            </svg>
            {{ __('Vendor Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        {{ __("Welcome to Your Vendor Dashboard") }}
                    </h3>
                    @if (!$store)
                    <p class="mb-4">{{ $message }}</p>
                    <a href="{{ route('vendor.store.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Create Store
                    </a>
                    @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                        <div class="bg-blue-200 p-4 rounded-lg">
                            <p class="text-sm text-blue-700">Total Products</p>
                            <p class="text-2xl font-bold text-blue-900">{{ $productsCount }}</p>
                        </div>
                        <div class="bg-green-200 p-4 rounded-lg">
                            <p class="text-sm text-green-700">Total Orders</p>
                            <p class="text-2xl font-bold text-green-900">{{ $totalOrdersCount }}</p>
                        </div>
                        <div class="bg-yellow-200 p-4 rounded-lg">
                            <p class="text-sm text-yellow-700">Orders Today</p>
                            <p class="text-2xl font-bold text-yellow-900">{{ $todayOrdersCount }}</p>
                        </div>
                        <div class="bg-purple-200 p-4 rounded-lg">
                            <p class="text-sm text-purple-700">Orders This Week</p>
                            <p class="text-2xl font-bold text-purple-900">{{ $weeklyOrdersCount }}</p>
                        </div>
                        <div class="bg-pink-200 p-4 rounded-lg">
                            <p class="text-sm text-pink-700">Orders This Month</p>
                            <p class="text-2xl font-bold text-pink-900">{{ $monthlyOrdersCount }}</p>
                        </div>
                    </div>

                    <div class="bg-blue-950 text-white overflow-hidden shadow-lg rounded-lg p-6 mt-5">
                        @if($vendor->store)
                        <div class="flex flex-col md:flex-row">
                            <div class="md:w-1/3 mb-4 md:mb-0">
                                <img src="{{ asset('storage/' . $vendor->store->image) }}" class="w-full h-auto rounded-lg shadow-md" alt="Store Image">
                            </div>
                            <div class="md:w-2/3 md:pl-6">
                                <h2 class="text-2xl font-semibold mb-4">Your Store: {{ $vendor->store->name }}</h2>
                                <p class="mb-4">{{ $vendor->store->description }}</p>

                                <div class="flex flex-wrap items-center gap-4 mb-6">
                                    <a href="{{ route('vendor.store.edit') }}" class="inline-flex items-center px-4 py-2 bg-teal-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-teal-700 focus:bg-teal-700 active:bg-teal-900 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                        {{ __('Edit Store') }}
                                    </a>
                                    <form method="POST" action="{{ route('vendor.store.delete') }}">
                                        @csrf
                                        <x-danger-button type="submit"
                                            onclick="return confirm('Are you sure you want to delete this store?')">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                            {{ __('Delete Store') }}
                                        </x-danger-button>
                                    </form>
                                </div>
                                <hr class="my-3" />
                                <h3 class="text-lg font-semibold mb-2 flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                    Categories
                                </h3>
                                @if($vendor->store->categories->isNotEmpty())
                                <div class="flex flex-wrap gap-2 mb-4">
                                    @foreach($vendor->store->categories as $category)
                                    <span class="bg-white text-green-700 px-3 py-1 rounded-full text-sm">
                                        {{ $category->name }}
                                    </span>
                                    @endforeach
                                </div>
                                <div class="space-x-4 space-y-2">
                                    <a href="{{ route('category.index') }}" class="text-sm hover:text-gray-300 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        {{ __('View Categories') }}
                                    </a>
                                    <a href="{{ route('category.create') }}" class="text-sm hover:text-gray-300 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                        {{ __('Create Category') }}
                                    </a>
                                </div>
                                @else
                                <p class="mb-4">No categories found for your store.</p>
                                <a href="{{ route('category.create') }}" class="text-sm hover:text-gray-300 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    {{ __('Create Category') }}
                                </a>
                                @endif
                                <hr class="my-3" />
                                <h3 class="text-lg font-semibold mt-6 mb-2 flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                    </svg>
                                    Products
                                </h3>
                                @if($vendor->store->products->isNotEmpty())
                                <div class="space-x-4 space-y-2">
                                    <a href="{{ route('product.index') }}" class="text-sm hover:text-gray-300 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        {{ __('View Products') }}
                                    </a>
                                    <a href="{{ route('product.create') }}" class="text-sm hover:text-gray-300 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                        {{ __('Add Product') }}
                                    </a>
                                </div>
                                @else
                                <p class="mb-4">No products found for your store.</p>
                                <a href="{{ route('product.create') }}" class="text-sm hover:text-gray-300 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    {{ __('Add Product') }}
                                </a>
                                @endif
                                <hr class="my-3" />
                                <div class="mt-6">
                                    <a href="{{ route('vendor.orders') }}" class="bg-white text-blue-500 px-4 py-2 rounded-lg text-sm font-semibold hover:bg-white/90 flex items-center w-fit">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                                        </svg>
                                        {{ __('Check Orders') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    @endif
                </div>
            </div>


        </div>
    </div>
</x-app-layout>