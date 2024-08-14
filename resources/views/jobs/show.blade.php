<x-app-layout>
    <div class="container mx-auto mt-5">
        <div class="w-full max-w-3xl mx-auto bg-white shadow-md rounded-lg p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold">{{ $job->title }}</h2>
                <a href="{{ route('jobs.index') }}" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">Back</a>
            </div>
            @if($job->image)
                <img src="{{ asset('storage/' . $job->image) }}" alt="{{ $job->title }}" class="w-full h-64 object-cover rounded-lg mb-4">
            @endif
            <p class="text-gray-700 mb-4"><strong>Location:</strong> {{ $job->location }}</p>
            <p class="text-gray-700 mb-4"><strong>Skills:</strong>
                @foreach ($job->skills as $skill)
                    {{ $skill->name }}@if (!$loop->last), @endif
                @endforeach
            </p>
            <p class="text-gray-700 mb-4"><strong>Description:</strong> {{ $job->description }}</p>
            <p class="text-gray-700 mb-4"><strong>Qualifications:</strong> {{ $job->qualifications }}</p>
            <p class="text-gray-700 mb-4"><strong>Views:</strong> {{ $job->views }}</p>

            <div class="mt-6">
                @if(auth()->check() && auth()->user()->id !== $job->user_id)
                    <a href="{{ route('jobs.apply', $job->id) }}" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">Apply Now</a>
                @else
                    <p class="text-red-500">You cannot apply to a job you created.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
