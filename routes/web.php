<?php

use App\Models\Job;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\AlumniprofileController;


Route::get('activate-account/{token}', [UserController::class, 'activateAccount'])->name('activate-account');
Route::post('activate-account/{token}', [UserController::class, 'setPassword'])->name('set-password');

Route::group(['middleware' => ['role:super-admin|admin']], function() {

    Route::resource('permissions', App\Http\Controllers\PermissionController::class);
    Route::get('permissions/{permissionId}/delete', [App\Http\Controllers\PermissionController::class, 'destroy']);

    Route::resource('roles', App\Http\Controllers\RoleController::class);
    Route::get('roles/{roleId}/delete', [App\Http\Controllers\RoleController::class, 'destroy']);
    Route::get('roles/{roleId}/give-permissions', [App\Http\Controllers\RoleController::class, 'addPermissionToRole']);
    Route::put('roles/{roleId}/give-permissions', [App\Http\Controllers\RoleController::class, 'givePermissionToRole']);

    Route::resource('users', App\Http\Controllers\UserController::class);
    Route::get('users/{userId}/delete', [App\Http\Controllers\UserController::class, 'destroy']);
   


});
Route::get('jobs/apply/{job}', [JobController::class, 'apply'])->name('jobs.apply');
Route::post('jobs/apply/{job}', [JobController::class, 'applyStore'])->name('jobs.applyStore');
Route::resource('jobs', JobController::class);
Route::get('jobs/{id}', [JobController::class, 'show'])->name('jobs.show');
Route::get('/applications', [JobController::class, 'applications'])->name('jobs.applications');
Route::get('applications/{applicationId}/review', [JobController::class, 'review'])->name('application.review');
    Route::get('applications/{applicationId}/approve', [JobController::class, 'approve'])->name('application.approve');
    Route::get('applications/{applicationId}/deny', [JobController::class, 'deny'])->name('application.deny');
Route::get('/view_jobs', function () {

    $jobs = Job::all();
    return view('jobs.index',  compact('jobs'));

});

Route::resource('profiles', AlumniprofileController::class);
Route::resource('projects', ProjectController::class);



Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
