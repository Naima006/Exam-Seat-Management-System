@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="space-y-6">

    {{-- Welcome --}}
    <div class="card p-6">

        <div class="flex flex-col lg:flex-row justify-between items-center gap-6">

            <div>

                <h1 class="text-3xl font-bold">
                    Welcome back, {{ Auth::user()->name }} 👋
                </h1>

                <p class="text-slate-400 mt-2">
                    Manage departments, courses and examination rooms from one place.
                </p>

            </div>

        </div>

    </div>


    {{-- Statistics --}}
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

        <div class="card stat-card">

            <p class="stat-title">
                Departments
            </p>

            <h2 class="stat-value">
                {{ $totalDepartments }}
            </h2>

            <p class="text-slate-400 mt-2 text-sm">
                Registered Departments
            </p>

        </div>


        <div class="card stat-card">

            <p class="stat-title">
                Courses
            </p>

            <h2 class="stat-value">
                {{ $totalCourses }}
            </h2>

            <p class="text-slate-400 mt-2 text-sm">
                Available Courses
            </p>

        </div>


        <div class="card stat-card">

            <p class="stat-title">
                Rooms
            </p>

            <h2 class="stat-value">
                {{ $totalRooms }}
            </h2>

            <p class="text-slate-400 mt-2 text-sm">
                Examination Rooms
            </p>

        </div>


        <div class="card stat-card">

            <p class="stat-title">
                Seating Capacity
            </p>

            <h2 class="stat-value">
                {{ $totalCapacity }}
            </h2>

            <p class="text-slate-400 mt-2 text-sm">
                Total Available Seats
            </p>

        </div>

    </div>


    {{-- Quick Actions --}}
    <div class="card p-6">

        <h2 class="text-xl font-bold tracking-wide mb-6 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
            </svg>
            Quick Actions
        </h2>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">

            {{-- Add Department --}}
            <a href="{{ route('departments.create') }}"
            class="group flex flex-col items-center justify-center p-5 rounded-2xl bg-white/[0.03] border border-white/5 hover:bg-indigo-500/10 hover:border-indigo-500/30 transition-all duration-300 transform hover:-translate-y-1">
                <div class="p-3 rounded-xl bg-slate-800/80 text-indigo-400 group-hover:bg-indigo-500 group-hover:text-white transition-all duration-300 shadow-md mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
                <span class="text-sm font-semibold tracking-wide text-slate-200 group-hover:text-white transition-colors duration-200">Department</span>
            </a>

            {{-- Add Course --}}
            <a href="{{ route('courses.create') }}"
            class="group flex flex-col items-center justify-center p-5 rounded-2xl bg-white/[0.03] border border-white/5 hover:bg-violet-500/10 hover:border-violet-500/30 transition-all duration-300 transform hover:-translate-y-1">
                <div class="p-3 rounded-xl bg-slate-800/80 text-violet-400 group-hover:bg-violet-500 group-hover:text-white transition-all duration-300 shadow-md mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
                <span class="text-sm font-semibold tracking-wide text-slate-200 group-hover:text-white transition-colors duration-200">Course</span>
            </a>

            {{-- Add Room --}}
            <a href="{{ route('rooms.create') }}"
            class="group flex flex-col items-center justify-center p-5 rounded-2xl bg-white/[0.03] border border-white/5 hover:bg-emerald-500/10 hover:border-emerald-500/30 transition-all duration-300 transform hover:-translate-y-1">
                <div class="p-3 rounded-xl bg-slate-800/80 text-emerald-400 group-hover:bg-emerald-500 group-hover:text-white transition-all duration-300 shadow-md mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </div>
                <span class="text-sm font-semibold tracking-wide text-slate-200 group-hover:text-white transition-colors duration-200">Room</span>
            </a>

            {{-- Add Exam --}}
            <a href="#"
            class="group flex flex-col items-center justify-center p-5 rounded-2xl bg-white/[0.03] border border-white/5 hover:bg-amber-500/10 hover:border-amber-500/30 transition-all duration-300 transform hover:-translate-y-1">
                <div class="p-3 rounded-xl bg-slate-800/80 text-amber-400 group-hover:bg-amber-500 group-hover:text-white transition-all duration-300 shadow-md mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <span class="text-sm font-semibold tracking-wide text-slate-200 group-hover:text-white transition-colors duration-200">Exam</span>
            </a>

        </div>

        <div class="mt-6">
            <a href="#"
            class="group flex items-center justify-center gap-4 px-6 py-4 rounded-2xl bg-white/3 border border-white/5 hover:bg-indigo-500/40 hover:border-indigo-500/80 transition-all duration-300 transform hover:-translate-y-0.5 shadow-sm">
                
                <div class="p-2.5 rounded-xl bg-slate-800/80 text-indigo-400 group-hover:bg-indigo-500 group-hover:text-white transition-all duration-300 shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v14a1 1 0 01-1 1H5a1 1 0 01-1-1V5z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 4v16M15 4v16M4 9h16M4 15h16" />
                    </svg>
                </div>
                
                <span class="text-base font-semibold tracking-wide text-slate-200 group-hover:text-white transition-colors duration-200">
                    Generate Seating Plan
                </span>
            </a>
        </div>

    </div>


    {{-- Latest Records --}}
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        {{-- Latest Department --}}
        <div class="card p-6">

            <h2 class="text-xl font-semibold mb-5">

                Latest Department

            </h2>

            @if($latestDepartment)

                <div class="space-y-3">

                    <div>

                        <p class="text-slate-400 text-sm">

                            Department Name

                        </p>

                        <h3 class="text-xl font-bold">

                            {{ $latestDepartment->department_name }}

                        </h3>

                    </div>

                    <div>

                        <p class="text-slate-400 text-sm">

                            Department Code

                        </p>

                        <span class="px-3 py-1 rounded-full bg-blue-500/20 text-blue-300">

                            {{ $latestDepartment->department_code }}

                        </span>

                    </div>

                </div>

            @else

                <p class="text-slate-400">

                    No departments available.

                </p>

            @endif

        </div>


        {{-- Latest Course --}}
        <div class="card p-6">

            <h2 class="text-xl font-semibold mb-5">

                Latest Course

            </h2>

            @if($latestCourse)

                <div class="space-y-3">

                    <div>

                        <p class="text-slate-400 text-sm">

                            Course Name

                        </p>

                        <h3 class="text-xl font-bold">

                            {{ $latestCourse->course_name }}

                        </h3>

                    </div>

                    <div>

                        <p class="text-slate-400 text-sm">

                            Course Code

                        </p>

                        <span class="px-3 py-1 rounded-full bg-green-500/20 text-green-300">

                            {{ $latestCourse->course_code }}

                        </span>

                    </div>

                    <div>

                        <p class="text-slate-400 text-sm">

                            Semester

                        </p>

                        <strong>

                            {{ $latestCourse->semester }}

                        </strong>

                    </div>

                </div>

            @else

                <p class="text-slate-400">

                    No courses available.

                </p>

            @endif

        </div>


        {{-- Latest Room --}}
        <div class="card p-6">

            <h2 class="text-xl font-semibold mb-5">

                Latest Room

            </h2>

            @if($latestRoom)

                <div class="space-y-3">

                    <div>

                        <p class="text-slate-400 text-sm">

                            Room Number

                        </p>

                        <h3 class="text-xl font-bold">

                            {{ $latestRoom->room_no }}

                        </h3>

                    </div>

                    <div>

                        <p class="text-slate-400 text-sm">

                            Building

                        </p>

                        <strong>

                            {{ $latestRoom->building }}

                        </strong>

                    </div>

                    <div>

                        <p class="text-slate-400 text-sm">

                            Capacity

                        </p>

                        <strong>

                            {{ $latestRoom->capacity }} Seats

                        </strong>

                    </div>

                </div>

            @else

                <p class="text-slate-400">

                    No rooms available.

                </p>

            @endif

        </div>

    </div>

    {{-- Future Modules --}}
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">

        {{-- Upcoming Exams --}}
        <div class="card p-6">

            <h2 class="text-xl font-semibold mb-5">

                Upcoming Exams

            </h2>

            <div class="flex flex-col items-center justify-center py-12">

                <div class="text-6xl mb-4">

                    📅

                </div>

                <h3 class="text-xl font-semibold">

                    Exam Module Coming Soon

                </h3>

                <p class="text-slate-400 mt-2 text-center">

                    Upcoming examinations will automatically appear here after the Exam module is implemented.

                </p>

            </div>

        </div>

        {{-- Recent Activities --}}
        <div class="card p-6">

            <h2 class="text-xl font-semibold mb-5">

                Recent Activities

            </h2>

            <div class="flex flex-col items-center justify-center py-12">

                <div class="text-6xl mb-4">

                    📜

                </div>

                <h3 class="text-xl font-semibold">

                    Activity Log Coming Soon

                </h3>

                <p class="text-slate-400 mt-2 text-center">

                    System activities such as adding departments, creating courses and generating seating plans will appear here.

                </p>

            </div>

        </div>

    </div>

</div>

@endsection