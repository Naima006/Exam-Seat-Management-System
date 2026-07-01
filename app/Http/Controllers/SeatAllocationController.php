<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\SeatAllocation;
use App\Models\Student;
use App\Models\Exam;
use App\Models\Room;
use App\Models\Invigilator;
use Illuminate\Http\Request;

class SeatAllocationController extends Controller
{
    /**
     * Display all allocations.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $allocations = SeatAllocation::with([
                'student.department',
                'student.course',
                'exam.course',
                'room',
                'invigilator'
            ])
            ->when($search, function ($query) use ($search) {

                $query->whereHas('student', function ($q) use ($search) {

                    $q->where('student_id', 'like', "%{$search}%")
                    ->orWhere('student_name', 'like', "%{$search}%");

                });

            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | Dashboard Statistics (Entire Database)
        |--------------------------------------------------------------------------
        */

        $totalAllocations = SeatAllocation::count();

        $totalRooms = SeatAllocation::distinct('room_id')
            ->count('room_id');

        $totalInvigilators = SeatAllocation::distinct('invigilator_id')
            ->count('invigilator_id');

        return view(
            'seat_allocations.index',
            compact(
                'allocations',
                'search',
                'totalAllocations',
                'totalRooms',
                'totalInvigilators'
            )
        );
    }

    public function studentLookup(Request $request)
    {
        $search = $request->student_id;

        $allocation = null;

        if ($search) {

            $allocation = SeatAllocation::with([

                'student.department',
                'student.course',
                'exam.course',
                'room',
                'invigilator'

            ])

            ->whereHas('student', function ($query) use ($search) {

                $query->where('student_id', $search);

            })

            ->first();

        }

        return view(
            'seat_allocations.lookup',
            compact(
                'allocation',
                'search'
            )
        );
    }

    public function roomInvigilators()
    {
        $rooms = SeatAllocation::with([
                'exam.course',
                'room',
                'invigilator'
            ])
            ->select('exam_id','room_id','invigilator_id')
            ->distinct()
            ->get();

        return view(
            'seat_allocations.room_invigilators',
            compact('rooms')
        );
    }

    public function exportPdf(Request $request)
    {
        $examDate = $request->exam_date;
        $startTime = $request->start_time;

        if (!$examDate || !$startTime) {

            return redirect()
                ->route('seat-allocations.index')
                ->with(
                    'error',
                    'Please select an examination session first.'
                );
        }

        $allocations = SeatAllocation::with([
            'student.department',
            'student.course',
            'exam.course',
            'room',
            'invigilator'
        ])
        ->whereHas('exam', function ($query) use ($examDate, $startTime) {

            $query->whereDate('exam_date', $examDate)
                ->where('start_time', $startTime);

        })
        ->orderBy('room_id')
        ->orderBy('seat_number')
        ->get();

        if ($allocations->isEmpty()) {

            return back()->with(
                'error',
                'No seating plan exists for this session.'
            );

        }

        $rooms = $allocations->groupBy('room.room_no');

        $pdf = Pdf::loadView(
            'seat_allocations.pdf',
            [
                'rooms' => $rooms,
                'examDate' => $examDate,
                'startTime' => $startTime,
                'generatedAt' => now(),
                'totalStudents' => $allocations->count(),
                'totalRooms' => $allocations->pluck('room_id')->unique()->count(),
                'totalInvigilators' => $allocations->pluck('invigilator_id')->unique()->count(),
                'totalCourses' => $allocations->pluck('exam.course.course_name')->unique()->count(),
            ]
        );

        $pdf->setPaper('A4', 'landscape');

        return $pdf->download(
            'SeatingPlan_' .
            $examDate .
            '_' .
            str_replace(':','-',$startTime) .
            '.pdf'
        );
    }

    /**
     * Show allocation page.
     */
    public function create()
    {
        /*
        |--------------------------------------------------------------------------
        | Available Exam Sessions
        |--------------------------------------------------------------------------
        */

        $examDates = Exam::orderBy('exam_date')
            ->distinct()
            ->pluck('exam_date');

        $examTimes = Exam::orderBy('start_time')
            ->distinct()
            ->pluck('start_time');

        /*
        |--------------------------------------------------------------------------
        | Rooms
        |--------------------------------------------------------------------------
        */

        $rooms = Room::orderBy('building')
            ->orderBy('room_no')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Invigilators
        |--------------------------------------------------------------------------
        */

        $invigilators = Invigilator::with('department')
            ->orderBy('name')
            ->get();

        return view(
            'seat_allocations.create',
            compact(
                'examDates',
                'examTimes',
                'rooms',
                'invigilators'
            )
        );
    }

    /**
     * Generate seating.
     */
    public function store(Request $request)
    {
        $request->validate([
            'exam_date' => 'required|date',
            'start_time' => 'required',
            'rooms' => 'required|array|min:1',
            'rooms.*' => 'exists:rooms,id',
            'invigilators' => 'required|array',
            'bench_capacity' => 'required|in:2,3',
        ]);

        /*
        |--------------------------------------------------------------------------
        | All Exams Running in This Session
        |--------------------------------------------------------------------------
        */

        $exams = Exam::with('course')
            ->whereDate('exam_date', $request->exam_date)
            ->where('start_time', $request->start_time)
            ->get();

        if ($exams->isEmpty()) {

            return back()->with(
                'error',
                'No examinations found for the selected session.'
            );

        }

        /*
        |--------------------------------------------------------------------------
        | Remove Previous Allocations For This Session
        |--------------------------------------------------------------------------
        */

        SeatAllocation::whereIn(
            'exam_id',
            $exams->pluck('id')
        )->delete();

        /*
        |--------------------------------------------------------------------------
        | Build Course Queues
        |--------------------------------------------------------------------------
        */

        $courseQueues = collect();

        foreach ($exams as $exam) {

            $students = Student::with('department')
                ->where('course_id', $exam->course_id)
                ->get()
                ->shuffle()
                ->values();

            $courseQueues->push([
                'exam' => $exam,
                'students' => $students,
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Interleave Students
        |--------------------------------------------------------------------------
        */

        $mixedStudents = collect();

        while ($courseQueues->filter(fn($q) => $q['students']->count())->count()) {

            foreach ($courseQueues as $index => $queue) {

                if ($queue['students']->isEmpty()) {
                    continue;
                }

                $student = $queue['students']->shift();

                $mixedStudents->push([
                    'student' => $student,
                    'exam' => $queue['exam'],
                ]);

                $courseQueues[$index] = $queue;
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Selected Rooms
        |--------------------------------------------------------------------------
        */

        $rooms = Room::whereIn('id', $request->rooms)
            ->orderBy('room_no')
            ->get();

        if ($rooms->isEmpty()) {

            return back()->with(
                'error',
                'Please select at least one room.'
            );

        }

        /*
        |--------------------------------------------------------------------------
        | Capacity Check
        |--------------------------------------------------------------------------
        */

        $capacity = $rooms->sum('capacity');

        if ($capacity < $mixedStudents->count()) {

            return back()->with(
                'error',
                'Selected rooms do not have enough capacity.'
            );

        }

        /*
        |--------------------------------------------------------------------------
        | Validate Invigilators
        |--------------------------------------------------------------------------
        */

        foreach ($rooms as $room) {

            $invigilatorId = $request->invigilators[$room->id] ?? null;

            if (!$invigilatorId) {

                return back()->with(
                    'error',
                    'Please assign an invigilator for Room '.$room->room_no
                );

            }

            $busy = SeatAllocation::where('invigilator_id', $invigilatorId)
                ->whereHas('exam', function($query) use ($request){

                    $query->whereDate('exam_date', $request->exam_date)
                        ->where('start_time', $request->start_time);

                })
                ->exists();

            if ($busy) {

                return back()->with(
                    'error',
                    Invigilator::find($invigilatorId)->name .
                    ' is already supervising another exam at this time.'
                );

            }

        }
        $benchCapacity = (int)$request->bench_capacity;

        /*
        |--------------------------------------------------------------------------
        | Arrange Students Bench-wise (Department Separation)
        |--------------------------------------------------------------------------
        |
        | We reorder the already interleaved students so that
        | students sitting on the same bench belong to different
        | departments whenever possible.
        |
        */

        $remainingStudents = $mixedStudents->values();

        $finalStudents = collect();

        while ($remainingStudents->count() > 0) {

            $currentBench = collect();

            while (
                $currentBench->count() < $benchCapacity &&
                $remainingStudents->count() > 0
            ) {

                $selectedIndex = null;

                foreach ($remainingStudents as $index => $candidate) {

                    $canSit = true;

                    foreach ($currentBench as $benchStudent) {

                        if (
                            $benchStudent['student']->department_id ==
                            $candidate['student']->department_id
                        ) {
                            $canSit = false;
                            break;
                        }

                    }

                    if ($canSit) {

                        $selectedIndex = $index;
                        break;

                    }

                }

                // If no different department exists,
                // simply take the first remaining student.

                if ($selectedIndex === null) {

                    $selectedIndex = 0;

                }

                $currentBench->push(
                    $remainingStudents->splice($selectedIndex,1)->first()
                );

            }

            foreach ($currentBench as $student) {

                $finalStudents->push($student);

            }

        }

        /*
        |--------------------------------------------------------------------------
        | Room Variables
        |--------------------------------------------------------------------------
        */

        $roomIndex = 0;

        $currentRoom = $rooms[$roomIndex];

        $currentRoomCapacity = 0;

        $row = 1;

        $column = 1;

        $seatNumber = 1;

        /*
        |--------------------------------------------------------------------------
        | Create Bench
        |--------------------------------------------------------------------------
        */

        $currentBench = [];

        /*
        |--------------------------------------------------------------------------
        | Allocate Students
        |--------------------------------------------------------------------------
        */

        foreach ($finalStudents->values() as $studentData) {

            /*
            |--------------------------------------------------------------------------
            | Room Full -> Next Room
            |--------------------------------------------------------------------------
            */

            if ($currentRoomCapacity >= $currentRoom->capacity) {

                $roomIndex++;

                if (!isset($rooms[$roomIndex])) {

                    return back()->with(
                        'error',
                        'Selected rooms do not have enough capacity.'
                    );

                }

                $currentRoom = $rooms[$roomIndex];

                $currentRoomCapacity = 0;

                $row = 1;

                $column = 1;

                $seatNumber = 1;

                $currentBench = [];
            }

            /*
            |--------------------------------------------------------------------------
            | Bench Anti-Cheating Swap
            |--------------------------------------------------------------------------
            */

            if (!empty($currentBench)) {

                foreach ($currentBench as $benchStudent) {

                    if (
                        $benchStudent['student']->department_id ==
                        $studentData['student']->department_id
                    ) {

                        foreach ($finalStudents as $k => $candidate) {

                            $valid = true;

                            foreach ($currentBench as $b) {

                                if (
                                    $b['student']->department_id ==
                                    $candidate['student']->department_id
                                ) {
                                    $valid = false;
                                    break;
                                }

                            }

                            if ($valid) {

                                $temp = $studentData;

                                $studentData = $candidate;

                                $finalStudents[$k] = $temp;

                                break;

                            }

                        }

                    }

                }

            }

            /*
            |--------------------------------------------------------------------------
            | Save Allocation
            |--------------------------------------------------------------------------
            */

            SeatAllocation::create([

                'exam_id' => $studentData['exam']->id,

                'student_id' => $studentData['student']->id,

                'room_id' => $currentRoom->id,

                'invigilator_id' => $request->invigilators[$currentRoom->id],

                'seat_number' => $seatNumber,

                'row_no' => $row,

                'column_no' => $column,

            ]);

            $currentBench[] = $studentData;

            $seatNumber++;

            $currentRoomCapacity++;

            $column++;

            /*
            |--------------------------------------------------------------------------
            | Bench Full
            |--------------------------------------------------------------------------
            */

            if (count($currentBench) >= $benchCapacity) {

                $currentBench = [];

            }

            /*
            |--------------------------------------------------------------------------
            | Next Row
            |--------------------------------------------------------------------------
            */

            if ($column > $benchCapacity) {

                $column = 1;

                $row++;

            }

        }
        return redirect()
            ->route('seat-allocations.index')
            ->with('success','Seat allocation generated successfully.');
    }


    /**
     * Student Exam Detail Lookup.
     */
    public function show(SeatAllocation $seatAllocation)
    {
        $seatAllocation->load([
            'student.department',
            'student.course',
            'exam.course',
            'room',
            'invigilator'
        ]);

        return view(
            'seat_allocations.show',
            compact('seatAllocation')
        );
    }

    public function edit(SeatAllocation $seatAllocation)
    {
        $seatAllocation->load([
            'student.department',
            'student.course',
            'exam.course',
            'room',
            'invigilator'
        ]);

        $rooms = Room::orderBy('building')
            ->orderBy('room_no')
            ->get();

        $invigilators = Invigilator::orderBy('name')->get();

        return view(
            'seat_allocations.edit',
            compact(
                'seatAllocation',
                'rooms',
                'invigilators'
            )
        );
    }

    public function update(Request $request, SeatAllocation $seatAllocation)
    {
        $request->validate([

            'room_id'=>'required|exists:rooms,id',

            'invigilator_id'=>'required|exists:invigilators,id',

            'seat_number'=>'required|integer|min:1',

            'row_no'=>'required|integer|min:1',

            'column_no'=>'required|integer|min:1',

        ]);

        $exam = $seatAllocation->exam;

        $conflict = SeatAllocation::where('invigilator_id',$request->invigilator_id)
            ->where('exam_id','!=',$seatAllocation->exam_id)
            ->whereHas('exam',function($q) use($exam){

                $q->whereDate('exam_date',$exam->exam_date)
                ->where('start_time',$exam->start_time);

            })
            ->exists();

        if($conflict){

            return back()->with(
                'error',
                'Selected invigilator is already supervising another exam at the same date and time.'
            );

        }

        $seatAllocation->update([

            'room_id'=>$request->room_id,

            'invigilator_id'=>$request->invigilator_id,

            'seat_number'=>$request->seat_number,

            'row_no'=>$request->row_no,

            'column_no'=>$request->column_no,

        ]);

        return redirect()
            ->route('seat-allocations.index')
            ->with(
                'success',
                'Seat allocation updated successfully.'
            );
    }

    public function destroy(SeatAllocation $seatAllocation)
    {
        $seatAllocation->delete();

        return redirect()
            ->route('seat-allocations.index')
            ->with(
                'success',
                'Seat allocation deleted successfully.'
            );
    }
}