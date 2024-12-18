<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Equipment Category') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-6">
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h1 class="text-3xl font-bold mb-4 text-gray-800">{{ $announcement->title }}</h1>
            <h2 class="text-2xl text-gray-500 mb-4">{{ $announcement->date->format('F d, Y') }}</>
            <h2 class="text-gray-700 text-xl mb-4">{{ $announcement->description }}</h2>
        </div>

        <div class="mt-6">
            <a href="{{ route('farmer.announcements.index') }}" class="text-blue-600 hover:underline font-semibold">
                {{ __('Back to Announcements') }}
            </a>
        </div>
    </div>
</x-app-layout>