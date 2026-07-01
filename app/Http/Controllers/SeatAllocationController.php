<?php

namespace App\Http\Controllers;

use App\Models\SeatAllocation;
use App\Models\Exam;
use App\Models\Room;
use App\Models\Student;
use App\Models\Invigilator;
use Illuminate\Http\Request;

class SeatAllocationController extends Controller
{
    /**
     * Display Seat Allocations.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $seatAllocations = SeatAllocation::with([
                'student.department',
                'student.course',
                'exam.course',
                'room',
                'invigilator'
            ])

            ->when($search, function ($query) use ($search) {

                $query->whereHas('student', function ($q) use ($search) {

                    $q->where('student_name', 'LIKE', "%{$search}%")
                      ->orWhere('student_id', 'LIKE', "%{$search}%");

                })

                ->orWhereHas('room', function ($q) use ($search) {

                    $q->where('room_no', 'LIKE', "%{$search}%");

                })

                ->orWhereHas('invigilator', function ($q) use ($search) {

                    $q->where('name', 'LIKE', "%{$search}%");

                });

            })

            ->latest()

            ->paginate(10)

            ->withQueryString();

        if ($request->ajax()) {

            return view(
                'seat_allocations.partials.table',
                compact('seatAllocations')
            )->render();

        }

        return view('seat_allocations.index', [

            'seatAllocations' => $seatAllocations,

            'totalAllocations' => SeatAllocation::count(),

            'totalRoomsUsed' => SeatAllocation::distinct('room_id')->count(),

            'totalInvigilators' => SeatAllocation::distinct('invigilator_id')->count(),

        ]);
    }

    /**
     * Show create form.
     */
    public function create()
    {
        return view('seat_allocations.create', [

            'students' => Student::orderBy('student_name')->get(),

            'rooms' => Room::orderBy('room_no')->get(),

            'exams' => Exam::with('course')->get(),

            'invigilators' => Invigilator::orderBy('name')->get(),

        ]);
    }

    /**
     * Store.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show allocation.
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

    /**
     * Edit allocation.
     */
    public function edit(SeatAllocation $seatAllocation)
    {
        return view('seat_allocations.edit', [

            'seatAllocation' => $seatAllocation,

            'students' => Student::orderBy('student_name')->get(),

            'rooms' => Room::orderBy('room_no')->get(),

            'exams' => Exam::with('course')->get(),

            'invigilators' => Invigilator::orderBy('name')->get(),

        ]);
    }

    /**
     * Update.
     */
    public function update(Request $request, SeatAllocation $seatAllocation)
    {
        //
    }

    /**
     * Delete.
     */
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