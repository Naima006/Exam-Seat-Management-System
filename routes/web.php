<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\RoomController;

// Redirect the home page to the login page
Route::redirect('/', '/login');

// Dashboard (accessible only after login)
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Protected Routes
Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Profile Management
    |--------------------------------------------------------------------------
    */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /*
    |--------------------------------------------------------------------------
    | Department Management
    |--------------------------------------------------------------------------
    */
    Route::resource('departments', DepartmentController::class);

    /*
    |--------------------------------------------------------------------------
    | Course Management
    |--------------------------------------------------------------------------
    */
    Route::resource('courses', CourseController::class);

    /*
    |--------------------------------------------------------------------------
    | Room Management
    |--------------------------------------------------------------------------
    */
    Route::resource('rooms', RoomController::class);

});

require __DIR__.'/auth.php';