@extends('layouts.app')

@section('title','Room-wise Invigilators')

@section('content')

<div class="space-y-6">

    <div class="flex items-center justify-between">

        <div>

            <h1 class="text-3xl font-bold">

                Room-wise Invigilators

            </h1>

            <p class="text-slate-400 mt-2">

                View room assignments together with their invigilators.

            </p>

        </div>

        <a
            href="{{ route('seat-allocations.index') }}"
            class="btn btn-outline">

            ← Back

        </a>

    </div>

    <div class="card overflow-hidden">

        <table class="table">

            <thead>

                <tr>

                    <th>Exam</th>

                    <th>Date</th>

                    <th>Room</th>

                    <th>Building</th>

                    <th>Invigilator</th>

                    <th>Department</th>

                </tr>

            </thead>

            <tbody>

            @forelse($rooms as $allocation)

                <tr>

                    <td>

                        {{ $allocation->exam->course->course_name }}

                    </td>

                    <td>

                        {{ $allocation->exam->exam_date->format('d M Y') }}

                    </td>

                    <td>

                        {{ $allocation->room->room_no }}

                    </td>

                    <td>

                        {{ $allocation->room->building }}

                    </td>

                    <td>

                        {{ $allocation->invigilator->name }}

                    </td>

                    <td>

                        {{ $allocation->invigilator->department->department_name }}

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="6" class="text-center py-8">

                        No room assignments found.

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection