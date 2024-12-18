<x-adminlayout.app>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Announcements') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-6">
        
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <a href="{{ route('announcements.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition duration-200">
            {{ __('Create Announcement') }}
        </a>


        <table class="min-w-full bg-white border border-green-300 mt-4">
            <thead>
                <tr class="bg-green-500 text-white">
                    <th class="py-2 px-4 border-b">TITLE</th>
                    <th class="py-2 px-4 border-b">DESCRIPTION</th>
                    <th class="py-2 px-4 border-b">DATE</th>
                    <th class="py-2 px-4 border-b">ACTION</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($announcements as $announcement)
                    <tr class="hover:bg-green-100">
                        <td class="py-2 px-4 border-b">{{ $announcement->title }}</td>
                        <td class="py-2 px-4 border-b">{{ $announcement->description }}</td>
                        <td class="py-2 px-4 border-b">{{ \Carbon\Carbon::parse($announcement->date)->format('M d, Y') }}</td>
                        <td class="py-2 px-4 border-b">
                            <a href="{{ route('announcements.edit', $announcement) }}" class="text-blue-500 hover:underline">Edit</a>
                            <form action="{{ route('announcements.destroy', $announcement) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-adminlayout.app>