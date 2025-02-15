<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Stores') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-md rounded-md">
                <h3 class="text-lg font-semibold mb-4">Available Stores</h3>
                @foreach ($stores as $store)
                <div class="border-b py-3">
                    <h4 class="text-xl font-bold">
                        <a href="{{ route('public.store.products', ['store' => $store->id]) }}" class="text-blue-500 hover:underline">
                            {{ $store->name }}
                        </a>

                    </h4>
                    <p class="text-gray-600">{{ $store->description }}</p>
                </div>
                @endforeach
                <div class="mt-4">
                    {{ $stores->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>