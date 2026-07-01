@extends('layouts.app')

@section('title','Seat Allocation Details')

@section('content')

<div class="space-y-6">

    <div class="flex items-center justify-between">

        <div>

            <h1 class="text-3xl font-bold">

                Seat Allocation Details

            </h1>

            <p class="text-slate-400 mt-2">

                Detailed information about the student's examination seating.

            </p>

        </div>

        <a href="{{ route('seat-allocations.index') }}"
           class="btn btn-outline">

            ← Back

        </a>

    </div>

    <div class="card p-6">

        <div class="grid md:grid-cols-2 gap-6">

            <div>

                <h3 class="font-semibold mb-4">

                    Student Information

                </h3>

                <p><strong>Student ID:</strong> {{ $seatAllocation->student->student_id }}</p>

                <p><strong>Name:</strong> {{ $seatAllocation->student->student_name }}</p>

                <p><strong>Department:</strong> {{ $seatAllocation->student->department->department_name }}</p>

                <p><strong>Course:</strong> {{ $seatAllocation->student->course->course_name }}</p>

                <p><strong>Batch:</strong> {{ $seatAllocation->student->batch }}</p>

            </div>

            <div>

                <h3 class="font-semibold mb-4">

                    Examination Details

                </h3>

                <p><strong>Exam:</strong> {{ $seatAllocation->exam->course->course_name }}</p>

                <p><strong>Date:</strong> {{ $seatAllocation->exam->exam_date->format('d M Y') }}</p>

                <p><strong>Room:</strong> {{ $seatAllocation->room->room_no }}</p>

                <p><strong>Building:</strong> {{ $seatAllocation->room->building }}</p>

                <p><strong>Seat Number:</strong> {{ $seatAllocation->seat_number }}</p>

                <p><strong>Row:</strong> {{ $seatAllocation->row_no }}</p>

                <p><strong>Column:</strong> {{ $seatAllocation->column_no }}</p>

                <p><strong>Invigilator:</strong> {{ $seatAllocation->invigilator->name }}</p>

            </div>

        </div>

    </div>

    <div class="flex gap-3">

        <a
            href="{{ route('seat-allocations.edit',$seatAllocation) }}"
            class="btn btn-primary">

            Edit Allocation

        </a>

        <a
            href="{{ route('seat-allocations.index') }}"
            class="btn btn-outline">

            Back

        </a>

    </div>

</div>

@endsection