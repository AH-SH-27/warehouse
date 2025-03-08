<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-md rounded-md">
                <form action="{{ route('product.store') }}" method="POST"  enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input type="text" id="name" name="name" class="w-full border p-2 rounded-md" 
                                      value="{{ old('name') }}" required />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="description" :value="__('Description')" />
                        <x-text-input type="text" id="description" name="description" class="w-full border p-2 rounded-md" 
                                      value="{{ old('description') }}" />
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="price" :value="__('Price')" />
                        <x-text-input type="number" min="0" step="0.01" id="price" name="price" class="w-full border p-2 rounded-md" 
                                      value="{{ old('price') }}" required />
                        <x-input-error :messages="$errors->get('price')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="stock_quantity" :value="__('Stock Quantity')" />
                        <x-text-input type="number" min="0" step="1" id="stock_quantity" name="stock_quantity" 
                                      class="w-full border p-2 rounded-md" value="{{ old('stock_quantity') }}" required />
                        <x-input-error :messages="$errors->get('stock_quantity')" class="mt-2" />
                    </div>
                    
                    <div class="mb-4">
                        <x-input-label for="category_id" :value="__('Category')" />
                        <select id="category_id" name="category_id" class="w-full border p-2 rounded-md">
                            <option value="">No Category</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                    </div>
                    
                    <div class="mb-4">
                        <x-input-label for="image" :value="__('Image')" />
                        <input type="file" name="image" accept="image/*">
                        <x-input-error :messages="$errors->get('image')" class="mt-2" />
                    </div>

                    <x-primary-button type="submit" class="mt-4">
                        {{ __('Create Product') }}
                    </x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
