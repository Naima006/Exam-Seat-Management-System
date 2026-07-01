@extends('layouts.app')

@section('title', 'Student Exam Lookup')

@section('content')

<div class="space-y-6">

    {{-- Header --}}
    <div class="card p-6">

        <h1 class="text-3xl font-bold">

            Student Exam Detail Lookup

        </h1>

        <p class="text-slate-400 mt-2">

            Enter a Student ID to view exam hall, seating information,
            room details and assigned invigilator.

        </p>

    </div>

    <div class="flex items-center justify-between mb-6">

    <h2 class="text-2xl font-bold">
        Generate Seating Plan
    </h2>

    <a href="{{ route('seat-allocations.index') }}"
       class="btn btn-outline">

        ← Back

    </a>

</div>

    {{-- Search Card --}}
    <div class="card p-6">

        <form
            method="GET"
            action="{{ route('seat-allocations.lookup') }}">

            <div class="flex flex-col lg:flex-row gap-4">

                <input
                    type="text"
                    name="student_id"
                    value="{{ $search }}"
                    class="input flex-1"
                    placeholder="Enter Student ID (e.g. 221-15-1234)"
                    required>

                <button
                    class="btn btn-primary">

                    Search

                </button>

            </div>

        </form>

    </div>

    @if($search)

        @if($allocation)

        {{-- Student Details --}}
        <div class="card p-6">

            <h2 class="text-xl font-bold mb-5">

                Student Information

            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                <div>

                    <p class="text-slate-400">

                        Student ID

                    </p>

                    <p class="font-semibold">

                        {{ $allocation->student->student_id }}

                    </p>

                </div>

                <div>

                    <p class="text-slate-400">

                        Student Name

                    </p>

                    <p class="font-semibold">

                        {{ $allocation->student->student_name }}

                    </p>

                </div>

                <div>

                    <p class="text-slate-400">

                        Department

                    </p>

                    <p class="font-semibold">

                        {{ $allocation->student->department->department_name }}

                    </p>

                </div>

                <div>

                    <p class="text-slate-400">

                        Course

                    </p>

                    <p class="font-semibold">

                        {{ $allocation->exam->course->course_name }}

                    </p>

                </div>

                <div>

                    <p class="text-slate-400">

                        Exam Date

                    </p>

                    <p class="font-semibold">

                        {{ $allocation->exam->exam_date->format('d M Y') }}

                    </p>

                </div>

                <div>

                    <p class="text-slate-400">

                        Exam Time

                    </p>

                    <p class="font-semibold">

                        {{ \Carbon\Carbon::parse($allocation->exam->start_time)->format('h:i A') }}
                        -
                        {{ \Carbon\Carbon::parse($allocation->exam->end_time)->format('h:i A') }}

                    </p>

                </div>

            </div>

        </div>

        {{-- Seating Information --}}
        <div class="card p-6">

            <h2 class="text-xl font-bold mb-5">

                Seating Information

            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                <div>

                    <p class="text-slate-400">

                        Room Number

                    </p>

                    <p class="font-semibold">

                        {{ $allocation->room->room_no }}

                    </p>

                </div>

                <div>

                    <p class="text-slate-400">

                        Building

                    </p>

                    <p class="font-semibold">

                        {{ $allocation->room->building }}

                    </p>

                </div>

                <div>

                    <p class="text-slate-400">

                        Seat Number

                    </p>

                    <span class="badge badge-primary">

                        {{ $allocation->seat_number }}

                    </span>

                </div>

                <div>

                    <p class="text-slate-400">

                        Row

                    </p>

                    <p class="font-semibold">

                        {{ $allocation->row_no }}

                    </p>

                </div>

                <div>

                    <p class="text-slate-400">

                        Column

                    </p>

                    <p class="font-semibold">

                        {{ $allocation->column_no }}

                    </p>

                </div>

                <div>

                    <p class="text-slate-400">

                        Assigned Invigilator

                    </p>

                    <p class="font-semibold">

                        {{ $allocation->invigilator->name }}

                    </p>

                </div>

            </div>

        </div>

        @else

        <div class="card p-6 border border-red-500/30 bg-red-500/10">

            <p class="text-red-300">

                No exam allocation found for this Student ID.

            </p>

        </div>

        @endif

    @endif

</div>

@endsection