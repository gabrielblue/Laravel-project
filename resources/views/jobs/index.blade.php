<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Jobs') }}
        </h2>
    </x-slot>

    @if (session('status'))
        <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
            {{ session('status') }}
        </div>
    @endif

    <div class="py-12 bg-gradient-to-r from-gray-700 via-gray-900 to-black min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h4 class="text-lg font-semibold text-gray-900">Jobs</h4>
                    <a href="{{ route('jobs.create') }}" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded flex items-center">
                        <i class="fas fa-plus-circle fa-lg mr-2"></i>Create Job
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($jobs as $job)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden">
                            @if($job->image)
                                <img src="{{ asset('storage/' . $job->image) }}" alt="{{ $job->title }}" class="w-full h-48 object-cover rounded-t-lg">
                            @else
                                <img src="/path/to/default-image.jpg" alt="Default Image" class="w-full h-48 object-cover rounded-t-lg">
                            @endif
                            <div class="p-4">
                                <h5 class="text-lg font-semibold text-gray-900">{{ $job->title }}</h5>
                                <p class="text-gray-700 mt-2">{{ $job->location }}</p>
                                <p class="text-gray-700 mb-4"><strong>Skills:</strong>
    @foreach ($job->skills as $skill)
        {{ $skill->name }}@if (!$loop->last), @endif
    @endforeach
</p>
                                <p class="text-gray-700 mt-2">Views: {{ $job->views }}</p>
                                <div class="flex mt-4 space-x-2">
                                    <a href="{{ route('jobs.edit', $job->id) }}" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded flex items-center">
                                        <i class="fas fa-edit fa-lg mr-2"></i>Edit
                                    </a>
                                    <form action="{{ route('jobs.destroy', $job->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded flex items-center">
                                            <i class="fas fa-trash fa-lg mr-2"></i>Delete
                                        </button>
                                    </form>
                                    <a href="{{ route('jobs.show', $job->id) }}" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded flex items-center">
                                        <i class="fas fa-eye fa-lg mr-2"></i>View More
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
