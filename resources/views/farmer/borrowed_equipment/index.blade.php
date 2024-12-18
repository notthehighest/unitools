<x-farmerlayout.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Borrow Equipment') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-6">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <a href="{{ route('farmer.borrowed_equipment.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition duration-200 mb-4 inline-block">
            {{ __('Borrow Equipment') }}
        </a>


        <h2 class="font-bold text-xl text-gray-800 leading-tight">Pending Equipment</h2>
        <table class="min-w-full table-auto border-collapse border border-green-300">
            <thead>
                <tr class="bg-green-500 text-white">
                    <th class="px-6 py Here is the continuation of the response:

```blade
                    <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider border border-green-300">Equipment Name</th>
                    <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider border border-green-300">Decription</th>
                    <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider border border-green-300">Price</th>
                    <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider border border-green-300">Borrowed Date</th>
                    <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider border border-green-300">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($borrowedEquipment as $borrowed)
                    <tr class="border-b hover:bg-green-100 transition duration-200">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 border border-green-300">{{ $borrowed->equipment->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 border border-green-300">{{ $borrowed->equipment->description }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 border border-green-300">{{ $borrowed->equipment->price }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 border border-green-300">{{ \Carbon\Carbon::parse($borrowed->borrowed_date)->format('F d, Y') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 border border-green-300">
                            <form action="{{ route('farmer.borrowed_equipment.destroy', $borrowed) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 transition duration-200">Cancel</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center px-6 py-4 text-gray-800">No borrowed equipment found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-farmerlayout.app>