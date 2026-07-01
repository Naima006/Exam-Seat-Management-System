@extends('layouts.app')

@section('title', 'Course Report')

@section('content')

<div class="space-y-6">

    {{-- =========================== --}}
    {{-- Header --}}
    {{-- =========================== --}}
    <div class="card p-6">

        <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center gap-5">

            <div>

                <h1 class="text-3xl font-bold">

                    Course Report

                </h1>

                <p class="text-slate-400 mt-2">

                    View all registered courses and generate professional reports.

                </p>

            </div>

            <div class="flex gap-3">


                <a href="{{ route('reports.courses.pdf') }}"
                    class="btn btn-success">

                    📄 Export PDF

                </a>

                <a href="{{ route('reports.index') }}"
   class="btn btn-outline">

    ← Back
                </a>

            </div>

        </div>

    </div>

    {{-- =========================== --}}
    {{-- Statistics --}}
    {{-- =========================== --}}

    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6">

        <div class="card stat-card card-hover">

            <p class="stat-title">

                Total Courses

            </p>

            <h2 class="stat-value">

                {{ $courses->total() }}

            </h2>

            <p class="text-slate-400 mt-2 text-sm">

                Registered Courses

            </p>

        </div>

        <div class="card stat-card card-hover">

            <p class="stat-title">

                Departments

            </p>

            <h2 class="stat-value">

                {{ \App\Models\Department::count() }}

            </h2>

            <p class="text-blue-400 mt-2 text-sm">

                Active Departments

            </p>

        </div>

        <div class="card stat-card card-hover">

            <p class="stat-title">

                Students

            </p>

            <h2 class="stat-value">

                {{ \App\Models\Student::count() }}

            </h2>

            <p class="text-green-400 mt-2 text-sm">

                Registered Students

            </p>

        </div>

        <div class="card stat-card card-hover">

            <p class="stat-title">

                Exams

            </p>

            <h2 class="stat-value">

                {{ \App\Models\Exam::count() }}

            </h2>

            <p class="text-purple-400 mt-2 text-sm">

                Scheduled Exams

            </p>

        </div>

    </div>

    {{-- =========================== --}}
    {{-- Search --}}
    {{-- =========================== --}}

    <div class="card p-6">

        <form
            action="{{ route('reports.courses') }}"
            method="GET">

            <div class="flex flex-col md:flex-row gap-4">

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search Course Code, Course Name..."
                    class="input flex-1">

                <button class="btn btn-primary">

                    Search

                </button>

                @if(request('search'))

                    <a href="{{ route('reports.courses') }}"
                        class="btn btn-outline">

                        Reset

                    </a>

                @endif

            </div>

        </form>

    </div>

    {{-- =========================== --}}
    {{-- Course Table --}}
    {{-- =========================== --}}

    <div class="card p-6">

        <div class="flex justify-between items-center mb-6">

            <h2 class="text-xl font-semibold">

                Course List

            </h2>

            <span class="text-slate-400">

                {{ $courses->total() }} Courses

            </span>

        </div>

        <div class="table-container">

            <table class="table">

                <thead>

                    <tr>

                        <th>#</th>

                        <th>Course Code</th>

                        <th>Course Name</th>

                        <th>Department</th>

                        <th>Semester</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($courses as $course)

                        <tr>

                            <td>

                                {{ $loop->iteration + ($courses->firstItem() - 1) }}

                            </td>

                            <td>

                                <span class="badge badge-primary">

                                    {{ $course->course_code }}

                                </span>

                            </td>

                            <td class="font-semibold">

                                {{ $course->course_name }}

                            </td>

                            <td>

                                {{ $course->department->department_name ?? 'N/A' }}

                            </td>

                            <td>

                                Semester {{ $course->semester }}

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="6"
                                class="text-center py-14">

                                <div class="space-y-3">

                                    <div class="text-6xl">

                                        📘

                                    </div>

                                    <h3 class="text-xl font-semibold">

                                        No Courses Found

                                    </h3>

                                    <p class="text-slate-400">

                                        No courses matched your search.

                                    </p>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        {{-- Pagination --}}

        @if($courses->hasPages())

            <div class="mt-8">

                {{ $courses->withQueryString()->links() }}

            </div>

        @endif

    </div>

</div>

@endsection