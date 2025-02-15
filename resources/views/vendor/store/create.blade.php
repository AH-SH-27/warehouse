<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create your store') }}
        </h2>
    </x-slot>

    <!-- Display error message if it exists -->
    @if (session('error'))
    <div class="text-red-500">{{ session('error') }}</div>
    @endif

    <!-- Form to create a store -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="">
                    <form method="POST" action="{{ route('vendor.store.store') }}" class="mt-6 space-y-6">
                        @csrf
                        <div class="mt-4">
                            <x-input-label for="name" :value="__('Store name')" />
                            <x-text-input type="text" id="name" name="name" class="mt-1 block w-full" required />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="description" :value="__('Store description')" />
                            <textarea
                                id="description"
                                name="description"
                                class="mt-1 min-h-28 max-h-44 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                rows="4"></textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <x-primary-button type="submit" class="bg-blue-500 text-white px-4 py-2">
                            {{ __('Create Store') }}
                        </x-primary-button>
                </div>
            </div>
        </div>
        </form>
</x-app-layout>