<x-app-layout>

    <div class="container mx-auto mt-5">
        <div class="flex space-x-4">
            <a href="{{ url('roles') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Roles</a>
            <a href="{{ url('permissions') }}" class="bg-teal-500 text-white px-4 py-2 rounded hover:bg-teal-600">Permissions</a>
            <a href="{{ url('users') }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Users</a>
        </div>
    </div>

    <div class="container mx-auto mt-2">
        <div class="flex justify-center">
            <div class="w-full max-w-4xl">

                @if (session('status'))
                    <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="bg-white shadow-md rounded-lg mt-3">
                    <div class="bg-gray-100 px-6 py-4 border-b border-gray-200">
                        <h4 class="text-lg font-semibold flex justify-between items-center">
                            Permissions
                           
                            <a href="{{ url('permissions/create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add Permission</a>
                        
                        </h4>
                    </div>
                    <div class="p-6">
                        <table class="min-w-full bg-white border border-gray-200">
                            <thead>
                                <tr class="bg-gray-100 border-b">
                                    <th class="py-2 px-4 border-r">Id</th>
                                    <th class="py-2 px-4 border-r">Name</th>
                                    <th class="py-2 px-4">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $permission)
                                <tr class="border-b">
                                    <td class="py-2 px-4 border-r">{{ $permission->id }}</td>
                                    <td class="py-2 px-4 border-r">{{ $permission->name }}</td>
                                    <td class="py-2 px-4 flex space-x-2">
                                        
                                        <a href="{{ url('permissions/'.$permission->id.'/edit') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Edit</a>
                                        

                                       
                                        <a href="{{ url('permissions/'.$permission->id.'/delete') }}" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Delete</a>
                                        
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
