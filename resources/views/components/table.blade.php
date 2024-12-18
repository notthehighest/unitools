<div class="overflow-x-auto mb-6">
    <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
        <thead>
            <tr class="bg-green-500 text-white uppercase text-sm leading-normal">
                <th class="py-3 px-6 text-left">Equipment Name</th>
                <th class="py-3 px-6 text-left">User</th>
                <th class="py-3 px-6 text-left">Borrowed Date</th>
                <th class="py-3 px-6 text-left">Status</th>
                <th class="py-3 px-6 text-left">Action</th>
            </tr>
        </thead>
        <tbody class="text-gray-600 text-sm font-light">
            @forelse($data as $borrow)
                <tr class="border-b border-gray-200 hover:bg-green-100 transition duration-200">
                    <td class="py-3 px-6">{{ $borrow->equipment->name }}</td>
                    <td class="py-3 px-6">{{ $borrow->user->name }}</td>
                    <td class="py-3 px-6">{{ \Carbon\Carbon::parse($borrow->borrowed_date)->format('F d, Y') }}</td>
                    <td class="py-3 px-6">{{ ucfirst($borrow->status) }}</td>
                    <td class="py-3 px-6">
                        <form action="{{ route('borrowed_equipment.update', $borrow) }}" method="POST" class="inline-flex items-center">
                            @csrf
                            @method('PUT')
                            <select name="status" required class="border border-green-300 rounded-md p-1 mr-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                                <option value="pending" {{ $borrow->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="approved" {{ $borrow->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="rejected" {{ $borrow->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                            <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 transition duration-200">Update</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="py-3 px-6 text-center text-gray-500">No records found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $data->links() }} <!-- Pagination links -->
</div>
