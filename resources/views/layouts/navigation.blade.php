<nav x-data="{ open: false }" class="bg-white/95 backdrop-blur-md border-b border-secondary-200 shadow-soft sticky top-0 z-50">
    <!-- Top Bar -->
    <div class="bg-gradient-to-r from-primary-600 to-primary-700 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-2 text-sm">
                <div class="flex items-center space-x-4">
                    <div class="flex items-center">
                        <i class="fas fa-envelope text-primary-200 mr-2"></i>
                        <a href="mailto:info@alumniportal.com" class="hover:text-primary-200 transition-colors">
                            info@alumniportal.com
                        </a>
                    </div>
                    <div class="hidden md:flex items-center">
                        <i class="fas fa-map-marker-alt text-primary-200 mr-2"></i>
                        <span>Connect • Learn • Grow</span>
                    </div>
                </div>
                <div class="flex items-center space-x-2">
                    @foreach(Auth::user()->roles as $role)
                        <span class="px-2 py-1 bg-white/20 rounded-full text-xs font-medium">
                            {{ ucfirst($role->name) }}
                        </span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Main Navigation -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 group">
                    <div class="w-10 h-10 bg-gradient-to-br from-primary-500 to-primary-600 rounded-xl flex items-center justify-center shadow-medium group-hover:shadow-strong transition-all duration-200">
                        <i class="fas fa-graduation-cap text-white text-lg"></i>
                    </div>
                    <div class="hidden md:block">
                        <h1 class="font-display text-xl font-bold text-secondary-800">Alumni Portal</h1>
                        <p class="text-xs text-secondary-500">Job & Career Hub</p>
                    </div>
                </a>
            </div>

            <!-- Desktop Navigation Links -->
            <div class="hidden lg:flex items-center space-x-1">
                <!-- Dashboard -->
                <a href="{{ route('dashboard') }}" 
                   class="nav-link {{ request()->routeIs('dashboard') ? 'nav-link-active' : 'nav-link-inactive' }}">
                    <i class="fas fa-tachometer-alt mr-2"></i>
                    Dashboard
                </a>

                <!-- Admin Section -->
                @role('super-admin|admin')
                <div x-data="{ adminOpen: false }" class="relative">
                    <button @click="adminOpen = !adminOpen" 
                            class="nav-link nav-link-inactive flex items-center">
                        <i class="fas fa-cogs mr-2"></i>
                        Administration
                        <i class="fas fa-chevron-down ml-1 text-xs"></i>
                    </button>
                    <div x-show="adminOpen" @click.away="adminOpen = false" 
                         x-transition class="absolute top-full left-0 mt-1 w-56 bg-white rounded-xl shadow-strong border border-secondary-200 py-2 z-50">
                        @can('view user')
                        <a href="{{ url('users') }}" class="flex items-center px-4 py-2 text-sm text-secondary-700 hover:bg-secondary-50">
                            <i class="fas fa-users mr-3 text-secondary-400"></i>
                            Users
                        </a>
                        @endcan
                        @can('view role')
                        <a href="{{ url('roles') }}" class="flex items-center px-4 py-2 text-sm text-secondary-700 hover:bg-secondary-50">
                            <i class="fas fa-user-shield mr-3 text-secondary-400"></i>
                            Roles
                        </a>
                        @endcan
                        @can('view permission')
                        <a href="{{ url('permissions') }}" class="flex items-center px-4 py-2 text-sm text-secondary-700 hover:bg-secondary-50">
                            <i class="fas fa-key mr-3 text-secondary-400"></i>
                            Permissions
                        </a>
                        @endcan
                    </div>
                </div>
                @endrole

                <!-- Jobs Section -->
                @can('view job')
                <div x-data="{ jobsOpen: false }" class="relative">
                    <button @click="jobsOpen = !jobsOpen" 
                            class="nav-link nav-link-inactive flex items-center">
                        <i class="fas fa-briefcase mr-2"></i>
                        Jobs
                        <i class="fas fa-chevron-down ml-1 text-xs"></i>
                    </button>
                    <div x-show="jobsOpen" @click.away="jobsOpen = false" 
                         x-transition class="absolute top-full left-0 mt-1 w-56 bg-white rounded-xl shadow-strong border border-secondary-200 py-2 z-50">
                        <a href="{{ route('jobs.index') }}" class="flex items-center px-4 py-2 text-sm text-secondary-700 hover:bg-secondary-50">
                            <i class="fas fa-list mr-3 text-secondary-400"></i>
                            All Jobs
                        </a>
                        @role('super-admin|admin|hr|employer')
                        <a href="{{ route('jobs.create') }}" class="flex items-center px-4 py-2 text-sm text-secondary-700 hover:bg-secondary-50">
                            <i class="fas fa-plus mr-3 text-secondary-400"></i>
                            Post Job
                        </a>
                        <a href="{{ route('jobs.applications') }}" class="flex items-center px-4 py-2 text-sm text-secondary-700 hover:bg-secondary-50">
                            <i class="fas fa-file-alt mr-3 text-secondary-400"></i>
                            Applications
                        </a>
                        @endrole
                    </div>
                </div>
                @endcan

                <!-- Projects -->
                @can('view project')
                <a href="{{ url('projects') }}" 
                   class="nav-link {{ request()->is('projects*') ? 'nav-link-active' : 'nav-link-inactive' }}">
                    <i class="fas fa-project-diagram mr-2"></i>
                    Projects
                </a>
                @endcan

                <!-- Profiles -->
                @can('view profile')
                <a href="{{ url('profiles') }}" 
                   class="nav-link {{ request()->is('profiles*') ? 'nav-link-active' : 'nav-link-inactive' }}">
                    <i class="fas fa-user mr-2"></i>
                    Profiles
                </a>
                @endcan
            </div>

            <!-- User Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <div x-data="{ userOpen: false }" class="relative">
                    <button @click="userOpen = !userOpen" 
                            class="flex items-center space-x-3 px-3 py-2 rounded-xl text-sm font-medium text-secondary-700 hover:bg-secondary-50 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition-all duration-200">
                        <div class="w-8 h-8 bg-gradient-to-br from-primary-400 to-primary-600 rounded-lg flex items-center justify-center text-white text-sm font-semibold">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <div class="hidden md:block text-left">
                            <div class="font-medium">{{ Auth::user()->name }}</div>
                            <div class="text-xs text-secondary-500">{{ Auth::user()->email }}</div>
                        </div>
                        <i class="fas fa-chevron-down text-xs text-secondary-400"></i>
                    </button>

                    <div x-show="userOpen" @click.away="userOpen = false" 
                         x-transition class="absolute right-0 top-full mt-2 w-64 bg-white rounded-xl shadow-strong border border-secondary-200 py-2 z-50">
                        <div class="px-4 py-3 border-b border-secondary-200">
                            <div class="font-medium text-secondary-800">{{ Auth::user()->name }}</div>
                            <div class="text-sm text-secondary-500">{{ Auth::user()->email }}</div>
                            <div class="flex flex-wrap gap-1 mt-2">
                                @foreach(Auth::user()->roles as $role)
                                    <span class="badge-primary">{{ ucfirst($role->name) }}</span>
                                @endforeach
                            </div>
                        </div>
                        <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-2 text-sm text-secondary-700 hover:bg-secondary-50">
                            <i class="fas fa-user-edit mr-3 text-secondary-400"></i>
                            Edit Profile
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full flex items-center px-4 py-2 text-sm text-danger-700 hover:bg-danger-50">
                                <i class="fas fa-sign-out-alt mr-3 text-danger-400"></i>
                                Log Out
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Mobile menu button -->
            <div class="flex items-center sm:hidden">
                <button @click="open = !open" 
                        class="inline-flex items-center justify-center p-2 rounded-xl text-secondary-400 hover:text-secondary-500 hover:bg-secondary-100 focus:outline-none focus:ring-2 focus:ring-primary-500 transition-all duration-200">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open}" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{'hidden': !open, 'inline-flex': open}" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation Menu -->
    <div :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden bg-white/95 backdrop-blur-md border-t border-secondary-200">
        <div class="px-4 py-3 space-y-1">
            <!-- Mobile User Info -->
            <div class="flex items-center space-x-3 pb-3 border-b border-secondary-200">
                <div class="w-10 h-10 bg-gradient-to-br from-primary-400 to-primary-600 rounded-lg flex items-center justify-center text-white font-semibold">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div>
                    <div class="font-medium text-secondary-800">{{ Auth::user()->name }}</div>
                    <div class="text-sm text-secondary-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <!-- Mobile Navigation Links -->
            <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->routeIs('dashboard') ? 'sidebar-link-active' : 'sidebar-link-inactive' }}">
                <i class="fas fa-tachometer-alt mr-3"></i>
                Dashboard
            </a>

            @can('view job')
            <a href="{{ route('jobs.index') }}" class="sidebar-link {{ request()->is('jobs*') ? 'sidebar-link-active' : 'sidebar-link-inactive' }}">
                <i class="fas fa-briefcase mr-3"></i>
                Jobs
            </a>
            @endcan

            @can('view project')
            <a href="{{ url('projects') }}" class="sidebar-link {{ request()->is('projects*') ? 'sidebar-link-active' : 'sidebar-link-inactive' }}">
                <i class="fas fa-project-diagram mr-3"></i>
                Projects
            </a>
            @endcan

            @can('view profile')
            <a href="{{ url('profiles') }}" class="sidebar-link {{ request()->is('profiles*') ? 'sidebar-link-active' : 'sidebar-link-inactive' }}">
                <i class="fas fa-user mr-3"></i>
                Profiles
            </a>
            @endcan

            @role('super-admin|admin')
            <div class="pt-3 border-t border-secondary-200">
                <div class="text-xs font-semibold text-secondary-500 uppercase tracking-wide mb-2">Administration</div>
                @can('view user')
                <a href="{{ url('users') }}" class="sidebar-link sidebar-link-inactive">
                    <i class="fas fa-users mr-3"></i>
                    Users
                </a>
                @endcan
                @can('view role')
                <a href="{{ url('roles') }}" class="sidebar-link sidebar-link-inactive">
                    <i class="fas fa-user-shield mr-3"></i>
                    Roles
                </a>
                @endcan
                @can('view permission')
                <a href="{{ url('permissions') }}" class="sidebar-link sidebar-link-inactive">
                    <i class="fas fa-key mr-3"></i>
                    Permissions
                </a>
                @endcan
            </div>
            @endrole

            <!-- Mobile Profile & Logout -->
            <div class="pt-3 border-t border-secondary-200">
                <a href="{{ route('profile.edit') }}" class="sidebar-link sidebar-link-inactive">
                    <i class="fas fa-user-edit mr-3"></i>
                    Edit Profile
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full sidebar-link text-danger-600 hover:bg-danger-50 hover:text-danger-700">
                        <i class="fas fa-sign-out-alt mr-3"></i>
                        Log Out
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
