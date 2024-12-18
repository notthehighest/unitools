<x-adminlayout.app>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Equipment') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-6">
        <div class="bg-white shadow-md rounded-lg p-6">
            <form action="{{ route('equipment.update', $equipment) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">{{ __('Equipment Name') }}</label>
                    <input type="text" name="name" id="name" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 p-2" value="{{ old('name', $equipment->name) }}" placeholder="{{ __('Enter equipment name') }}">
                    @error('name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="category_id" class="block text-sm font-medium text-gray-700">{{ __('Category') }}</label>
                    <select name="category_id" id="category_id" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 p-2">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $equipment->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">{{ __('Description') }}</label>
                    <textarea name="description" id="description" rows="4" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 p-2" placeholder="{{ __('Enter equipment description') }}">{{ old('description', $equipment->description) }}</textarea>
                    @error('description')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="price" class="block text-sm font-medium text-gray-700">{{ __('Price') }}</label>
                    <input type="number" name="price" id="price" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 p-2" value="{{ old('price', $equipment->price) }}" placeholder="{{ __('Enter price') }}" step="0.01">
                    @error('price')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- <div class="mb-4">
                    <label for="picture" class="block text-sm font-medium text-gray-700">{{ __('Picture') }}</label>
                    <input type="file" name="picture" id="picture" accept="image/*" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 p-2">
                    @if ($equipment->picture)
                        <img src="{{ Storage::url($equipment->picture) }}" alt="{{ $equipment->name }}" class="mt-2 w-32 h-32 object-cover rounded-md border">
                    @endif
                    @error('picture')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div> -->

                <div class="flex justify-end">
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition duration-200">
                        {{ __('Update Equipment') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-adminlayout.app>