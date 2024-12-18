<x-adminlayout.app>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Manage Borrowed Equipment Requests') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-6">
        <div class="mb-4">
            <form action="{{ route('borrowed_equipment.index') }}" method="GET" class="flex items-center">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by user or equipment" class="border border-gray-300 rounded-md p-2 mr-2">
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition duration-200">Search</button>
            </form>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Pending Requests -->
        <h3 class="font-semibold text-lg text-gray-800 mb-2">Pending Requests</h3>
        <div class="overflow-x-auto mb-6">
            <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
                <thead>
                    <tr class="bg-yellow-500 text-white uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Equipment Name</th>
                        <th class="py-3 px-6 text-left">User</th>
                        <th class="py-3 px-6 text-left">Borrowed Date</th>
                        <th class="py-3 px-6 text-left">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pending as $borrow)
                        <tr class="border-b border-gray-200 hover:bg-yellow-100">
                            <td class="py-3 px-6">{{ $borrow->equipment->name }}</td>
                            <td class="py-3 px-6">{{ $borrow->user->name }}</td>
                            <td class="py-3 px-6">{{ $borrow->borrowed_date }}</td>
                            <td class="py-3 px-6">
                                <form action="{{ route('borrowed_equipment.update', $borrow) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <select name="status" required class="border border-gray-300 rounded-md p-1">
                                        <option value="approved">Approve</option>
                                        <option value="rejected">Reject</option>
                                    </select>
                                    <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded">Update</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $pending->links() }}
        </div>

        <!-- Approved Requests -->
        <h3 class="font-semibold text-lg text-gray-800 mb-2">Approved Requests</h3>
        <div class="overflow-x-auto mb-6">
            <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
                <thead>
                    <tr class="bg-green-500 text-white uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Equipment Name</th>
                        <th class="py-3 px-6 text-left">User</th>
                        <th class="py-3 px-6 text-left">Borrowed Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($approved as $borrow)
                        <tr class="border-b border-gray-200 hover:bg-green-100">
                            <td class="py-3 px-6">{{ $borrow->equipment->name }}</td>
                            <td class="py-3 px-6">{{ $borrow->user->name }}</td>
                            <td class="py-3 px-6">{{ $borrow->borrowed_date }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $approved->links() }}
        </div>

        <!-- Rejected Requests -->
        <h3 class="font-semibold text-lg text-gray-800 mb-2">Rejected Requests</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
                <thead>
                    <tr class="bg-red-500 text-white uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Equipment Name</th>
                        <th class="py-3 px-6 text-left">User</th>
                        <th class="py-3 px-6 text-left">Borrowed Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rejected as $borrow)
                        <tr class="border-b border-gray-200 hover:bg-red-100">
                            <td class="py-3 px-6">{{ $borrow->equipment->name }}</td>
                            <td class="py-3 px-6">{{ $borrow->user->name }}</td>
                            <td class="py-3 px-6">{{ $borrow->borrowed_date }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $rejected->links() }}
        </div>
    </div>
</x-adminlayout.app>
