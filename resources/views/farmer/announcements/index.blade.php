<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Announcements') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-6">

        <!-- Search Bar -->
        <form method="GET" action="{{ route('farmer.announcements.index') }}" class="mb-6">
            <input 
                type="text" 
                name="search" 
                value="{{ $search }}" 
                placeholder="Search announcements..." 
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200 ease-in-out">
        </form>

        <!-- Upcoming Announcements -->
        <h2 class="text-2xl font-semibold mb-4 text-gray-700">{{ __('Upcoming Announcements') }}</h2>
        @if ($upcoming->isEmpty())
            <p class="text-gray-500 mb-4">{{ __('No upcoming announcements.') }}</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($upcoming as $announcement)
                    <div class="bg-green-100 shadow-lg rounded-lg p-6 transition-transform transform hover:scale-105">
                        <h3 class="font-bold text-lg text-gray-800">{{ $announcement->title }}</h3>
                        <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($announcement->date)->format('F d, Y') }}</p>
                        <a href="{{ route('farmer.announcements.show', $announcement) }}" class="text-blue-600 mt-2 block hover:underline">
                            {{ __('Read more') }}
                        </a>
                    </div>
                @endforeach
            </div>
        @endif

        <!-- Past Announcements -->
        <h2 class="text-2xl font-semibold mt-8 mb-4 text-gray-700">{{ __('Past Announcements') }}</h2>
        @if ($past->isEmpty())
            <p class="text-gray-500 mb-4">{{ __('No past announcements.') }}</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($past as $announcement)
                    <div class="bg-gray-100 shadow-lg rounded-lg p-6 transition-transform transform hover:scale-105">
                        <h3 class="font-bold text-lg text-gray-800">{{ $announcement->title }}</h3>
                        <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($announcement->date)->format('F d, Y') }}</p>
                        <a href="{{ route('farmer.announcements.show', $announcement) }}" class="text-blue-600 mt-2 block hover:underline">
                            {{ __('Read more') }}
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>