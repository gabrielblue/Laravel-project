<!-- <x-app-layout>

    <div class="container mx-auto mt-5">
        <div class="flex justify-center">
            <div class="w-full max-w-2xl">

                @if ($errors->any())
                <div class="alert alert-warning bg-yellow-200 text-yellow-800 p-4 rounded mb-4">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="bg-white shadow-md rounded-lg">
                    <div class="bg-gray-100 px-6 py-4 border-b border-gray-200">
                        <h4 class="text-lg font-semibold">Create Permission
                            <a href="{{ url('permissions') }}" class="bg-red-500 text-white px-4 py-2 rounded-lg float-right hover:bg-red-600">Back</a>
                        </h4>
                    </div>
                    <div class="px-6 py-4">
                        <form action="{{ url('permissions') }}" method="POST">
                            @csrf

                            <div class="mb-4">
                                <label for="permission-name" class="block text-gray-700">Permission Name</label>
                                <input type="text" name="name" id="permission-name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                            </div>
                            <div class="mb-4">
                                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout> -->
