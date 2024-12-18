<x-farmerlayout.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Farmer Dashboard') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-6">

        <div class="bg-white shadow-md rounded-lg p-6 mb-6">
            <h1 class="text-3xl font-bold text-gray-800 mb-4 text-center">Welcome to the Pagkakaisa Farmers Association</h1>
            <p class="text-gray-600 leading-relaxed">
                {{ $associationInfo }}
            </p>
        </div>
        <!-- Statistics Section -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Pending Borrowed Equipment -->
            <div class="bg-yellow-500 text-white p-4 rounded shadow">
                <h4 class="font-semibold text-lg">Total Pending Borrowed Equipment</h4>
                <p class="text-2xl font-bold">{{ $totalPending }}</p>
            </div>

            <!-- Approved Borrowed Equipment -->
            <div class="bg-green-500 text-white p-4 rounded shadow">
                <h4 class="font-semibold text-lg">Total Approved Borrowed Equipment</h4>
                <p class="text-2xl font-bold">{{ $totalApproved }}</p>
            </div>

            <!-- Rejected Borrowed Equipment -->
            <div class="bg-red-500 text-white p-4 rounded shadow">
                <h4 class="font-semibold text-lg">Total Rejected Borrowed Equipment</h4>
                <p class="text-2xl font-bold">{{ $totalRejected }}</p>
            </div>
        </div>

        <!-- Nearest Announcement Section -->
        <div class="bg-blue-500 text-white p-4 rounded shadow mt-6">
            <h4 class="font-semibold text-lg">Nearest Announcement</h4>
            @if ($nearestAnnouncement)
                <p class="text-xl font-bold">{{ $nearestAnnouncement->title }}</p>
                <p class="text-sm italic">{{ $nearestAnnouncement->description }}</p>
                <p class="text-lg">{{ $nearestAnnouncement->date->format('M d, Y') }}</p>
            @else
                <p class="text-lg">No Upcoming Announcements</p>
            @endif
        </div>

        <hr class="my-6 border-gray-300">
        <div class="bg-white shadow-md rounded-lg p-6 mb-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-3 text-center">Borrowing Equipment</h2>
            <p class="text-gray-600 leading-relaxed">
                {{ $borrowingInfo }}
            </p>
        </div>

        <!-- Equipment Section -->
        <hr class="my-6 border-gray-300">

        <h2 class="text-xl font-bold mb-4">Equipment</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach ($equipmentWithPrices as $equipment)
                <div class="border rounded shadow p-4 bg-white">
                    <h5 class="text-lg font-semibold">{{ $equipment->name }}</h5>
                    <p class="text-gray-700">Price: Php {{ number_format($equipment->price, 2) }}</p>
                </div>
            @endforeach
        </div>
    </div>

</x-farmerlayout.app>
