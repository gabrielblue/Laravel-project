<?php

use App\Models\Job;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\AlumniprofileController;

// Account activation routes (public)
Route::get('activate-account/{token}', [UserController::class, 'activateAccount'])->name('activate-account');
Route::post('activate-account/{token}', [UserController::class, 'setPassword'])->name('set-password');

// Admin and Super Admin only routes
Route::group(['middleware' => ['auth', 'role:super-admin|admin']], function() {
    // Permission management
    Route::resource('permissions', App\Http\Controllers\PermissionController::class);
    Route::get('permissions/{permissionId}/delete', [App\Http\Controllers\PermissionController::class, 'destroy']);

    // Role management  
    Route::resource('roles', App\Http\Controllers\RoleController::class);
    Route::get('roles/{roleId}/delete', [App\Http\Controllers\RoleController::class, 'destroy']);
    Route::get('roles/{roleId}/give-permissions', [App\Http\Controllers\RoleController::class, 'addPermissionToRole']);
    Route::put('roles/{roleId}/give-permissions', [App\Http\Controllers\RoleController::class, 'givePermissionToRole']);

    // User management
    Route::resource('users', App\Http\Controllers\UserController::class);
    Route::get('users/{userId}/delete', [App\Http\Controllers\UserController::class, 'destroy']);
});

// Admin, HR, and Employer job management routes
Route::group(['middleware' => ['auth', 'role:super-admin|admin|hr|employer']], function() {
    // Job applications management
    Route::get('/applications', [JobController::class, 'applications'])->name('jobs.applications');
    Route::get('applications/{applicationId}/review', [JobController::class, 'review'])->name('application.review');
    Route::get('applications/{applicationId}/approve', [JobController::class, 'approve'])->name('application.approve');
    Route::get('applications/{applicationId}/deny', [JobController::class, 'deny'])->name('application.deny');
});

// Job routes with proper permission middleware
Route::middleware(['auth'])->group(function() {
    // Job viewing (all authenticated users)
    Route::get('jobs', [JobController::class, 'index'])->name('jobs.index');
    Route::get('jobs/{job}', [JobController::class, 'show'])->name('jobs.show');
    Route::get('/view_jobs', function () {
        $jobs = Job::with('skills')->get();
        return view('jobs.index', compact('jobs'));
    })->name('jobs.public.index');

    // Job management (admin, hr, employer)
    Route::middleware(['role:super-admin|admin|hr|employer'])->group(function() {
        Route::get('jobs/create', [JobController::class, 'create'])->name('jobs.create');
        Route::post('jobs', [JobController::class, 'store'])->name('jobs.store');
        Route::get('jobs/{job}/edit', [JobController::class, 'edit'])->name('jobs.edit');
        Route::put('jobs/{job}', [JobController::class, 'update'])->name('jobs.update');
        Route::delete('jobs/{job}', [JobController::class, 'destroy'])->name('jobs.destroy');
    });

    // Job applications (students, alumni)
    Route::middleware(['role:student|alumni'])->group(function() {
        Route::get('jobs/apply/{job}', [JobController::class, 'apply'])->name('jobs.apply');
        Route::post('jobs/apply/{job}', [JobController::class, 'applyStore'])->name('jobs.applyStore');
    });
});

// Profile and project routes
Route::middleware(['auth'])->group(function() {
    Route::resource('profiles', AlumniprofileController::class);
    Route::resource('projects', ProjectController::class);
});

// Welcome/Login redirect
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return view('auth.login');
});

// Dashboard route
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile management routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
