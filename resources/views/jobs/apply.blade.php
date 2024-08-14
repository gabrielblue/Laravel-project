<x-app-layout>
    <div class="container mx-auto mt-5">
        <div class="w-full max-w-md mx-auto">
            @if ($errors->any())
                <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white shadow-md rounded-lg">
                <div class="bg-gray-100 px-6 py-4 border-b border-gray-200">
                    <h4 class="text-lg font-semibold">Apply for {{ $job->title }}
                        <a href="{{ route('jobs.index') }}" class="bg-red-500 text-white px-4 py-2 rounded-lg float-right hover:bg-red-600">Back</a>
                    </h4>
                </div>
                <div class="px-6 py-4">
                    <!-- Form starts here -->
                    <form action="{{ route('jobs.applyStore', $job->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        <div>
                            <label for="name" class="block text-gray-700">Name</label>
                            <input type="text" name="name" id="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required />
                        </div>
                        <div>
                            <label for="email" class="block text-gray-700">Email</label>
                            <input type="email" name="email" id="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required />
                        </div>
                        <div>
                            <label for="resume" class="block text-gray-700">Resume</label>
                            <input type="file" name="resume" id="resume" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required />
                        </div>
                        <div>
                            <label for="cover_letter" class="block text-gray-700">Cover Letter</label>
                            <textarea name="cover_letter" id="cover_letter" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required></textarea>
                        </div>
                        <div>
                            <label for="skills" class="block text-gray-700">Skills</label>
                            @foreach($job->skills as $skill)
                                <div>
                                    <input type="checkbox" id="skill{{ $skill->id }}" name="skills[]" value="{{ $skill->id }}">
                                    <label for="skill{{ $skill->id }}">{{ $skill->name }}</label>
                                </div>
                            @endforeach
                        </div>
                        <div>
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 w-full">Submit Application</button>
                        </div>
                    </form>
                    <!-- Form ends here -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
