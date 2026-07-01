@extends('layouts.app')

@section('title', 'Student Report')

@section('content')

<div class="space-y-6">

    {{-- Header --}}
    <div class="card p-6">

        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">

            <div>

                <h1 class="text-3xl font-bold">
                    Student Report
                </h1>

                <p class="text-slate-400 mt-2">
                    Complete list of registered students.
                </p>

            </div>

            <div class="flex flex-wrap gap-3">

                

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

    {{-- Statistics --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <div class="card stat-card">

            <p class="stat-title">
                Students
            </p>

            <h2 class="stat-value">
                {{ $students->total() }}
            </h2>

        </div>

        <div class="card stat-card">

            <p class="stat-title">
                Departments
            </p>

            <h2 class="stat-value">
                {{ \App\Models\Department::count() }}
            </h2>

        </div>

        <div class="card stat-card">

            <p class="stat-title">
                Courses
            </p>

            <h2 class="stat-value">
                {{ \App\Models\Course::count() }}
            </h2>

        </div>

    </div>

    {{-- Search --}}
    <div class="card p-6">

        <form method="GET">

            <div class="flex flex-col md:flex-row gap-3">

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search student..."
                    class="input flex-1">

                <button class="btn btn-primary">

                    Search

                </button>

                @if(request('search'))

                    <a href="{{ route('reports.students') }}"
                       class="btn btn-outline">

                        Reset

                    </a>

                @endif

            </div>

        </form>

    </div>

    {{-- Student Table --}}
    <div class="card p-6">

        <div class="overflow-x-auto">

            <table class="table w-full">

                <thead>

                    <tr>

                        <th>#</th>
                        <th>Name</th>
                        <th>Student ID</th>
                        <th>Department</th>
                        <th>Semester</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($students as $student)

                        <tr>

                            <td>{{ $loop->iteration }}</td>

                            <td>{{ $student->student_name }}</td>

                            <td>{{ $student->student_id }}</td>

                            <td>{{ $student->department->department_name ?? '-' }}</td>

                            <td>{{ $student->semester }}</td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5" class="text-center py-10 text-slate-400">

                                No students found.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="mt-6">

            {{ $students->withQueryString()->links() }}

        </div>

    </div>

</div>

@endsection