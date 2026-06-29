@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="space-y-6">

    {{-- Welcome --}}
    <div class="card p-6">

        <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4">

            <div>

                <h1 class="text-3xl font-bold">
                    Welcome back, {{ Auth::user()->name }} 👋
                </h1>

                <p class="text-slate-400 mt-2">
                    Manage examinations, seating arrangements, rooms and invigilators from one place.
                </p>

            </div>

            <div>

                <button class="btn btn-primary">
                    Generate Seating Plan
                </button>

            </div>

        </div>

    </div>

    {{-- Statistics --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6">

        <div class="card stat-card card-hover">

            <p class="stat-title">Total Students</p>

            <h2 class="stat-value">1,250</h2>

            <p class="text-green-400 mt-2 text-sm">
                +35 this semester
            </p>

        </div>

        <div class="card stat-card card-hover">

            <p class="stat-title">Departments</p>

            <h2 class="stat-value">6</h2>

            <p class="text-slate-400 mt-2 text-sm">
                Active Departments
            </p>

        </div>

        <div class="card stat-card card-hover">

            <p class="stat-title">Exam Rooms</p>

            <h2 class="stat-value">18</h2>

            <p class="text-slate-400 mt-2 text-sm">
                Capacity: 720 Seats
            </p>

        </div>

        <div class="card stat-card card-hover">

            <p class="stat-title">Upcoming Exams</p>

            <h2 class="stat-value">12</h2>

            <p class="text-yellow-400 mt-2 text-sm">
                Next: Tomorrow
            </p>

        </div>

    </div>

    {{-- Quick Actions --}}
    <div class="card p-6">

        <h2 class="text-xl font-semibold mb-5">
            Quick Actions
        </h2>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">

            <a href="#" class="btn btn-primary justify-center">
                + Student
            </a>

            <a href="#" class="btn btn-success justify-center">
                + Exam
            </a>

            <a href="#" class="btn btn-outline justify-center">
                Rooms
            </a>

            <a href="#" class="btn btn-outline justify-center">
                Reports
            </a>

        </div>

    </div>

    {{-- Main Content --}}
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        {{-- Recent Activity --}}
        <div class="xl:col-span-2 card p-6">

            <div class="flex justify-between items-center mb-5">

                <h2 class="text-xl font-semibold">
                    Recent Activities
                </h2>

                <span class="text-slate-400 text-sm">
                    Today
                </span>

            </div>

            <div class="table-container">

                <table class="table">

                    <thead>

                        <tr>

                            <th>Activity</th>

                            <th>User</th>

                            <th>Status</th>

                            <th>Time</th>

                        </tr>

                    </thead>

                    <tbody>

                        <tr>

                            <td>Seat Allocation Generated</td>

                            <td>Admin</td>

                            <td>
                                <span class="badge badge-success">
                                    Completed
                                </span>
                            </td>

                            <td>10 mins ago</td>

                        </tr>

                        <tr>

                            <td>Room Updated</td>

                            <td>Admin</td>

                            <td>
                                <span class="badge badge-primary">
                                    Updated
                                </span>
                            </td>

                            <td>35 mins ago</td>

                        </tr>

                        <tr>

                            <td>Exam Created</td>

                            <td>Admin</td>

                            <td>
                                <span class="badge badge-warning">
                                    Pending
                                </span>
                            </td>

                            <td>1 hour ago</td>

                        </tr>

                        <tr>

                            <td>Department Added</td>

                            <td>Admin</td>

                            <td>
                                <span class="badge badge-success">
                                    Completed
                                </span>
                            </td>

                            <td>Yesterday</td>

                        </tr>

                    </tbody>

                </table>

            </div>

        </div>

        {{-- Upcoming Exams --}}
        <div class="card p-6">

            <h2 class="text-xl font-semibold mb-5">
                Upcoming Exams
            </h2>

            <div class="space-y-4">

                <div class="p-4 rounded-xl bg-white/5">

                    <h3 class="font-semibold">
                        Database Systems
                    </h3>

                    <p class="text-slate-400 text-sm mt-1">
                        28 July 2026
                    </p>

                    <p class="text-blue-400 text-sm">
                        Room A-301
                    </p>

                </div>

                <div class="p-4 rounded-xl bg-white/5">

                    <h3 class="font-semibold">
                        Computer Networks
                    </h3>

                    <p class="text-slate-400 text-sm mt-1">
                        29 July 2026
                    </p>

                    <p class="text-blue-400 text-sm">
                        Room B-202
                    </p>

                </div>

                <div class="p-4 rounded-xl bg-white/5">

                    <h3 class="font-semibold">
                        Software Engineering
                    </h3>

                    <p class="text-slate-400 text-sm mt-1">
                        31 July 2026
                    </p>

                    <p class="text-blue-400 text-sm">
                        Room C-101
                    </p>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection