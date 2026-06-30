<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Department;
use App\Models\Room;

class DashboardController extends Controller
{
    public function index()
    {
        $totalDepartments = Department::count();

        $totalCourses = Course::count();

        $totalRooms = Room::count();

        $totalCapacity = Room::sum('capacity');

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