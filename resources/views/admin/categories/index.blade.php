<x-adminlayout.app>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Equipment Category') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-6">
        <a href="{{ route('categories.create') }}" class="inline-block bg-green-600 text-white font-semibold py-2 px-4 rounded shadow hover:bg-green-500 transition duration-200">
            {{ __('Add Category') }}
        </a>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
        
        <div class="overflow-x-auto mt-6">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow">
                <thead>
                    <tr class="bg-green-500 text-white">
                        <th class="py-2 px-4 border-b text-left">{{ __('ID') }}</th>
                        <th class="py-2 px-4 border-b text-left">{{ __('Category Name') }}</th>
                        <th class="py-2 px-4 border-b text-left">{{ __('') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr class="hover:bg-gray-50">
                            <td class="py-2 px-4 border-b text-gray-800">{{ $category->id }}</td>
                            <td class="py-2 px-4 border-b text-gray-800">{{ $category->name }}</td>
                            <td class="flex justify-end py-2 px-4 border-b">
                                <a href="{{ route('categories.edit', $category) }}" class="bg-yellow-500 text-white font-semibold py-1 px-3 rounded hover:bg-yellow-600 transition duration-200">
                                    {{ __('Edit') }}
                                </a>
                                <form action="{{ route('categories.destroy', $category) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white font-semibold py-1 px-3 rounded hover:bg-red-600 transition duration-200">
                                        {{ __('Delete') }}
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-adminlayout.app>