<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\InvigilatorController;
use App\Http\Controllers\ExamController;

/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

// Redirect the home page to the login page
Route::redirect('/', '/login');

/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| Protected Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Profile Management
    |--------------------------------------------------------------------------
    */
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

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
    | AJAX Course Filter (Department -> Courses)
    |--------------------------------------------------------------------------
    */
    Route::get(
        '/departments/{department}/courses',
        [CourseController::class, 'getCoursesByDepartment']
    )->name('departments.courses');

    /*
    |--------------------------------------------------------------------------
    | Student Management
    |--------------------------------------------------------------------------
    */
    Route::resource('students', StudentController::class);

    /*
    |--------------------------------------------------------------------------
    | Room Management
    |--------------------------------------------------------------------------
    */
    Route::resource('rooms', RoomController::class);

    /*
    |--------------------------------------------------------------------------
    | Invigilator Management
    |--------------------------------------------------------------------------
    */
    Route::resource('invigilators', InvigilatorController::class);

    /*
|--------------------------------------------------------------------------
| Exam Management
|--------------------------------------------------------------------------
*/

Route::resource('exams', ExamController::class);

});

require __DIR__.'/auth.php';