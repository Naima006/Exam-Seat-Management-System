<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Department;
use App\Models\Exam;
use App\Models\Room;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | General Statistics
        |--------------------------------------------------------------------------
        */

        $totalDepartments = Department::count();

        $totalCourses = Course::count();

        // Active rooms only
        $totalRooms = Room::where('status', 'Active')->count();

        // Active room capacity only
        $totalCapacity = Room::where('status', 'Active')->sum('capacity');

        /*
        |--------------------------------------------------------------------------
        | Latest Records
        |--------------------------------------------------------------------------
        */

        $latestDepartment = Department::latest()->first();

        $latestCourse = Course::latest()->first();

        $latestRoom = Room::latest()->first();

        /*
        |--------------------------------------------------------------------------
        | Upcoming Exams
        |--------------------------------------------------------------------------
        */

        $upcomingExams = Exam::with('course')

            ->whereDate('exam_date', '>=', Carbon::today())

            ->orderBy('exam_date')

            ->orderBy('start_time')

            ->take(5)

            ->get();

        return view('dashboard', compact(

            'totalDepartments',
            'totalCourses',
            'totalRooms',
            'totalCapacity',

            'latestDepartment',
            'latestCourse',
            'latestRoom',

            'upcomingExams'

        ));
    }
}