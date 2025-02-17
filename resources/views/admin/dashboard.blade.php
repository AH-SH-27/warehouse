<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
                <a href="{{ route('admin.users') }}" class="underline text-sm hover:text-gray-300">
                    {{ __('Users') }}
                </a>
                <a href="{{ route('admin.stores') }}" class="underline text-sm hover:text-gray-300">
                    {{ __('Stores') }}
                </a>
                <a href="{{ route('admin.orders') }}" class="underline text-sm hover:text-gray-300">
                    {{ __('Orders') }}
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
