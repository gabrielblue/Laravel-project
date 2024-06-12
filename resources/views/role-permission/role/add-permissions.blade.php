<x-app-layout>

    <div class="container mx-auto mt-5">
        <div class="grid grid-cols-1">
            <div class="col-span-1">

                @if (session('status'))
                    <div class="bg-green-100 text-green-700 p-4 rounded mb-4">{{ session('status') }}</div>
                @endif

                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <div class="bg-gray-800 text-white px-6 py-4">
                        <h4 class="text-lg font-semibold">Role : {{ $role->name }}
                            <a href="{{ url('roles') }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded float-right">Back</a>
                        </h4>
                    </div>
                    <div class="p-6">

                        <form action="{{ url('roles/'.$role->id.'/give-permissions') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-4">
                                @error('permission')
                                <span class="text-red-500">{{ $message }}</span>
                                @enderror

                                <label class="block text-gray-700 font-bold mb-2" for="permissions">Permissions</label>

                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                    @foreach ($permissions as $permission)
                                    <div>
                                        <label class="inline-flex items-center">
                                            <input
                                                type="checkbox"
                                                name="permission[]"
                                                value="{{ $permission->name }}"
                                                class="form-checkbox h-5 w-5 text-blue-600"
                                                {{ in_array($permission->id, $rolePermissions) ? 'checked':'' }}
                                            />
                                            <span class="ml-2 text-gray-700">{{ $permission->name }}</span>
                                        </label>
                                    </div>
                                    @endforeach
                                </div>

                            </div>
                            <div class="mb-4">
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
