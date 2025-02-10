<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit your category') }}
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
                    <form method="POST" action="{{ route('category.update', $category) }}" class="mt-6 space-y-6">
                        @csrf
                        @method('PUT')
                        <div class="mt-4">
                            <x-input-label for="name" :value="__('Category name')" />
                            <x-text-input type="text" id="name" name="name" class="mt-1 block w-full" value="{{ $category->name }}" required />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <x-primary-button type="submit" class="bg-blue-500 text-white px-4 py-2">
                            {{ __('Update Category') }}
                        </x-primary-button>
                </div>
            </div>
        </div>
        </form>
</x-app-layout>