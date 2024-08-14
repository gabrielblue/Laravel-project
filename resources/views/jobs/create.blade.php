<x-app-layout>
    <div class="container mx-auto mt-5">
        <div class="w-full max-w-md mx-auto">
            @if ($errors->any())
                <div class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white shadow-md rounded-lg">
                <div class="bg-gray-100 px-6 py-4 border-b border-gray-200">
                    <h4 class="text-lg font-semibold">Create Job
                        <a href="{{ route('jobs.index') }}" class="bg-red-500 text-white px-4 py-2 rounded-lg float-right hover:bg-red-600">Back</a>
                    </h4>
                </div>
                <div class="px-6 py-4">
                    <form action="{{ route('jobs.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="title" class="block text-gray-700">Job Title</label>
                            <input type="text" name="title" id="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required />
                        </div>
                        <div class="mb-4">
                            <label for="description" class="block text-gray-700">Description</label>
                            <textarea name="description" id="description" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required></textarea>
                        </div>
                        <div class="mb-4">
                            <label for="qualifications" class="block text-gray-700">Qualifications</label>
                            <textarea name="qualifications" id="qualifications" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required></textarea>
                        </div>
                        <div class="mb-4">
                            <label for="location" class="block text-gray-700">Location</label>
                            <input type="text" name="location" id="location" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required />
                        </div>
                        <div class="mb-4">
                            <label for="skills" class="block text-gray-700">Skills</label>
                            @foreach($skills as $skill)
                                <div>
                                    <input type="checkbox" id="skill{{ $skill->id }}" name="skills[]" value="{{ $skill->id }}">
                                    <label for="skill{{ $skill->id }}">{{ $skill->name }}</label>
                                </div>
                            @endforeach
                        </div>
                        <div class="mb-4">
                            <label for="image" class="block text-gray-700">Image</label>
                            <input type="file" name="image" id="image" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                        </div>
                        <div class="mb-4">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
