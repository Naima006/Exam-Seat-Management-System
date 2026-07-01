@extends('layouts.app')

@section('title', 'Department Report')

@section('content')

<div class="space-y-6">

    {{-- =============================== --}}
    {{-- Header --}}
    {{-- =============================== --}}
    <div class="card p-6">

        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">

            <div>

                <h1 class="text-3xl font-bold">
                    Department Report
                </h1>

                <p class="text-slate-400 mt-2">
                    View department information, course distribution and generate printable reports.
                </p>

            </div>

            <div class="flex gap-3">

    

                <a href="{{ route('reports.departments.pdf') }}"
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

    {{-- =============================== --}}
    {{-- Statistics --}}
    {{-- =============================== --}}

    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6">

        <div class="card stat-card card-hover">

            <p class="stat-title">
                Total Departments
            </p>

            <h2 class="stat-value">
                {{ $departments->total() }}
            </h2>

            <p class="text-slate-400 mt-2 text-sm">
                Registered Departments
            </p>

        </div>

        <div class="card stat-card card-hover">

            <p class="stat-title">
                Total Courses
            </p>

            <h2 class="stat-value">
                {{ \App\Models\Course::count() }}
            </h2>

            <p class="text-blue-400 mt-2 text-sm">
                Active Courses
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
                Invigilators
            </p>

            <h2 class="stat-value">
                {{ \App\Models\Invigilator::count() }}
            </h2>

            <p class="text-purple-400 mt-2 text-sm">
                Assigned Faculties
            </p>

        </div>

    </div>

    {{-- =============================== --}}
    {{-- Search --}}
    {{-- =============================== --}}

    <div class="card p-6">

        <form method="GET"
            action="{{ route('reports.departments') }}">

            <div class="flex flex-col md:flex-row gap-4">

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search Department Name or Code..."
                    class="input flex-1">

                <button class="btn btn-primary">

                    Search

                </button>

                @if(request('search'))

                    <a href="{{ route('reports.departments') }}"
                        class="btn btn-outline">

                        Reset

                    </a>

                @endif

            </div>

        </form>

    </div>

    {{-- =============================== --}}
    {{-- Department Table --}}
    {{-- =============================== --}}

    <div class="card p-6">

        <div class="flex justify-between items-center mb-5">

            <h2 class="text-xl font-semibold">

                Department List

            </h2>

            <span class="text-slate-400">

                {{ $departments->total() }} Departments

            </span>

        </div>

        <div class="table-container">

            <table class="table">

                <thead>

                    <tr>

                        <th>#</th>

                        <th>Department Name</th>

                        <th>Code</th>

                        <th>Courses</th>

                        <th>Students</th>

                        <th>Created</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($departments as $department)

                        <tr>

                            <td>

                                {{ $loop->iteration + ($departments->firstItem() - 1) }}

                            </td>

                            <td class="font-semibold">

                                {{ $department->department_name }}

                            </td>

                            <td>

                                <span class="badge badge-primary">

                                    {{ $department->department_code }}

                                </span>

                            </td>

                            <td>

                                {{ $department->courses_count }}

                            </td>

                            <td>

                                {{ $department->students_count }}

                            </td>

                            <td>

                                {{ $department->created_at->format('d M Y') }}

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6"
                                class="py-12 text-center text-slate-400">

                                <div class="space-y-3">

                                    <div class="text-6xl">

                                        🏢

                                    </div>

                                    <h3 class="text-xl font-semibold">

                                        No Departments Found

                                    </h3>

                                    <p>

                                        No department matches your search.

                                    </p>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        {{-- Pagination --}}

        @if($departments->hasPages())

            <div class="mt-8">

                {{ $departments->withQueryString()->links() }}

            </div>

        @endif

    </div>

</div>

@endsection