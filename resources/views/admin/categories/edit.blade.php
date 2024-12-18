<x-adminlayout.app>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 text-gray-200 leading-tight">
            {{ __('Equipment Category') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-6">Edit Category</h1>
        <form action="{{ route('categories.update', $category) }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                <input type="text" name="name" id="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ $category->name }}" required>
            </div>
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-200">Update</button>
            </div>
        </form>
    </div>
</x-adminlayout.app>