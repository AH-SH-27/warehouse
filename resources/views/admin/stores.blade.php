<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Stores & Vendors') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h2 class="text-xl font-bold mb-4">Stores & Their Vendors</h2>

                <table class="w-full border-collapse border">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border p-2">ID</th>
                            <th class="border p-2">Store Name</th>
                            <th class="border p-2">Vendor</th>
                            <th class="border p-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stores as $store)
                        <tr class="border">
                            <td class="border p-2">{{ $store->id }}</td>
                            <td class="border p-2">{{ $store->name }}</td>
                            <td class="border p-2">
                                {{ $store->vendor ? $store->vendor->name : 'No Vendor' }}
                            </td>
                            <td class="border p-2">
                                <a href="{{ route('public.store.products', $store->id) }}" class="bg-blue-500 text-white px-2 py-1 rounded">View Store</a>

                                <form action="{{ route('admin.stores.delete', $store->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure you want to delete this store? This will remove all its products.');" class="bg-red-500 text-white px-2 py-1 rounded">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>