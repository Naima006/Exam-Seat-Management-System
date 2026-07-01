@extends('layouts.app')

@section('title','Edit Seat Allocation')

@section('content')

<div class="max-w-4xl mx-auto">

    <div class="card p-6">

        <h1 class="text-2xl font-bold mb-6">

            Edit Seat Allocation

        </h1>

        <form
            method="POST"
            action="{{ route('seat-allocations.update',$seatAllocation) }}">

            @csrf
            @method('PUT')

            <div class="grid md:grid-cols-2 gap-6">

                <div>

                    <label class="font-semibold">

                        Student

                    </label>

                    <input
                        class="input w-full"
                        value="{{ $seatAllocation->student->student_name }}"
                        readonly>

                </div>

                <div>

                    <label class="font-semibold">

                        Student ID

                    </label>

                    <input
                        class="input w-full"
                        value="{{ $seatAllocation->student->student_id }}"
                        readonly>

                </div>

                <div>

                    <label class="font-semibold">

                        Course

                    </label>

                    <input
                        class="input w-full"
                        value="{{ $seatAllocation->exam->course->course_name }}"
                        readonly>

                </div>

                <div>

                    <label class="font-semibold">

                        Exam Date

                    </label>

                    <input
                        class="input w-full"
                        value="{{ $seatAllocation->exam->exam_date->format('d M Y') }}"
                        readonly>

                </div>

                <div>

                    <label class="font-semibold">

                        Room

                    </label>

                    <select
                        name="room_id"
                        class="input w-full">

                        @foreach($rooms as $room)

                            <option
                                value="{{ $room->id }}"
                                @selected($room->id==$seatAllocation->room_id)>

                                {{ $room->room_no }}

                                ({{ $room->building }})

                            </option>

                        @endforeach

                    </select>

                </div>

                <div>

                    <label class="font-semibold">

                        Invigilator

                    </label>

                    <select
                        name="invigilator_id"
                        class="input w-full">

                        @foreach($invigilators as $teacher)

                            <option
                                value="{{ $teacher->id }}"
                                @selected($teacher->id==$seatAllocation->invigilator_id)>

                                {{ $teacher->name }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <div>

                    <label class="font-semibold">

                        Seat Number

                    </label>

                    <input
                        type="number"
                        name="seat_number"
                        class="input w-full"
                        value="{{ $seatAllocation->seat_number }}">

                </div>

                <div>

                    <label class="font-semibold">

                        Row

                    </label>

                    <input
                        type="number"
                        name="row_no"
                        class="input w-full"
                        value="{{ $seatAllocation->row_no }}">

                </div>

                <div>

                    <label class="font-semibold">

                        Column

                    </label>

                    <input
                        type="number"
                        name="column_no"
                        class="input w-full"
                        value="{{ $seatAllocation->column_no }}">

                </div>

            </div>

            <div class="flex justify-end gap-3 mt-8">

                <a
                    href="{{ route('seat-allocations.index') }}"
                    class="btn btn-outline">

                    Cancel

                </a>

                <button
                    class="btn btn-primary">

                    Save Changes

                </button>

            </div>

        </form>

    </div>

</div>

@endsection