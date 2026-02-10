<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'role:super_admin'])->prefix('super-admin')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'superAdmin'])->name('super_admin.dashboard');

    // Payment Export (Super Admin also)
    Route::get('/payments/export', [App\Http\Controllers\DashboardController::class, 'exportPayments'])->name('payments.export');

    // ... existing super admin routes
    // User Management
    Route::resource('users', App\Http\Controllers\UserController::class);
    Route::post('users/{user}/toggle-status', [App\Http\Controllers\UserController::class, 'toggleStatus'])->name('users.toggle-status');

    // Role Management
    Route::resource('roles', App\Http\Controllers\RoleController::class);
    Route::get('roles/{role}/permissions', [App\Http\Controllers\RoleController::class, 'permissions'])->name('roles.permissions');
    Route::put('roles/{role}/permissions', [App\Http\Controllers\RoleController::class, 'updatePermissions'])->name('roles.permissions.update');

    // Permission Management
    Route::resource('permissions', App\Http\Controllers\PermissionController::class);

    // System Settings
    Route::get('/settings', [App\Http\Controllers\SuperAdmin\SettingsController::class, 'index'])->name('super_admin.settings.index');
    Route::post('/settings', [App\Http\Controllers\SuperAdmin\SettingsController::class, 'store'])->name('super_admin.settings.store');
    Route::post('/settings/test-email', [App\Http\Controllers\SuperAdmin\SettingsController::class, 'sendTestEmail'])->name('super_admin.settings.test-email');
});

// Admin Dashboard
Route::middleware(['auth', 'role:admin,super_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'admin'])->name('dashboard');
    
    // Candidate Management
    Route::resource('candidates', App\Http\Controllers\Admin\CandidateController::class);
    
    // Subscription Plan Management
    Route::resource('subscription-plans', App\Http\Controllers\Admin\SubscriptionPlanController::class);

    // Job Management
    Route::resource('jobs', App\Http\Controllers\JobPostController::class);
    Route::get('jobs/{job}/applications', [App\Http\Controllers\Admin\JobApplicationController::class, 'index'])->name('jobs.applications.index');
    Route::put('applications/{application}', [App\Http\Controllers\Admin\JobApplicationController::class, 'update'])->name('jobs.applications.update');

    // Payment Export (Admin)
    Route::get('/payments/export', [App\Http\Controllers\DashboardController::class, 'exportPayments'])->name('payments.export');

    // Master Data Management
    Route::get('/master-data', [App\Http\Controllers\Admin\MasterDataController::class, 'index'])->name('master_data.index');
    Route::post('/master-data/skills', [App\Http\Controllers\Admin\MasterDataController::class, 'storeSkill'])->name('master_data.skills.store');
    Route::delete('/master-data/skills/{skill}', [App\Http\Controllers\Admin\MasterDataController::class, 'destroySkill'])->name('master_data.skills.destroy');
    Route::post('/master-data/education', [App\Http\Controllers\Admin\MasterDataController::class, 'storeEducation'])->name('master_data.education.store');
    Route::delete('/master-data/education/{course}', [App\Http\Controllers\Admin\MasterDataController::class, 'destroyEducation'])->name('master_data.education.destroy');
});

// Public Job Routes
Route::get('/jobs', [App\Http\Controllers\PublicJobController::class, 'index'])->name('public.jobs.index');
Route::get('/jobs/{job}', [App\Http\Controllers\PublicJobController::class, 'show'])->name('public.jobs.show');
Route::post('/jobs/{job}/apply', [App\Http\Controllers\JobApplicationController::class, 'store'])->name('jobs.apply')->middleware(['auth', 'role:candidate', 'subscribed']);

// Candidate Routes
Route::middleware(['auth', 'role:candidate'])->prefix('candidate')->name('candidate.')->group(function () {
    
    // Public to Candidate (Subscriptions)
    Route::get('/subscriptions', [App\Http\Controllers\SubscriptionController::class, 'index'])->name('subscriptions.index');
    Route::post('/subscriptions/{plan}/initiate', [App\Http\Controllers\SubscriptionController::class, 'initiate'])->name('subscriptions.initiate');

    // Protected by Subscription (Profile & Applications)
    Route::middleware(['subscribed'])->group(function () {
        Route::get('/profile', [App\Http\Controllers\CandidateProfileController::class, 'show'])->name('profile.index');
        Route::post('/profile/personal', [App\Http\Controllers\CandidateProfileController::class, 'updatePersonal'])->name('profile.updatePersonal');
        Route::post('/profile/education', [App\Http\Controllers\CandidateProfileController::class, 'updateEducation'])->name('profile.updateEducation');
        Route::post('/profile/experience', [App\Http\Controllers\CandidateProfileController::class, 'updateExperience'])->name('profile.updateExperience');
        Route::post('/profile/skills', [App\Http\Controllers\CandidateProfileController::class, 'updateSkills'])->name('profile.updateSkills');
        Route::post('/profile/resume', [App\Http\Controllers\CandidateProfileController::class, 'uploadResume'])->name('profile.uploadResume');
        
        // Applications
        Route::get('/applications', [App\Http\Controllers\JobApplicationController::class, 'candidateIndex'])->name('applications.index');
        Route::delete('/applications/{application}', [App\Http\Controllers\JobApplicationController::class, 'destroy'])->name('applications.destroy');
    });
});

// PayU Response (POST from Gateway)
Route::post('/payment/response', [App\Http\Controllers\PaymentController::class, 'response'])->name('payment.response'); // Allow CSRF exemption or middleware

// Redirect /profile to /candidate/profile
Route::get('/profile', function() {
    return redirect()->route('candidate.profile.index');
})->middleware(['auth', 'role:candidate']);

// HR Dashboard
Route::middleware(['auth', 'role:hr,super_admin'])->prefix('hr')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'hr'])->name('hr.dashboard');
    Route::get('/applications', [App\Http\Controllers\Admin\JobApplicationController::class, 'indexAll'])->name('hr.applications.index');
    Route::put('/applications/{application}', [App\Http\Controllers\Admin\JobApplicationController::class, 'update'])->name('hr.applications.update');
    Route::get('/applications/{application}/resume/download', [App\Http\Controllers\Admin\JobApplicationController::class, 'downloadResume'])->name('hr.applications.resume.download');
    Route::get('/applications/{application}/resume/view', [App\Http\Controllers\Admin\JobApplicationController::class, 'viewResume'])->name('hr.applications.resume.view');
});

// Accountant Dashboard
Route::middleware(['auth', 'role:accountant,super_admin'])->prefix('accountant')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'accountant'])->name('accountant.dashboard');
    
    // Payment Export
    Route::get('/payments/export', [App\Http\Controllers\DashboardController::class, 'exportPayments'])->name('accountant.payments.export');
});
