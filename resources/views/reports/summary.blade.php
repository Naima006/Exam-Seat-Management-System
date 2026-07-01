@extends('layouts.app')

@section('title','System Summary')

@section('content')

<div class="space-y-6">

    <div class="card p-6">

        <div class="flex justify-between items-center">

            <div>

                <h1 class="text-3xl font-bold">

                    System Summary Report

                </h1>

                <p class="text-slate-400 mt-2">

                    Overall statistics of the Examination Seat Management System.

                </p>

            </div>

            <div class="flex gap-3">

            

                <a href="{{ route('reports.summary.pdf') }}"
                   class="btn btn-success">

                    PDF Export

                </a>

                <a href="{{ route('reports.index') }}"
   class="btn btn-outline">

    ← Back
                </a>

            </div>

        </div>

    </div>

    <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">

        <div class="card stat-card">
            <p class="stat-title">Students</p>
            <h2 class="stat-value">{{ $students }}</h2>
        </div>

        <div class="card stat-card">
            <p class="stat-title">Departments</p>
            <h2 class="stat-value">{{ $departments }}</h2>
        </div>

        <div class="card stat-card">
            <p class="stat-title">Courses</p>
            <h2 class="stat-value">{{ $courses }}</h2>
        </div>

        <div class="card stat-card">
            <p class="stat-title">Rooms</p>
            <h2 class="stat-value">{{ $rooms }}</h2>
        </div>

        <div class="card stat-card">
            <p class="stat-title">Invigilators</p>
            <h2 class="stat-value">{{ $invigilators }}</h2>
        </div>

        <div class="card stat-card">
            <p class="stat-title">Exams</p>
            <h2 class="stat-value">{{ $exams }}</h2>
        </div>

        <div class="card stat-card">
            <p class="stat-title">Room Capacity</p>
            <h2 class="stat-value">{{ $roomCapacity }}</h2>
        </div>

        <div class="card stat-card">
            <p class="stat-title">Active Rooms</p>
            <h2 class="stat-value">{{ $activeRooms }}</h2>
        </div>

    </div>

    {{-- Chart --}}
    <div class="card p-6">

        <h2 class="text-xl font-bold mb-5">

            System Distribution

        </h2>

        

    </div>

    <div class="card p-6">

        <h2 class="text-xl font-bold mb-4">

            Summary

        </h2>

        <table class="table">

            <thead>

                <tr>

                    <th>Module</th>

                    <th>Total Records</th>

                </tr>

            </thead>

            <tbody>

                <tr>
                    <td>Students</td>
                    <td>{{ $students }}</td>
                </tr>

                <tr>
                    <td>Departments</td>
                    <td>{{ $departments }}</td>
                </tr>

                <tr>
                    <td>Courses</td>
                    <td>{{ $courses }}</td>
                </tr>

                <tr>
                    <td>Rooms</td>
                    <td>{{ $rooms }}</td>
                </tr>

                <tr>
                    <td>Invigilators</td>
                    <td>{{ $invigilators }}</td>
                </tr>

                <tr>
                    <td>Exams</td>
                    <td>{{ $exams }}</td>
                </tr>

            </tbody>

        </table>

    </div>

</div>

@endsection