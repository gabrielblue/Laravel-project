<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Project Details') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-r from-gray-700 via-gray-900 to-black">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-4">{{ $project->name }}</h1>
                <p class="mb-4">{{ $project->description }}</p>
                <p class="mb-4">Start Date: {{ $project->start_date }}</p>
                <p class="mb-4">End Date: {{ $project->end_date }}</p>
                @if($project->image)
                    <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->name }}" class="w-64 h-64 object-cover mb-4">
                @endif
                <p class="mb-4">Price: {{ $project->price }}</p>
                <a href="{{ $project->source_code_url }}" target="_blank" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">View Source Code</a>
            </div>
        </div>
    </div>
</x-app-layout>
