<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Admin\AdminManagement\RoleController;
use App\Http\Controllers\Backend\Admin\AdminManagement\AdminController;
use App\Http\Controllers\Backend\Admin\AdminManagement\PermissionController;
use App\Http\Controllers\Backend\Admin\DashboardController as AdminDashboardController;



Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function () {
  Route::get('/dashboard', [AdminDashboardController::class, 'dashboard'])->name('admin.dashboard');

  // Admin & Role - Permission Management
  Route::group(['prefix' => 'admin-management', 'as' => 'am.'], function () {

    // Admins Management 
    Route::resource('admin', AdminController::class);
    Route::group(['as' => 'admin.', 'prefix' => 'admin-restore'], function () {
      Route::get('/trash', [AdminController::class, 'trash'])->name('trash');
      Route::get('/restore/{id}', [AdminController::class, 'restore'])->name('restore');
      Route::get('/force-delete/{id}', [AdminController::class, 'forceDelete'])->name('force-delete');
      Route::get('/status/{id}/{status}', [AdminController::class, 'status'])->name('status');
    });

    // Role Management
    Route::resource('role', RoleController::class);
    Route::group(['as' => 'role.', 'prefix' => 'role-restore'], function () {
      Route::get('/trash', [RoleController::class, 'trash'])->name('trash');
      Route::get('/restore/{id}', [RoleController::class, 'restore'])->name('restore');
      Route::get('/force-delete/{id}', [RoleController::class, 'forceDelete'])->name('force-delete');
    });

    // Permission Management
    Route::resource('permission', PermissionController::class);
    Route::group(['as' => 'permission.', 'prefix' => 'permission-restore'], function () {
      Route::get('/trash', [PermissionController::class, 'trash'])->name('trash');
      Route::get('/restore/{id}', [PermissionController::class, 'restore'])->name('restore');
      Route::get('/force-delete/{id}', [PermissionController::class, 'forceDelete'])->name('force-delete');
    });
  });
});
