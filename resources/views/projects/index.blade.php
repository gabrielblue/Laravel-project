<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Projects') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-r from-gray-700 via-gray-900 to-black min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <a href="{{ route('projects.create') }}" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded flex items-center">
                        <i class="fas fa-plus-circle fa-lg mr-2"></i>Create New Project
                    </a>
                    <div class="relative">
                        <input type="text" placeholder="Search Projects..." class="border border-gray-300 rounded px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500">
                        <i class="fas fa-search absolute right-3 top-2.5 text-gray-500"></i>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($projects as $project)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden">
                            @if($project->image)
                                <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->name }}" class="w-full h-48 object-cover">
                            @else
                                <img src="/path/to/default-image.jpg" alt="Default Image" class="w-full h-48 object-cover">
                            @endif
                            <div class="p-4">
                                <h3 class="text-lg font-semibold text-gray-900">{{ $project->name }}</h3>
                                <p class="text-gray-700 mt-2">{{ $project->description }}</p>
                                <div class="mt-4">
                                    <div class="text-gray-500">Start Date: {{ $project->start_date }}</div>
                                    <div class="text-gray-500">End Date: {{ $project->end_date }}</div>
                                    <div class="text-gray-500">Price: ${{ number_format($project->price, 2) }}</div>
                                </div>
                                <div class="flex mt-4 space-x-2">
                                    <a href="{{ route('projects.show', $project->id) }}" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded flex items-center">
                                        <i class="fas fa-eye fa-lg mr-2"></i>View
                                    </a>
                                    <a href="{{ route('projects.edit', $project->id) }}" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded flex items-center">
                                        <i class="fas fa-edit fa-lg mr-2"></i>Edit
                                    </a>
                                    <form action="{{ route('projects.destroy', $project->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded flex items-center">
                                            <i class="fas fa-trash fa-lg mr-2"></i>Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
