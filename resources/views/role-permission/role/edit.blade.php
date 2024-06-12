<x-app-layout>

    <div class="container mx-auto mt-5">
        <div class="flex justify-center">
            <div class="w-full max-w-4xl">

                @if ($errors->any())
                <ul class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded mb-4 list-disc">
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
                @endif

                <div class="bg-white shadow-md rounded-lg">
                    <div class="bg-gray-100 px-6 py-4 border-b border-gray-200">
                        <h4 class="text-lg font-semibold flex justify-between items-center">
                            Edit Role
                            <a href="{{ url('roles') }}" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Back</a>
                        </h4>
                    </div>
                    <div class="p-6">
                        <form action="{{ url('roles/'.$role->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-4">
                                <label for="name" class="block text-gray-700">Role Name</label>
                                <input type="text" name="name" id="name" value="{{ $role->name }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
                            </div>
                            <div class="flex justify-end">
                                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
