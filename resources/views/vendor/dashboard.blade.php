<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Vendor Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl space-y-5 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
            <!-- 
            <div class="bg-green-500 overflow-hidden shadow-sm sm:rounded-lg">
                @if($vendor->store)
                <h2>Your Store: {{ $vendor->store->name }}</h2>
                <p>Description: {{ $vendor->store->description }}</p>
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('vendor.store.edit') }}">
                    {{ __('Edit Store') }}
                </a>
                <form method="POST" action="{{ route('vendor.store.delete') }}" class="mt-4">
                    @csrf
                    <x-primary-button type="submit" class="bg-blue-500 text-white px-4 py-2">
                            {{ __('Delete Store') }}
                        </x-primary-button>
                </form>
                @else
                <p>You do not have a store yet.</p>
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('vendor.store.create') }}">
                    {{ __('Create Store') }}
                </a>
                @endif
            </div> -->

            <div class="bg-green-500 overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if($vendor->store)
                <!-- Store  -->
                <h2 class="text-xl font-semibold mb-4">Your Store: {{ $vendor->store->name }}</h2>
                <p class="mb-4">Description: {{ $vendor->store->description }}</p>

                <!-- Edit and Delete Store Buttons -->
                <div class="flex items-center gap-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('vendor.store.edit') }}">
                        {{ __('Edit Store') }}
                    </a>
                    <form method="POST" action="{{ route('vendor.store.delete') }}">
                        @csrf
                        <x-primary-button type="submit" class="bg-red-500 text-white px-4 py-2" onclick="return confirm('Delete this store?')">
                            {{ __('Delete Store') }}
                        </x-primary-button>
                    </form>
                </div>

                <!-- Categories -->
                <h3 class="text-lg font-semibold mb-2">Categories</h3>
                @if($vendor->store->categories->isNotEmpty())
                <div class="flex flex-wrap gap-2 mb-4">
                    @foreach($vendor->store->categories as $category)
                    <span class="bg-white text-green-700 px-3 py-1 rounded-full text-sm">
                        {{ $category->name }}
                    </span>
                    @endforeach
                </div>
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('category.index') }}">
                    {{ __('Check Category') }}
                </a> <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('category.create') }}">
                    {{ __('Create Category') }}
                </a>
                @else
                <p class="mb-4">No categories found for your store</p>
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('category.create') }}">
                    {{ __('Create Category') }}
                </a>
                @endif
                @else
                <!-- No Store Message -->
                <p class="mb-4">You do not have a store yet.</p>
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('vendor.store.create') }}">
                    {{ __('Create Store') }}
                </a>
                @endif
            </div>


        </div>
    </div>
</x-app-layout>