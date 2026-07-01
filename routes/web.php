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
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SeatAllocationController;

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

    Route::get(
        'students/import',
        [StudentController::class, 'importForm']
    )->name('students.import.form');

    Route::post(
        'students/import',
        [StudentController::class, 'import']
    )->name('students.import');

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

/*
|--------------------------------------------------------------------------
| Report Module
|--------------------------------------------------------------------------
*/

Route::prefix('reports')
    ->name('reports.')
    ->group(function () {

        Route::get('/', [ReportController::class, 'index'])
            ->name('index');

        Route::get('/summary', [ReportController::class, 'summary'])
            ->name('summary');

        Route::get('/students', [ReportController::class, 'students'])
            ->name('students');

        Route::get('/departments', [ReportController::class, 'departments'])
            ->name('departments');

        Route::get('/courses', [ReportController::class, 'courses'])
            ->name('courses');

        Route::get('/rooms', [ReportController::class, 'rooms'])
            ->name('rooms');

        Route::get('/invigilators', [ReportController::class, 'invigilators'])
            ->name('invigilators');

        Route::get('/exams', [ReportController::class, 'exams'])
            ->name('exams');

        /*
        |--------------------------------------------------------------------------
        | PDF Export
        |--------------------------------------------------------------------------
        */

        Route::get('/summary/pdf',
            [ReportController::class, 'summaryPdf'])
            ->name('summary.pdf');

        Route::get('/students/pdf',
            [ReportController::class, 'studentsPdf'])
            ->name('students.pdf');

        Route::get('/departments/pdf',
            [ReportController::class, 'departmentsPdf'])
            ->name('departments.pdf');

        Route::get('/courses/pdf',
            [ReportController::class, 'coursesPdf'])
            ->name('courses.pdf');

        Route::get('/rooms/pdf',
            [ReportController::class, 'roomsPdf'])
            ->name('rooms.pdf');

        Route::get('/invigilators/pdf',
            [ReportController::class, 'invigilatorsPdf'])
            ->name('invigilators.pdf');

        Route::get('/exams/pdf',
            [ReportController::class, 'examsPdf'])
            ->name('exams.pdf');

    });

});

/*
|--------------------------------------------------------------------------
| Seat Allocation Management
|--------------------------------------------------------------------------
*/

Route::resource(
    'seat-allocations',
    SeatAllocationController::class
);

require __DIR__.'/auth.php';