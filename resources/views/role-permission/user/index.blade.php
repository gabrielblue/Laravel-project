<x-app-layout>
    <div class="container mx-auto mt-2">
        <div class="grid grid-cols-1">
            <div class="col-span-1">

                @if (session('status'))
                    <div class="bg-green-100 text-green-700 p-4 rounded mb-4">{{ session('status') }}</div>
                @endif

                <div class="bg-white shadow-md rounded-lg overflow-hidden mt-3">
                    <div class="bg-gray-800 text-white px-6 py-4">
                        <h4 class="text-lg font-semibold">Users
                            <a href="{{ url('users/create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded float-right">
                                <i class="fas fa-user-plus fa-lg"></i> Add User
                            </a>
                        </h4>
                    </div>
                    <div class="p-6">

                        <table class="min-w-full bg-white">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2">Id</th>
                                    <th class="px-4 py-2">Name</th>
                                    <th class="px-4 py-2">Email</th>
                                    <th class="px-4 py-2">Roles</th>
                                    <th class="px-4 py-2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td class="border px-4 py-2">{{ $user->id }}</td>
                                    <td class="border px-4 py-2">{{ $user->name }}</td>
                                    <td class="border px-4 py-2">{{ $user->email }}</td>
                                    <td class="border px-4 py-2">
                                        @if (!empty($user->getRoleNames()))
                                            @foreach ($user->getRoleNames() as $rolename)
                                                <span class="bg-blue-500 text-white px-2 py-1 rounded">{{ $rolename }}</span>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td class="border px-4 py-2">
                                        <a href="{{ url('users/'.$user->id.'/edit') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                            <i class="fas fa-edit fa-lg"></i> Edit
                                        </a>
                                        <a href="{{ url('users/'.$user->id.'/delete') }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mx-2">
                                            <i class="fas fa-trash fa-lg"></i> Delete
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
    </div>
</x-app-layout>
