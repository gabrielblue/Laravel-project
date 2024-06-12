<x-app-layout>

    <div class="container mx-auto mt-5">
        <div class="grid grid-cols-1">
            <div class="col-span-1">

                @if ($errors->any())
                <ul class="bg-yellow-100 text-yellow-700 p-4 rounded mb-4 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                @endif

                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <div class="bg-gray-800 text-white px-6 py-4">
                        <h4 class="text-lg font-semibold">Edit User
                            <a href="{{ url('users') }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded float-right">Back</a>
                        </h4>
                    </div>
                    <div class="p-6">
                        <form action="{{ url('users/'.$user->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-4">
                                <label for="name" class="block text-gray-700 font-bold mb-2">Name</label>
                                <input type="text" name="name" value="{{ $user->name }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
                                @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-4">
                                <label for="email" class="block text-gray-700 font-bold mb-2">Email</label>
                                <input type="text" name="email" readonly value="{{ $user->email }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
                            </div>
                            <div class="mb-4">
                                <label for="password" class="block text-gray-700 font-bold mb-2">Password</label>
                                <input type="text" name="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
                                @error('password') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-4">
                                <label for="roles" class="block text-gray-700 font-bold mb-2">Roles</label>
                                <select name="roles[]" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" multiple>
                                    <option value="">Select Role</option>
                                    @foreach ($roles as $role)
                                    <option
                                        value="{{ $role }}"
                                        {{ in_array($role, $userRoles) ? 'selected':'' }}
                                    >
                                        {{ $role }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('roles') <span class="text-red-500">{{ $message }}</span> @enderror
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
