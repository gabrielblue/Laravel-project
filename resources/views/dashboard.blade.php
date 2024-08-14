<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @role('super-admin|admin')
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
            <a href="{{ url('roles') }}" class="bg-black hover:bg-gray-800 text-white font-bold py-2 px-4 rounded">Roles</a>
        </div>
        <!-- Permissions Card -->
        <div class="bg-white shadow-md rounded-lg p-4">
            <h2 class="text-xl font-bold mb-2">Permissions</h2>
            <p class="mb-4">Define specific permissions to control what actions users can perform.</p>
            <a href="{{ url('permissions') }}" class="bg-black hover:bg-gray-800 text-white font-bold py-2 px-4 rounded">Permissions</a>
        </div>
        <!-- Users Card -->
        <div class="bg-white shadow-md rounded-lg p-4">
            <h2 class="text-xl font-bold mb-2">Users</h2>
            <p class="mb-4">Manage user accounts, including adding, removing, and updating user information.</p>
            <a href="{{ url('users') }}" class="bg-black hover:bg-gray-800 text-white font-bold py-2 px-4 rounded">Users</a>
        </div>
    </div>
    @endrole

    @role('alumni')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Welcome Alumni!") }}
                </div>
            </div>
        </div>
    </div>
    <div class="container mx-auto mt-5 grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- Jobs Card -->
        <div class="bg-white shadow-md rounded-lg p-4">
            <h2 class="text-xl font-bold mb-2">Jobs</h2>
            <p class="mb-4">Browse available job opportunities.</p>
            <a href="{{ url('view_jobs') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Jobs</a>
        </div>
        <!-- Projects Card -->
        <div class="bg-white shadow-md rounded-lg p-4">
            <h2 class="text-xl font-bold mb-2">Projects</h2>
            <p class="mb-4">Explore projects that might interest you.</p>
            <a href="{{ url('projects') }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Projects</a>
        </div>
    </div>
    @endrole
</x-app-layout>
