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

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
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
