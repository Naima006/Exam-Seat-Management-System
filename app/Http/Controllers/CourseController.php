<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\Course;
use App\Models\Department;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of courses.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $courses = Course::with('department')

            ->when($search, function ($query) use ($search) {

                $query->where(function ($q) use ($search) {

                    $q->where('course_name', 'LIKE', "%{$search}%")
                      ->orWhere('course_code', 'LIKE', "%{$search}%")
                      ->orWhereHas('department', function ($department) use ($search) {

                          $department->where('department_name', 'LIKE', "%{$search}%");

                      });

                });

            })

            ->latest()

            ->paginate(10)

            ->withQueryString();

        // Statistics
        $statistics = [

            'totalCourses' => Course::count(),

            'totalDepartments' => Department::count(),

            'latestCourse' => Course::latest()->first(),

        ];

        return view('courses.index', array_merge(
            compact('courses'),
            $statistics
        ));
    }

    /**
     * Show create form.
     */
    public function create()
    {
        $departments = Department::orderBy('department_name')->get();

        return view('courses.create', compact('departments'));
    }

    /**
     * Store new course.
     */
    public function store(StoreCourseRequest $request)
    {
        Course::create($request->validated());

        return redirect()

            ->route('courses.index')

            ->with('success', 'Course has been added successfully.');
    }

    /**
     * Display course details.
     */
    public function show(Course $course)
    {
        $course->load('department');

        return view('courses.show', compact('course'));
    }

    /**
     * Show edit form.
     */
    public function edit(Course $course)
    {
        $departments = Department::orderBy('department_name')->get();

        return view('courses.edit', compact(
            'course',
            'departments'
        ));
    }

    /**
     * Update course.
     */
    public function update(UpdateCourseRequest $request, Course $course)
    {
        $course->update($request->validated());

        return redirect()

            ->route('courses.index')

            ->with('success', 'Course updated successfully.');
    }

    /**
     * Delete course.
     */
    public function destroy(Course $course)
    {
        $course->delete();

        return redirect()

            ->route('courses.index')

            ->with('success', 'Course deleted successfully.');
    }
}