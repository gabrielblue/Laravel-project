<x-app-layout>
    <div class="container mx-auto mt-10">
        <div class="bg-white shadow-xl rounded-lg overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h4 class="text-2xl font-semibold text-gray-800">Job Applications</h4>
                    <a href="{{ route('jobs.index') }}" class="bg-red-600 text-white px-5 py-2 rounded-lg hover:bg-red-700 transition duration-300">
                        Back to Jobs
                    </a>
                </div>
            </div>
            <div class="px-6 py-4">
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 text-left text-sm font-semibold text-gray-500 uppercase tracking-wider">Job Title</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-sm font-semibold text-gray-500 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-sm font-semibold text-gray-500 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-sm font-semibold text-gray-500 uppercase tracking-wider">Cover Letter</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-sm font-semibold text-gray-500 uppercase tracking-wider">Resume</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-sm font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-sm font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($applications as $application)
                                <tr>
                                    <td class="px-6 py-4 text-gray-800 whitespace-no-wrap">{{ $application->job->title }}</td>
                                    <td class="px-6 py-4 text-gray-800 whitespace-no-wrap">{{ $application->name }}</td>
                                    <td class="px-6 py-4 text-gray-800 whitespace-no-wrap">{{ $application->email }}</td>
                                    <td class="px-6 py-4 text-gray-800 whitespace-no-wrap">{{ Str::limit($application->cover_letter, 50) }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap">
                                        <a href="{{ asset('storage/' . $application->resume) }}" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition duration-300 flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h2.82a2 2 0 00-1.42-2 4 4 0 00-7.13 2.12 2 2 0 00-1.42 2H9a3 3 0 003 3v1H4zm13 1a3 3 0 003-3h2a2 2 0 00-1.42 2 4 4 0 00-7.13 2.12 2 2 0 00-1.42 2H18a3 3 0 003-3v-1h-1zm-1-1a1 1 0 00-1-1h-1a1 1 0 00-1 1v1h1a1 1 0 001-1z" />
                                            </svg>
                                            Download Resume
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap">
                                        @if($application->status == 'pending')
                                            <span class="bg-yellow-100 text-yellow-800 text-sm font-bold px-2.5 py-0.5 rounded">{{ __('Pending') }}</span>
                                        @elseif($application->status == 'reviewed')
                                            <span class="bg-blue-100 text-blue-800 text-sm font-bold px-2.5 py-0.5 rounded">{{ __('Reviewed') }}</span>
                                        @elseif($application->status == 'approved')
                                            <span class="bg-green-100 text-green-800 text-sm font-bold px-2.5 py-0.5 rounded">{{ __('Approved') }}</span>
                                        @elseif($application->status == 'denied')
                                            <span class="bg-red-100 text-red-800 text-sm font-bold px-2.5 py-0.5 rounded">{{ __('Denied') }}</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap flex space-x-2">
                                        <a href="{{ route('application.review', $application->id) }}">
                                            <x-secondary-button>{{ __('Review') }}</x-secondary-button>
                                        </a>
                                        <a href="{{ route('application.approve', $application->id) }}">
                                            <x-primary-button>{{ __('Approve') }}</x-primary-button>
                                        </a>
                                        <a href="{{ route('application.deny', $application->id) }}">
                                            <x-danger-button>{{ __('Deny') }}</x-danger-button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
  