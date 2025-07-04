<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-display text-3xl font-bold text-secondary-800">
                {{ __('Dashboard') }}
            </h2>
            <div class="flex items-center space-x-4">
                <div class="text-sm text-secondary-600">
                    Welcome back, <span class="font-semibold text-secondary-800">{{ Auth::user()->name }}</span>
                </div>
                <div class="flex items-center space-x-2">
                    @foreach(Auth::user()->roles as $role)
                        <span class="badge-primary">{{ ucfirst($role->name) }}</span>
                    @endforeach
                </div>
            </div>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Quick Stats -->
        @role('super-admin|admin')
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="card hover-lift fade-in">
                <div class="card-body">
                    <div class="flex items-center">
                        <div class="icon-primary">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="ml-4">
                            <div class="text-sm font-medium text-secondary-600">Total Users</div>
                            <div class="text-2xl font-bold text-secondary-900">{{ \App\Models\User::count() }}</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card hover-lift fade-in" style="animation-delay: 0.1s">
                <div class="card-body">
                    <div class="flex items-center">
                        <div class="icon-success">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <div class="ml-4">
                            <div class="text-sm font-medium text-secondary-600">Total Jobs</div>
                            <div class="text-2xl font-bold text-secondary-900">{{ \App\Models\Job::count() }}</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card hover-lift fade-in" style="animation-delay: 0.2s">
                <div class="card-body">
                    <div class="flex items-center">
                        <div class="icon-warning">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <div class="ml-4">
                            <div class="text-sm font-medium text-secondary-600">Applications</div>
                            <div class="text-2xl font-bold text-secondary-900">{{ \App\Models\JobApplication::count() }}</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card hover-lift fade-in" style="animation-delay: 0.3s">
                <div class="card-body">
                    <div class="flex items-center">
                        <div class="icon-danger">
                            <i class="fas fa-project-diagram"></i>
                        </div>
                        <div class="ml-4">
                            <div class="text-sm font-medium text-secondary-600">Projects</div>
                            <div class="text-2xl font-bold text-secondary-900">{{ \App\Models\Project::count() }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endrole

        <!-- Admin Management Section -->
        @role('super-admin|admin')
        <div class="mb-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-xl font-display font-semibold text-secondary-800">
                        <i class="fas fa-cogs mr-2 text-primary-600"></i>
                        System Administration
                    </h3>
                    <p class="text-sm text-secondary-600 mt-1">Manage users, roles, and permissions</p>
                </div>
                <div class="card-body">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Roles Management -->
                        <div class="group">
                            <div class="card hover-lift transition-all duration-300 group-hover:shadow-strong">
                                <div class="card-body text-center">
                                    <div class="icon-primary mx-auto mb-4">
                                        <i class="fas fa-user-shield text-2xl"></i>
                                    </div>
                                    <h4 class="text-lg font-semibold text-secondary-800 mb-2">Roles</h4>
                                    <p class="text-secondary-600 text-sm mb-4">Manage and assign roles to control access levels</p>
                                    <a href="{{ url('roles') }}" class="btn-primary w-full">
                                        <i class="fas fa-arrow-right mr-2"></i>
                                        Manage Roles
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Permissions Management -->
                        <div class="group">
                            <div class="card hover-lift transition-all duration-300 group-hover:shadow-strong">
                                <div class="card-body text-center">
                                    <div class="icon-warning mx-auto mb-4">
                                        <i class="fas fa-key text-2xl"></i>
                                    </div>
                                    <h4 class="text-lg font-semibold text-secondary-800 mb-2">Permissions</h4>
                                    <p class="text-secondary-600 text-sm mb-4">Define specific permissions for granular control</p>
                                    <a href="{{ url('permissions') }}" class="btn-warning w-full">
                                        <i class="fas fa-arrow-right mr-2"></i>
                                        Manage Permissions
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Users Management -->
                        <div class="group">
                            <div class="card hover-lift transition-all duration-300 group-hover:shadow-strong">
                                <div class="card-body text-center">
                                    <div class="icon-success mx-auto mb-4">
                                        <i class="fas fa-users text-2xl"></i>
                                    </div>
                                    <h4 class="text-lg font-semibold text-secondary-800 mb-2">Users</h4>
                                    <p class="text-secondary-600 text-sm mb-4">Manage user accounts and information</p>
                                    <a href="{{ url('users') }}" class="btn-success w-full">
                                        <i class="fas fa-arrow-right mr-2"></i>
                                        Manage Users
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Job Management for Admins -->
        <div class="mb-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-xl font-display font-semibold text-secondary-800">
                        <i class="fas fa-briefcase mr-2 text-success-600"></i>
                        Job Management
                    </h3>
                    <p class="text-sm text-secondary-600 mt-1">Manage job postings and applications</p>
                </div>
                <div class="card-body">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="group">
                            <div class="card hover-lift transition-all duration-300 group-hover:shadow-strong">
                                <div class="card-body text-center">
                                    <div class="icon-success mx-auto mb-4">
                                        <i class="fas fa-plus-circle text-2xl"></i>
                                    </div>
                                    <h4 class="text-lg font-semibold text-secondary-800 mb-2">Manage Jobs</h4>
                                    <p class="text-secondary-600 text-sm mb-4">Create, edit, and manage job postings</p>
                                    <a href="{{ route('jobs.index') }}" class="btn-success w-full">
                                        <i class="fas fa-arrow-right mr-2"></i>
                                        View Jobs
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="group">
                            <div class="card hover-lift transition-all duration-300 group-hover:shadow-strong">
                                <div class="card-body text-center">
                                    <div class="icon-warning mx-auto mb-4">
                                        <i class="fas fa-file-alt text-2xl"></i>
                                    </div>
                                    <h4 class="text-lg font-semibold text-secondary-800 mb-2">Applications</h4>
                                    <p class="text-secondary-600 text-sm mb-4">Review and manage job applications</p>
                                    <a href="{{ route('jobs.applications') }}" class="btn-warning w-full">
                                        <i class="fas fa-arrow-right mr-2"></i>
                                        View Applications
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endrole

        <!-- Alumni/Student/Employer Section -->
        @role('alumni|student|employer')
        <div class="mb-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-xl font-display font-semibold text-secondary-800">
                        <i class="fas fa-graduation-cap mr-2 text-primary-600"></i>
                        {{ Auth::user()->hasRole('alumni') ? 'Alumni Portal' : (Auth::user()->hasRole('student') ? 'Student Portal' : 'Employer Portal') }}
                    </h3>
                    <p class="text-sm text-secondary-600 mt-1">
                        {{ Auth::user()->hasRole('alumni') ? 'Access job opportunities and manage your profile' : (Auth::user()->hasRole('student') ? 'Find internships and job opportunities' : 'Post jobs and find talent') }}
                    </p>
                </div>
                <div class="card-body">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        
                        @if(Auth::user()->hasRole(['alumni', 'student']))
                        <!-- Jobs for Alumni/Students -->
                        <div class="group">
                            <div class="card hover-lift transition-all duration-300 group-hover:shadow-strong">
                                <div class="card-body text-center">
                                    <div class="icon-primary mx-auto mb-4">
                                        <i class="fas fa-search text-2xl"></i>
                                    </div>
                                    <h4 class="text-lg font-semibold text-secondary-800 mb-2">Browse Jobs</h4>
                                    <p class="text-secondary-600 text-sm mb-4">Explore available job opportunities</p>
                                    <a href="{{ url('view_jobs') }}" class="btn-primary w-full">
                                        <i class="fas fa-arrow-right mr-2"></i>
                                        View Jobs
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Profile Management -->
                        <div class="group">
                            <div class="card hover-lift transition-all duration-300 group-hover:shadow-strong">
                                <div class="card-body text-center">
                                    <div class="icon-success mx-auto mb-4">
                                        <i class="fas fa-user text-2xl"></i>
                                    </div>
                                    <h4 class="text-lg font-semibold text-secondary-800 mb-2">My Profile</h4>
                                    <p class="text-secondary-600 text-sm mb-4">Manage your professional profile</p>
                                    <a href="{{ url('profiles') }}" class="btn-success w-full">
                                        <i class="fas fa-arrow-right mr-2"></i>
                                        View Profile
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endif

                        @if(Auth::user()->hasRole('employer'))
                        <!-- Post Jobs for Employers -->
                        <div class="group">
                            <div class="card hover-lift transition-all duration-300 group-hover:shadow-strong">
                                <div class="card-body text-center">
                                    <div class="icon-success mx-auto mb-4">
                                        <i class="fas fa-plus-circle text-2xl"></i>
                                    </div>
                                    <h4 class="text-lg font-semibold text-secondary-800 mb-2">Post Jobs</h4>
                                    <p class="text-secondary-600 text-sm mb-4">Create and manage job postings</p>
                                    <a href="{{ route('jobs.create') }}" class="btn-success w-full">
                                        <i class="fas fa-arrow-right mr-2"></i>
                                        Post Job
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Projects -->
                        <div class="group">
                            <div class="card hover-lift transition-all duration-300 group-hover:shadow-strong">
                                <div class="card-body text-center">
                                    <div class="icon-danger mx-auto mb-4">
                                        <i class="fas fa-project-diagram text-2xl"></i>
                                    </div>
                                    <h4 class="text-lg font-semibold text-secondary-800 mb-2">Projects</h4>
                                    <p class="text-secondary-600 text-sm mb-4">Explore and manage projects</p>
                                    <a href="{{ url('projects') }}" class="btn-danger w-full">
                                        <i class="fas fa-arrow-right mr-2"></i>
                                        View Projects
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endrole

        <!-- Recent Activity Section -->
        <div class="card">
            <div class="card-header">
                <h3 class="text-xl font-display font-semibold text-secondary-800">
                    <i class="fas fa-clock mr-2 text-secondary-600"></i>
                    Recent Activity
                </h3>
            </div>
            <div class="card-body">
                <div class="text-center py-8">
                    <div class="icon-warning mx-auto mb-4">
                        <i class="fas fa-chart-line text-2xl"></i>
                    </div>
                    <p class="text-secondary-600">Activity tracking will be available soon!</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
