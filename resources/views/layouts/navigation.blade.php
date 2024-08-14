<nav x-data="{ open: false }" class="bg-white border-b border-gray-200">
    <!-- Top Red Part -->
    <div class="bg-red-600 text-white md:px-20 lg:px-40 xl:px-30">
        <div class="flex justify-between font-bold text-sm py-1">
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                    <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414zM0 4.697v7.104l5.803-3.558zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586zm3.436-.586L16 11.801V4.697z"/>
                </svg>
                <a href="" class="mx-1">info@isteducation.com</a>
            </div>
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                    <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6"/>
                </svg>
                <p class="mx-1">Westpoint Building, Mpaka Road, Westlands, Nairobi</p>
            </div>
        </div>
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('dashboard') }}" class="shrink-0">
                    <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                </a>
            </div>

            <!-- Navigation Links -->
            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex items-center">
                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-nav-link>
                @can('view role')
                <x-nav-link :href="url('roles')" :active="request()->is('roles')">
                    {{ __('Roles') }}
                </x-nav-link>
                @endcan
                @can('view permission')
                <x-nav-link :href="url('permissions')" :active="request()->is('permissions')">
                    {{ __('Permissions') }}
                </x-nav-link>
                @endcan
                @can('view user')
                <x-nav-link :href="url('users')" :active="request()->is('users')">
                    {{ __('Users') }}
                </x-nav-link>
                @endcan
                @can('view job')
                <x-nav-link :href="url('jobs')" :active="request()->is('jobs')">
                    {{ __('Jobs') }}
                </x-nav-link>
                <x-nav-link :href="route('jobs.applications')" :active="request()->routeIs('jobs.applications')">
                    {{ __('Applications') }}
                </x-nav-link>
                @endcan
                @can('view project')
                <x-nav-link :href="url('projects')" :active="request()->is('projects')">
                    {{ __('Projects') }}
                </x-nav-link>
                @endcan
                @can('view profile')
                <x-nav-link :href="url('profiles')" :active="request()->is('profiles')">
                    {{ __('Profiles') }}
                </x-nav-link>
                @endcan
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="url('roles')" :active="request()->is('roles')">
                {{ __('Roles') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="url('permissions')" :active="request()->is('permissions')">
                {{ __('Permissions') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="url('users')" :active="request()->is('users')">
                {{ __('Users') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="url('jobs')" :active="request()->is('jobs')">
                {{ __('Jobs') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('jobs.applications')" :active="request()->routeIs('jobs.applications')">
                {{ __('Applications') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="url('projects')" :active="request()->is('projects')">
                {{ __('Projects') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="url('profiles')" :active="request()->is('profiles')">
                {{ __('Profiles') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
