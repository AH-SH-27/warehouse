<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create your category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="">
                    <form method="POST" action="{{ route('category.store') }}" class="mt-6 space-y-6">
                        @csrf
                        <div class="mt-4">
                            <x-input-label for="name" :value="__('Category name')" />
                            <x-text-input type="text" id="name" name="name" class="mt-1 block w-full" required />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <x-primary-button type="submit" class="bg-blue-500 text-white px-4 py-2">
                            {{ __('Create Category') }}
                        </x-primary-button>
                </div>
            </div>
        </div>
        </form>
</x-app-layout>