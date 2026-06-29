<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DepartmentController;

// Redirect the home page to the login page
Route::redirect('/', '/login');

// Dashboard (accessible only after login)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Protected Routes
Route::middleware(['auth'])->group(function () {

    // ==========================
    // Profile
    // ==========================
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ==========================
    // Department Management
    // ==========================
    Route::resource('departments', DepartmentController::class);

});

require __DIR__.'/auth.php';