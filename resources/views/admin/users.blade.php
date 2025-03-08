<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:p-8">
                    <h2 class="text-2xl font-bold mb-6 text-gray-800">Vendors & Clients</h2>

                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse">
                            <thead>
                                <tr class="bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    <th class="px-4 py-3">ID</th>
                                    <th class="px-4 py-3">Name</th>
                                    <th class="px-4 py-3">Email</th>
                                    <th class="px-4 py-3">Role</th>
                                    <th class="px-4 py-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($users as $user)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 whitespace-nowrap">{{ $user->id }}</td>
                                    <td class="px-4 py-3 whitespace-nowrap">{{ $user->name }}</td>
                                    <td class="px-4 py-3 whitespace-nowrap">{{ $user->email }}</td>
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-800' : 
                                                   ($user->role === 'vendor' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800') }}">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm font-medium">
                                        <div class="flex items-center space-x-2">
                                            <form action="{{ route('admin.users.delete', $user) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 transition duration-150 ease-in-out mr-2" onclick="return confirm('Are you sure you want to delete this user?')">
                                                    Delete
                                                </button>
                                            </form>
                                            @if ($user->role !== 'admin')
                                            <form action="{{ route('admin.users.promote', $user) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="text-blue-600 hover:text-blue-900 transition duration-150 ease-in-out" onclick="return confirm('Are you sure you want to promote this user?')">
                                                    Promote to Admin
                                                </button>
                                            </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>