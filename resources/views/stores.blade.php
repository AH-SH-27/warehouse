<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Stores') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-semibold mb-6">Available Stores</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($stores as $store)
                            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                                <img src="{{ asset('storage/' . $store->image) }}" 
                                     class="w-full h-48 object-cover" 
                                     loading="lazy"
                                     alt="{{ $store->name }} Image">
                                <div class="p-4">
                                    <h4 class="text-xl font-bold mb-2">
                                        <a href="{{ route('public.store.products', ['store' => $store->id]) }}" 
                                           class="text-blue-600 hover:text-blue-800 hover:underline">
                                            {{ $store->name }}
                                        </a>
                                    </h4>
                                    <p class="text-gray-600 text-sm mb-4">{{ $store->description }}</p>
                                    <a href="{{ route('public.store.products', ['store' => $store->id]) }}" 
                                       class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        View Products
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-6">
                        {{ $stores->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>