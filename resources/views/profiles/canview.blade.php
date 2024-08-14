<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Your Profile') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-r from-gray-700 via-gray-900 to-black min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg p-6">
                @if($profiles->isEmpty())
                    <p class="text-gray-700">You do not have a profile yet. <a href="{{ route('profiles.create') }}" class="text-blue-500">Create Profile</a></p>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($profiles as $profile)
                            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                                @if($profile->image)
                                    <img src="{{ asset('storage/' . $profile->image) }}" alt="{{ $profile->username }}" class="w-full h-48 object-cover">
                                @endif
                                <div class="p-4">
                                    <h5 class="text-lg font-semibold text-gray-900">{{ $profile->username }}</h5>
                                    <p class="text-gray-700 mt-2"><strong>Email:</strong> {{ $profile->email }}</p>
                                    <p class="text-gray-700"><strong>Phone:</strong> {{ $profile->phone_number }}</p>
                                    <p class="text-gray-700"><strong>Location:</strong> {{ $profile->location }}</p>
                                    
                                    <div class="mt-4">
                                        <h6 class="text-md font-semibold text-gray-900">Additional Information</h6>
                                        <p class="text-gray-700 mt-2"><strong>Education:</strong> {{ $profile->education }}</p>
                                        <p class="text-gray-700"><strong>Workspace:</strong> {{ $profile->workspace }}</p>
                                        <p class="text-gray-700"><strong>Skills:</strong> {{ $profile->skills }}</p>
                                        <p class="text-gray-700"><strong>Occupation:</strong> {{ $profile->current_occupation }}</p>
                                        <p class="text-gray-700"><strong>Instagram:</strong> <a href="{{ $profile->instagram_link }}" class="text-blue-500">{{ $profile->instagram_link }}</a></p>
                                        <p class="text-gray-700"><strong>LinkedIn:</strong> <a href="{{ $profile->linkedin_profile }}" class="text-blue-500">{{ $profile->linkedin_profile }}</a></p>
                                        <p class="text-gray-700"><strong>Gender:</strong> {{ $profile->gender }}</p>
                                        <p class="text-gray-700"><strong>Age:</strong> {{ $profile->age }}</p>
                                    </div>

                                    <div class="flex mt-4 space-x-2">
                                        <a href="{{ route('profiles.edit', $profile->id) }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Edit</a>
                                        <form action="{{ route('profiles.destroy', $profile->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
