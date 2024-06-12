<x-app-layout>






    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>




    <div class="container mx-auto mt-5 grid grid-cols-1 md:grid-cols-3 gap-4">
    <!-- Roles Card -->
    <div class="bg-white shadow-md rounded-lg p-4">
        <h2 class="text-xl font-bold mb-2">Roles</h2>
        <p class="mb-4">Manage and assign roles to users to control access levels within the application.</p>
        <a href="{{ url('roles') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Roles</a>
    </div>
    <!-- Permissions Card -->
    <div class="bg-white shadow-md rounded-lg p-4">
        <h2 class="text-xl font-bold mb-2">Permissions</h2>
        <p class="mb-4">Define specific permissions to control what actions users can perform.</p>
        <a href="{{ url('permissions') }}" class="bg-teal-500 hover:bg-teal-700 text-white font-bold py-2 px-4 rounded">Permissions</a>
    </div>
    <!-- Users Card -->
    <div class="bg-white shadow-md rounded-lg p-4">
        <h2 class="text-xl font-bold mb-2">Users</h2>
        <p class="mb-4">Manage user accounts, including adding, removing, and updating user information.</p>
        <a href="{{ url('users') }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">Users</a>
    </div>
</div>

</x-app-layout>
