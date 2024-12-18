<x-farmerlayout.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Borrowed Equipment History') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-6">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Approved Requests -->
        <h3 class="font-semibold text-lg text-green-800 mb-2">Approved Requests</h3>
        <table class="min-w-full table-auto border-collapse border border-green-300 mb-6">
            <thead>
                <tr class="bg-green-500 text-white">
                    <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider border border-green-300">Equipment Name</th>
                    <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider border border-green-300">Description</th>
                    <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider border border-green-300">Price</th>
                    <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider border border-green-300">Borrowed Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($approvedEquipment as $equipment)
                    <tr class="border-b hover:bg-green-100 transition duration-200">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 border border-green-300">{{ $equipment->equipment->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 border border-green-300">{{ $equipment->equipment->description }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 border border-green-300">{{ $equipment->equipment->price }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 border border-green-300">{{ \Carbon\Carbon::parse($equipment->borrowed_date)->format('F d, Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center px-6 py-4 text-gray-800">No approved requests found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Rejected Requests -->
        <h3 class="font-semibold text-lg text-red-800 mb-2">Rejected Requests</h3>
        <table class="min-w-full table-auto border-collapse border border-red-300">
            <thead>
                <tr class="bg-red-500 text-white">
                    <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider border border-red-300">Equipment Name</th>
                    <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider border border-red-300">Description</th>
                    <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider border border-red-300">Price</th>
                    <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider border border-red-300">Borrowed Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($rejectedEquipment as $equipment)
                    <tr class="border-b hover:bg-red-100 transition duration-200">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 border border-red-300">{{ $equipment->equipment->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 border border-red-300">{{ $equipment->equipment->description }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 border border-red-300">{{ $equipment->equipment->price }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 border border-red-300">{{ \Carbon\Carbon::parse($equipment->borrowed_date)->format('F d, Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center px-6 py-4 text-gray-800">No rejected requests found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-farmerlayout.app>
