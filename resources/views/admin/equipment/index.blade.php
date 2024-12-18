<x-adminlayout.app>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Equipment') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-6">
        <a href="{{ route('equipment.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition duration-200">
            {{ __('Add Equipment') }}
        </a>

        <div class="bg-white shadow-md rounded-lg mt-4 overflow-hidden">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Success!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <table class="min-w-full table-auto border-collapse">
                <thead>
                    <tr class="bg-green-500 text-white">
                        <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider">{{ __('Name') }}</th>
                        <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider">{{ __('Category') }}</th>
                        <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider">{{ __('Price') }}</th>
                        <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($equipment as $item)
                        <tr class="border-b hover:bg-gray-100 transition duration-200">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $item->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $item->category->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">Php {{ number_format($item->price, 2) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 flex space-x-2">
                                <a href="{{ route('equipment.edit', $item) }}" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 transition duration-200">
                                    {{ __('Edit') }}
                                </a>
                                <form action="{{ route('equipment.destroy', $item) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition duration-200">
                                        {{ __('Delete') }}
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-gray-500">{{ __('No equipment found.') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>  
    </div>    
</x-adminlayout.app>