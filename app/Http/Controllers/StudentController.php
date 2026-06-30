<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Course;
use App\Models\Department;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of students.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $students = Student::with(['department', 'course'])

            ->when($search, function ($query) use ($search) {

                $query->where(function ($q) use ($search) {

                    $q->where('student_name', 'LIKE', "%{$search}%")
                    ->orWhere('student_id', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%");

                })

                ->orWhereHas('department', function ($q) use ($search) {

                    $q->where('department_name', 'LIKE', "%{$search}%");

                })

                ->orWhereHas('course', function ($q) use ($search) {

                    $q->where('course_name', 'LIKE', "%{$search}%");

                });

            })

            ->latest()

            ->paginate(10)

            ->withQueryString();

        $statistics = [

            'totalStudents' => Student::count(),

            'activeStudents' => Student::where('status', 'Active')->count(),

            'inactiveStudents' => Student::where('status', 'Inactive')->count(),

            'latestStudent' => Student::latest()->first(),

        ];

        return view(
            'students.index',
            array_merge(
                compact('students'),
                $statistics
            )
        );
    }

    /**
     * Show the form for creating a new student.
     */
    public function create()
    {
        $departments = Department::orderBy('department_name')->get();

        $courses = Course::orderBy('course_name')->get();

        return view(
            'students.create',
            compact(
                'departments',
                'courses'
            )
        );
    }

    /**
     * Store a newly created student.
     */
    public function store(StoreStudentRequest $request)
    {
        Student::create($request->validated());

        return redirect()
            ->route('students.index')
            ->with('success', 'Student has been added successfully.');
    }
    /**
     * Display the specified student.
     */
    public function show(Student $student)
    {
        $student->load(['department', 'course']);

        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified student.
     */
    public function edit(Student $student)
    {
        $departments = Department::orderBy('department_name')->get();

        $courses = Course::orderBy('course_name')->get();

        return view(
            'students.edit',
            compact(
                'student',
                'departments',
                'courses'
            )
        );
    }

    /**
     * Update the specified student.
     */
    public function update(
        UpdateStudentRequest $request,
        Student $student
    )
    {
        $student->update($request->validated());

        return redirect()
            ->route('students.index')
            ->with('success', 'Student updated successfully.');
    }

    /**
     * Remove the specified student.
     */
    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()
            ->route('students.index')
            ->with('success', 'Student deleted successfully.');
    }
}