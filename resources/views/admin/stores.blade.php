<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Stores & Vendors') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:p-8">
                    <h2 class="text-2xl font-bold mb-6 text-gray-800">Stores & Their Vendors</h2>
                    
                    <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative">
                        <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
                            <thead>
                                <tr class="text-left">
                                    <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-3 text-gray-600 font-bold tracking-wider uppercase text-xs">
                                        ID
                                    </th>
                                    <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-3 text-gray-600 font-bold tracking-wider uppercase text-xs">
                                        Store Name
                                    </th>
                                    <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-3 text-gray-600 font-bold tracking-wider uppercase text-xs">
                                        Vendor
                                    </th>
                                    <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-3 text-gray-600 font-bold tracking-wider uppercase text-xs">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($stores as $store)
                                <tr class="hover:bg-gray-50">
                                    <td class="border-b border-gray-200 px-6 py-4">{{ $store->id }}</td>
                                    <td class="border-b border-gray-200 px-6 py-4 font-medium">{{ $store->name }}</td>
                                    <td class="border-b border-gray-200 px-6 py-4">
                                        @if ($store->vendor)
                                            <span class="px-2 py-1 rounded-full text-xs font-medium">
                                                {{ $store->vendor->name }}
                                            </span>
                                        @else
                                            <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-xs font-medium">
                                                No Vendor
                                            </span>
                                        @endif
                                    </td>
                                    <td class="border-b border-gray-200 px-6 py-4">
                                        <div class="flex items-center space-x-5">
                                            <a href="{{ route('public.store.products', $store->id) }}" 
                                               class="text-blue-600 hover:text-blue-900 transition duration-150 ease-in-out">
                                                View Store
                                            </a>

                                            <form action="{{ route('admin.stores.delete', $store->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        onclick="return confirm('Are you sure you want to delete this store? This will remove all its products.');" 
                                                        class="text-red-600 hover:text-red-900 transition duration-150 ease-in-out">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6">
                        {{ $stores->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>