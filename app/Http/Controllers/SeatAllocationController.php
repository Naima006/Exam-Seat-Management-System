<?php

namespace App\Http\Controllers;

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

    /**
     * Show allocation page.
     */
    public function create()
    {
        $exams = Exam::with('course')
            ->orderBy('exam_date')
            ->orderBy('start_time')
            ->get();

        $rooms = Room::orderBy('building')
            ->orderBy('room_no')
            ->get();

        $invigilators = Invigilator::with('department')
            ->orderBy('name')
            ->get();

        return view(
            'seat_allocations.create',
            compact(
                'exams',
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
            'exam_id' => 'required|exists:exams,id',
            'rooms' => 'required|array|min:1',
            'rooms.*' => 'exists:rooms,id',
            'invigilators' => 'required|array',
            'bench_capacity' => 'required|in:2,3'
        ]);

        $exam = Exam::with('course')->findOrFail($request->exam_id);

        // Remove previous allocation
        SeatAllocation::where('exam_id', $exam->id)->delete();

        /*
        |--------------------------------------------------------------------------
        | Students
        |--------------------------------------------------------------------------
        */

        $students = Student::with('department')
            ->where('course_id', $exam->course_id)
            ->get();

        if ($students->count() == 0) {

            return back()->with(
                'error',
                'No students found for this course.'
            );

        }

        /*
        |--------------------------------------------------------------------------
        | Anti-cheating shuffle
        |--------------------------------------------------------------------------
        */

        $groups = $students
            ->groupBy('department_id')
            ->map(fn($g) => $g->values());

        $students = collect();

        while ($groups->filter(fn($g) => $g->count())->count()) {

            foreach ($groups as $key => $group) {

                if ($group->isEmpty()) {
                    continue;
                }

                $students->push($group->shift());

                $groups[$key] = $group;
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

        if ($rooms->count() == 0) {

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

        if ($capacity < $students->count()) {

            return back()->with(
                'error',
                'Selected rooms do not have enough capacity.'
            );

        }

        /*
        |--------------------------------------------------------------------------
        | Validate Invigilators BEFORE allocation
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

            $alreadyAssigned = SeatAllocation::where('invigilator_id', $invigilatorId)
                ->whereHas('exam', function ($query) use ($exam) {

                    $query->whereDate('exam_date', $exam->exam_date)
                        ->where('start_time', $exam->start_time)
                        ->where('id', '!=', $exam->id);

                })
                ->exists();

            if ($alreadyAssigned) {

                $teacher = Invigilator::find($invigilatorId);

                return back()->with(
                    'error',
                    $teacher->name.' is already supervising another exam at the same date and time.'
                );

            }

        }

        $benchCapacity = (int)$request->bench_capacity;

        $roomIndex = 0;

        $currentRoom = $rooms[$roomIndex];

        $seatInRoom = 0;

        $seatNumber = 1;

        $row = 1;

        $column = 1;

        $benchStudents = [];

        foreach ($students as $student) {

            /*
            |--------------------------------------------------------------------------
            | Room Full
            |--------------------------------------------------------------------------
            */

            if ($seatInRoom >= $currentRoom->capacity) {

                $roomIndex++;

                if (!isset($rooms[$roomIndex])) {

                    return back()->with(
                        'error',
                        'Not enough room capacity.'
                    );

                }

                $currentRoom = $rooms[$roomIndex];

                $seatInRoom = 0;

                $seatNumber = 1;

                $row = 1;

                $column = 1;

                $benchStudents = [];
            }

            /*
            |--------------------------------------------------------------------------
            | Save Allocation
            |--------------------------------------------------------------------------
            */
            $invigilatorId = $request->invigilators[$currentRoom->id];

            SeatAllocation::create([

                'exam_id' => $exam->id,

                'student_id' => $student->id,

                'room_id' => $currentRoom->id,

                'invigilator_id' => $invigilatorId,

                'seat_number' => $seatNumber,

                'row_no' => $row,

                'column_no' => $column,

            ]);

            $seatInRoom++;

            $seatNumber++;

            $benchStudents[] = $student;

            $column++;

            if (count($benchStudents) == $benchCapacity) {

                $benchStudents = [];

            }

            if ($column > $benchCapacity) {

                $column = 1;

                $row++;

            }
        }

        return redirect()
            ->route('seat-allocations.index')
            ->with(
                'success',
                'Seat allocation generated successfully.'
            );
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