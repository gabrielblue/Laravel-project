<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            // User management permissions
            'view user',
            'create user',
            'edit user',
            'delete user',
            
            // Role management permissions
            'view role',
            'create role',
            'edit role',
            'delete role',
            
            // Permission management permissions
            'view permission',
            'create permission',
            'edit permission',
            'delete permission',
            
            // Job management permissions
            'view job',
            'create job',
            'edit job',
            'delete job',
            'publish job',
            'apply job',
            
            // Job application permissions
            'view application',
            'create application',
            'edit application',
            'delete application',
            'review application',
            'approve application',
            'reject application',
            
            // Profile management permissions
            'view profile',
            'create profile',
            'edit profile',
            'delete profile',
            'view own profile',
            'edit own profile',
            
            // Project management permissions
            'view project',
            'create project',
            'edit project',
            'delete project',
            'publish project',
            
            // Skill management permissions
            'view skill',
            'create skill',
            'edit skill',
            'delete skill',
            
            // Dashboard and analytics permissions
            'view dashboard',
            'view analytics',
            'view reports',
            
            // Notification permissions
            'send notification',
            'view notification',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles and assign permissions
        
        // Super Admin - has all permissions
        $superAdminRole = Role::create(['name' => 'super-admin']);
        $superAdminRole->givePermissionTo(Permission::all());

        // Admin - has most permissions except super admin specific ones
        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo([
            'view user', 'create user', 'edit user', 'delete user',
            'view role', 'create role', 'edit role',
            'view permission',
            'view job', 'create job', 'edit job', 'delete job', 'publish job',
            'view application', 'review application', 'approve application', 'reject application',
            'view profile', 'create profile', 'edit profile', 'delete profile',
            'view project', 'create project', 'edit project', 'delete project', 'publish project',
            'view skill', 'create skill', 'edit skill', 'delete skill',
            'view dashboard', 'view analytics', 'view reports',
            'send notification', 'view notification',
        ]);

        // HR Role - manages jobs and applications
        $hrRole = Role::create(['name' => 'hr']);
        $hrRole->givePermissionTo([
            'view job', 'create job', 'edit job', 'publish job',
            'view application', 'review application', 'approve application', 'reject application',
            'view profile', 'view own profile', 'edit own profile',
            'view project',
            'view skill',
            'view dashboard',
            'send notification', 'view notification',
        ]);

        // Employer Role - can post jobs and review applications for their jobs
        $employerRole = Role::create(['name' => 'employer']);
        $employerRole->givePermissionTo([
            'view job', 'create job', 'edit job', 'publish job',
            'view application', 'review application',
            'view profile', 'view own profile', 'edit own profile',
            'view project',
            'view skill',
            'view dashboard',
            'view notification',
        ]);

        // Alumni Role - can view jobs, apply, manage profile, and create projects
        $alumniRole = Role::create(['name' => 'alumni']);
        $alumniRole->givePermissionTo([
            'view job', 'apply job',
            'create application',
            'view profile', 'view own profile', 'edit own profile',
            'view project', 'create project', 'edit project',
            'view skill',
            'view dashboard',
            'view notification',
        ]);

        // Student Role - similar to alumni but focused on internships and entry-level
        $studentRole = Role::create(['name' => 'student']);
        $studentRole->givePermissionTo([
            'view job', 'apply job',
            'create application',
            'view profile', 'view own profile', 'edit own profile',
            'view project', 'create project', 'edit project',
            'view skill',
            'view dashboard',
            'view notification',
        ]);

        // Create default users
        
        // Super Admin User
        $superAdmin = User::create([
            'name' => 'Super Administrator',
            'email' => 'superadmin@jobportal.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
        $superAdmin->assignRole($superAdminRole);

        // Admin User
        $admin = User::create([
            'name' => 'System Administrator',
            'email' => 'admin@jobportal.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
        $admin->assignRole($adminRole);

        // HR User
        $hr = User::create([
            'name' => 'HR Manager',
            'email' => 'hr@jobportal.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
        $hr->assignRole($hrRole);

        // Employer User
        $employer = User::create([
            'name' => 'Employer Representative',
            'email' => 'employer@jobportal.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
        $employer->assignRole($employerRole);

        // Alumni User
        $alumni = User::create([
            'name' => 'Alumni Member',
            'email' => 'alumni@jobportal.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
        $alumni->assignRole($alumniRole);

        // Student User
        $student = User::create([
            'name' => 'Student Member',
            'email' => 'student@jobportal.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
        $student->assignRole($studentRole);

        $this->command->info('Roles and permissions seeded successfully!');
        $this->command->info('Default users created with the following credentials:');
        $this->command->info('Super Admin: superadmin@jobportal.com / password');
        $this->command->info('Admin: admin@jobportal.com / password');
        $this->command->info('HR: hr@jobportal.com / password');
        $this->command->info('Employer: employer@jobportal.com / password');
        $this->command->info('Alumni: alumni@jobportal.com / password');
        $this->command->info('Student: student@jobportal.com / password');
    }
}