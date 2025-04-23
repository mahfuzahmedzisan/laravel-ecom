<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Admin\AdminManagement\Admin\AdminController;
use App\Http\Controllers\Backend\Admin\DashboardController as AdminDashboardController;



Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function () {
  Route::get('/dashboard', [AdminDashboardController::class, 'dashboard'])->name('admin.dashboard');

  // Admin Management
  Route::group(['prefix' => 'admin-management', 'as' => 'am.'], function () {
    Route::resource('admin', AdminController::class);
    Route::group(['as' => 'admin.'], function () {
      Route::get('/trash', [AdminController::class, 'trash'])->name('trash');
      Route::get('/restore/{id}', [AdminController::class, 'restore'])->name('restore');
      Route::get('/force-delete/{id}', [AdminController::class, 'forceDelete'])->name('force-delete');
      Route::get('/status/{id}/{status}', [AdminController::class, 'status'])->name('status');
    });
  });
});
