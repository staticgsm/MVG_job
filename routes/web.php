<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'role:super_admin'])->prefix('super-admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('super_admin.dashboard');
    })->name('super_admin.dashboard');

    // User Management
    Route::resource('users', App\Http\Controllers\UserController::class);
    Route::post('users/{user}/toggle-status', [App\Http\Controllers\UserController::class, 'toggleStatus'])->name('users.toggle-status');

    // Role Management
    Route::resource('roles', App\Http\Controllers\RoleController::class);
    Route::get('roles/{role}/permissions', [App\Http\Controllers\RoleController::class, 'permissions'])->name('roles.permissions');
    Route::put('roles/{role}/permissions', [App\Http\Controllers\RoleController::class, 'updatePermissions'])->name('roles.permissions.update');

    // Permission Management
    Route::resource('permissions', App\Http\Controllers\PermissionController::class);
});

// Job Management (Admin)
Route::middleware(['auth', 'permission:job.view'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('jobs', App\Http\Controllers\JobPostController::class);
});

// Public Job Routes
Route::get('/jobs', [App\Http\Controllers\PublicJobController::class, 'index'])->name('public.jobs.index');
Route::get('/jobs/{job}', [App\Http\Controllers\PublicJobController::class, 'show'])->name('public.jobs.show');

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

// Candidate Profile Routes
Route::middleware(['auth', 'role:candidate'])->prefix('candidate')->name('candidate.')->group(function () {
    Route::get('/profile', [App\Http\Controllers\CandidateProfileController::class, 'show'])->name('profile.index');
    Route::post('/profile/personal', [App\Http\Controllers\CandidateProfileController::class, 'updatePersonal'])->name('profile.updatePersonal');
    Route::post('/profile/education', [App\Http\Controllers\CandidateProfileController::class, 'updateEducation'])->name('profile.updateEducation');
    Route::post('/profile/experience', [App\Http\Controllers\CandidateProfileController::class, 'updateExperience'])->name('profile.updateExperience');
    Route::post('/profile/skills', [App\Http\Controllers\CandidateProfileController::class, 'updateSkills'])->name('profile.updateSkills');
    Route::post('/profile/resume', [App\Http\Controllers\CandidateProfileController::class, 'uploadResume'])->name('profile.uploadResume');
});

Route::middleware(['auth', 'role:hr'])->prefix('hr')->group(function () {
    Route::get('/dashboard', function () {
        return view('hr.dashboard');
    })->name('hr.dashboard');
});

Route::middleware(['auth', 'role:accountant'])->prefix('accountant')->group(function () {
    Route::get('/dashboard', function () {
        return view('accountant.dashboard');
    })->name('accountant.dashboard');
});
