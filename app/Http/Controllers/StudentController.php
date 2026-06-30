<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Http\Requests\ImportStudentRequest;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Course;
use App\Models\Department;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display students.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $students = Student::with(['department', 'course'])

            ->when($search, function ($query) use ($search) {

                $query->where(function ($q) use ($search) {

                    $q->where('student_name', 'LIKE', "%{$search}%")
                      ->orWhere('student_id', 'LIKE', "%{$search}%");

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

        if ($request->ajax()) {

            return view('students.partials.table', compact('students'))->render();

        }

        return view('students.index', [

            'students' => $students,

            'totalStudents' => Student::count(),

            'latestStudent' => Student::latest()->first(),

        ]);
    }

    /**
     * Show create form.
     */
    public function create()
    {
        return view('students.create', [

            'departments' => Department::orderBy('department_name')->get(),

            'courses' => Course::orderBy('course_name')->get(),

        ]);
    }

    /**
     * Store student.
     */
    public function store(StoreStudentRequest $request)
    {
        Student::create($request->validated());

        return redirect()

            ->route('students.index')

            ->with('success', 'Student has been added successfully.');
    }

    /**
     * Import CSV page.
     */
    public function importForm()
    {
        return view('students.import');
    }

    /**
     * Import CSV.
     */
    public function import(ImportStudentRequest $request)
    {
        $file = fopen($request->file('csv_file')->getRealPath(), 'r');

        // Skip heading row
        fgetcsv($file);

        $count = 0;

        while (($row = fgetcsv($file)) !== false) {

            if (count($row) < 5) {
                continue;
            }

            [
                $studentId,
                $studentName,
                $departmentName,
                $courseName,
                $batch
            ] = $row;

            $department = Department::where(
                'department_name',
                trim($departmentName)
            )->first();

            if (!$department) {
                continue;
            }

            $course = Course::where('department_id', $department->id)
                ->where('course_name', trim($courseName))
                ->first();

            if (!$course) {
                continue;
            }

            Student::updateOrCreate(

                [
                    'student_id' => trim($studentId)
                ],

                [
                    'student_name' => trim($studentName),
                    'department_id' => $department->id,
                    'course_id' => $course->id,
                    'batch' => $batch
                ]

            );

            $count++;
        }

        fclose($file);

        return redirect()

            ->route('students.index')

            ->with(
                'success',
                "{$count} students imported successfully."
            );
    }

    /**
     * Show student.
     */
    public function show(Student $student)
    {
        $student->load(['department', 'course']);

        return view('students.show', compact('student'));
    }

    /**
     * Edit form.
     */
    public function edit(Student $student)
    {
        return view('students.edit', [

            'student' => $student,

            'departments' => Department::orderBy('department_name')->get(),

            'courses' => Course::orderBy('course_name')->get(),

        ]);
    }

    /**
     * Update student.
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        $student->update($request->validated());

        return redirect()

            ->route('students.index')

            ->with('success', 'Student updated successfully.');
    }

    /**
     * Delete student.
     */
    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()

            ->route('students.index')

            ->with('success', 'Student deleted successfully.');
    }
}