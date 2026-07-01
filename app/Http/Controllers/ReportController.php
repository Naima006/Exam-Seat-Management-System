<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Course;
use App\Models\Department;
use App\Models\Exam;
use App\Models\Invigilator;
use App\Models\Room;
use App\Models\Student;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    public function index()
{
    return view('reports.index', [

        'students' => \App\Models\Student::count(),

        'departments' => \App\Models\Department::count(),

        'courses' => \App\Models\Course::count(),

        'rooms' => \App\Models\Room::count(),

        'invigilators' => \App\Models\Invigilator::count(),

        'exams' => \App\Models\Exam::count(),

    ]);
}
    /*
    |--------------------------------------------------------------------------
    | Summary
    |--------------------------------------------------------------------------
    */

    public function summary()
{
    return view('reports.summary', [

        'students'      => Student::count(),

        'departments'   => Department::count(),

        'courses'       => Course::count(),

        'rooms'         => Room::count(),

        'invigilators'  => Invigilator::count(),

        'exams'         => Exam::count(),

        'roomCapacity'  => Room::sum('capacity'),

        'activeRooms'   => Room::where('status','Active')->count(),

        'inactiveRooms' => Room::where('status','Inactive')->count(),

    ]);
}

    /*
    |--------------------------------------------------------------------------
    | Student Report
    |--------------------------------------------------------------------------
    */

   public function students(Request $request)
{
    $students = Student::with(['department','course'])

        ->when($request->search, function ($query) use ($request) {

            $query->where('student_name', 'like', "%{$request->search}%")
                  ->orWhere('student_id', 'like', "%{$request->search}%");

        })

        ->orderBy('student_name')
        ->paginate(10);

    return view('reports.students', compact('students'));
}

    /*
    |--------------------------------------------------------------------------
    | Department Report
    |--------------------------------------------------------------------------
    */

    public function departments(Request $request)
{
    $departments = Department::withCount([
            'courses',
            'students'
        ])
        ->when($request->search, function ($query) use ($request) {

            $query->where('department_name', 'like', '%' . $request->search . '%')
                  ->orWhere('department_code', 'like', '%' . $request->search . '%');

        })
        ->orderBy('department_name')
        ->paginate(10);

    return view('reports.departments', compact('departments'));
}

    /*
    |--------------------------------------------------------------------------
    | Course Report
    |--------------------------------------------------------------------------
    */

    public function courses(Request $request)
{
    $courses = Course::with('department')

        ->when($request->search, function ($query) use ($request) {

            $query->where('course_name', 'like', '%' . $request->search . '%')
                  ->orWhere('course_code', 'like', '%' . $request->search . '%');

        })

        ->orderBy('course_code')

        ->paginate(10);

    return view('reports.courses', compact('courses'));
}

    /*
    |--------------------------------------------------------------------------
    | Room Report
    |--------------------------------------------------------------------------
    */

   public function rooms(Request $request)
{
    $rooms = Room::when($request->search, function ($query) use ($request) {

            $query->where('room_no', 'like', "%{$request->search}%")
                  ->orWhere('building', 'like', "%{$request->search}%");

        })

        ->orderBy('building')
        ->orderBy('room_no')
        ->paginate(10);

    return view('reports.rooms', compact('rooms'));
}

    /*
    |--------------------------------------------------------------------------
    | Invigilator Report
    |--------------------------------------------------------------------------
    */

    public function invigilators(Request $request)
{
    $invigilators = Invigilator::with('department')

        ->when($request->search, function ($query) use ($request) {

            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%')
                  ->orWhere('phone', 'like', '%' . $request->search . '%');

        })

        ->orderBy('name')

        ->paginate(10);

    return view('reports.invigilators', compact('invigilators'));
}

    /*
    |--------------------------------------------------------------------------
    | Exam Report
    |--------------------------------------------------------------------------
    */

public function exams(Request $request)
{
    $search = $request->search;

    $exams = Exam::with('course')
    ->latest()
    ->paginate(10);

    return view('reports.exams', compact('exams'));
}

    /*
    |--------------------------------------------------------------------------
    | PDF Export
    |--------------------------------------------------------------------------
    */

    public function summaryPdf()
{
    $data = [

        'students'      => Student::count(),

        'departments'   => Department::count(),

        'courses'       => Course::count(),

        'rooms'         => Room::count(),

        'invigilators'  => Invigilator::count(),

        'exams'         => Exam::count(),

        'roomCapacity'  => Room::sum('capacity'),

        'activeRooms'   => Room::where('status','Active')->count(),

        'inactiveRooms' => Room::where('status','Inactive')->count(),

    ];

    $pdf = Pdf::loadView('reports.pdf.summary',$data)
            ->setPaper('a4','portrait');

    return $pdf->download('System_Summary_Report.pdf');
}

   public function studentsPdf()
{
    $students = Student::with('department')->get();

    $pdf = Pdf::loadView('reports.pdf.students', compact('students'))
                ->setPaper('a4', 'portrait');

    return $pdf->download('Student_Report.pdf');
}

    public function departmentsPdf()
{
    $departments = Department::withCount('students')
                                ->orderBy('department_name')
                                ->get();

    $pdf = Pdf::loadView(
        'reports.pdf.departments',
        compact('departments')
    )->setPaper('a4', 'portrait');

    return $pdf->download('Department_Report.pdf');
}

    public function coursesPdf()
{
    $courses = Course::with('department')
                        ->orderBy('course_code')
                        ->get();

    $pdf = Pdf::loadView(
        'reports.pdf.courses',
        compact('courses')
    )->setPaper('a4', 'portrait');

    return $pdf->download('Course_Report.pdf');
}

    public function roomsPdf()
{
   $rooms = Room::orderBy('building')
             ->orderBy('room_no')
             ->get();

    $pdf = Pdf::loadView(
        'reports.pdf.rooms',
        compact('rooms')
    )->setPaper('a4', 'portrait');

    return $pdf->download('Room_Report.pdf');
}

    public function invigilatorsPdf()
{
    $invigilators = Invigilator::with('department')
                                ->orderBy('name')
                                ->get();

    $pdf = Pdf::loadView(
        'reports.pdf.invigilators',
        compact('invigilators')
    )->setPaper('a4', 'portrait');

    return $pdf->download('Invigilator_Report.pdf');
}

   public function examsPdf()
{
    $exams = Exam::with('course')
                 ->orderBy('exam_date')
                 ->orderBy('start_time')
                 ->get();

    $pdf = Pdf::loadView(
        'reports.pdf.exams',
        compact('exams')
    )->setPaper('a4','landscape');

    return $pdf->download('Exam_Report.pdf');
}
}