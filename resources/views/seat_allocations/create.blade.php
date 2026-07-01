@extends('layouts.app')

@section('title','Generate Seat Allocation')

@section('content')

<div class="space-y-6">

    {{-- Header --}}
    <div class="card p-6">

        <div class="flex items-center justify-between">

            <div>

                <h1 class="text-3xl font-bold">

                    Generate Seating Plan

                </h1>

                <p class="text-slate-400 mt-2">

                    Select an examination session (Date & Time), rooms and invigilators.
                    The system will automatically generate seating for ALL examinations running in that session.

                </p>

            </div>

            <a
                href="{{ route('seat-allocations.index') }}"
                class="btn btn-outline">

                ← Back

            </a>

        </div>

    </div>

    <form
        method="POST"
        action="{{ route('seat-allocations.store') }}">

        @csrf

        <div class="grid lg:grid-cols-2 gap-6">

            {{-- LEFT --}}
            <div class="card p-6 space-y-6">

                <h2 class="text-xl font-bold">

                    Examination Details

                </h2>

                {{-- Exam Session --}}

                <div>

                    <label class="block mb-2 font-semibold">

                        Examination Date

                    </label>

                    <select
                        name="exam_date"
                        class="input w-full"
                        required>

                        <option value="">Select Date</option>

                        @foreach($examDates as $date)

                            <option value="{{ $date }}">

                                {{ \Carbon\Carbon::parse($date)->format('d M Y') }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="mt-5">

                    <label class="block mb-2 font-semibold">

                        Examination Time

                    </label>

                    <select
                        name="start_time"
                        class="input w-full"
                        required>

                        <option value="">Select Time</option>

                        @foreach($examTimes as $time)

                            <option value="{{ $time }}">

                                {{ \Carbon\Carbon::parse($time)->format('h:i A') }}

                            </option>

                        @endforeach

                    </select>

                </div>

                {{-- Bench Capacity --}}

                <div>

                    <label class="block mb-3 font-semibold">

                        Bench Capacity

                    </label>

                    <div class="flex gap-6">

                        <label class="flex items-center gap-2">

                            <input
                                type="radio"
                                name="bench_capacity"
                                value="3"
                                checked>

                            <span>

                                3 Students / Bench

                            </span>

                        </label>

                        <label class="flex items-center gap-2">

                            <input
                                type="radio"
                                name="bench_capacity"
                                value="2">

                            <span>

                                2 Students / Bench

                            </span>

                        </label>

                    </div>

                </div>

            </div>

            {{-- RIGHT --}}
            <div class="card p-6">

                <h2 class="text-xl font-bold mb-5">

                    Room & Invigilator Assignment

                </h2>

                <div class="space-y-5">

                    @foreach($rooms as $room)

                        <div class="border border-white/10 rounded-xl p-4">

                            <div class="flex items-center justify-between">

                                <div>

                                    <h3 class="font-semibold">

                                        {{ $room->room_no }}

                                    </h3>

                                    <p class="text-sm text-slate-400">

                                        {{ $room->building }}

                                        •

                                        Capacity {{ $room->capacity }}

                                    </p>

                                </div>

                                <label class="flex items-center gap-2">

                                    <input
                                        type="checkbox"
                                        name="rooms[]"
                                        value="{{ $room->id }}">

                                    <span>

                                        Use Room

                                    </span>

                                </label>

                            </div>

                            <div class="mt-4">

                                <label class="block mb-2 text-sm">

                                    Assign Invigilator

                                </label>

                                <select
                                    name="invigilators[{{ $room->id }}]"
                                    class="input w-full">

                                    <option value="">

                                        Select Invigilator

                                    </option>

                                    @foreach($invigilators as $teacher)

                                        <option value="{{ $teacher->id }}">

                                            {{ $teacher->name }}

                                            —

                                            {{ $teacher->department->department_name }}

                                        </option>

                                    @endforeach

                                </select>

                            </div>

                        </div>

                    @endforeach

                </div>

            </div>

        </div>

        <div class="card p-6 mt-6">

            <h2 class="text-xl font-bold mb-4">

                Seating Generation Rules

            </h2>

            <ul class="space-y-3 text-slate-400 list-disc pl-6">

                <li>Students from the same course and department will not sit beside each other whenever possible.</li>

                <li>Seat numbers are automatically generated based on row and column.</li>

                <li>When a room reaches capacity, students continue into the next selected room.</li>

                <li>The selected invigilator supervises every student allocated to that room.</li>

                <li>The same invigilator cannot supervise multiple exams scheduled at the same date and time.</li>

            </ul>

        </div>

        <div class="flex justify-end mt-6">

            <button
                class="btn btn-primary">

                Generate Seating Plan

            </button>

        </div>

    </form>

</div>

@endsection