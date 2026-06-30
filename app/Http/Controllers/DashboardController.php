<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Department;
use App\Models\Room;

class DashboardController extends Controller
{
    public function index()
    {
        // General Statistics
        $totalDepartments = Department::count();

        $totalCourses = Course::count();

        // Only Active Rooms
        $totalRooms = Room::where('status', 'Active')->count();

        // Sum capacity of Active Rooms only
        $totalCapacity = Room::where('status', 'Active')->sum('capacity');

        // Latest Records
        $latestDepartment = Department::latest()->first();

        $latestCourse = Course::latest()->first();

        $latestRoom = Room::latest()->first();

        return view('dashboard', compact(
            'totalDepartments',
            'totalCourses',
            'totalRooms',
            'totalCapacity',
            'latestDepartment',
            'latestCourse',
            'latestRoom'
        ));
    }
}