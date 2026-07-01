@extends('layouts.app')

@section('title', 'Exam Report')

@section('content')

<div class="space-y-6">

    {{-- ========================= --}}
    {{-- Header --}}
    {{-- ========================= --}}
    <div class="card p-6">

        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">

            <div>

                <h1 class="text-3xl font-bold">
                    Examination Report
                </h1>

                <p class="text-slate-400 mt-2">
                    View, search and export examination schedules.
                </p>

            </div>

            <div class="flex flex-wrap gap-3">

               

                <a href="{{ route('reports.exams.pdf') }}"
                   class="btn btn-success">

                    Export PDF

                </a>

                <a href="{{ route('reports.index') }}"
                   class="btn btn-outline">

                    ← Back

                </a>

            </div>

        </div>

    </div>

    {{-- ========================= --}}
    {{-- Statistics --}}
    {{-- ========================= --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6">

        <div class="card stat-card">

            <p class="stat-title">
                Total Exams
            </p>

            <h2 class="stat-value">
                {{ $exams->total() }}
            </h2>

            <p class="text-slate-400 text-sm mt-2">
                Scheduled Exams
            </p>

        </div>

        <div class="card stat-card">

            <p class="stat-title">
                Courses
            </p>

            <h2 class="stat-value">
                {{ \App\Models\Course::count() }}
            </h2>

            <p class="text-slate-400 text-sm mt-2">
                Available Courses
            </p>

        </div>

        <div class="card stat-card">

            <p class="stat-title">
                Rooms
            </p>

            <h2 class="stat-value">
                {{ \App\Models\Room::count() }}
            </h2>

            <p class="text-slate-400 text-sm mt-2">
                Examination Rooms
            </p>

        </div>

        <div class="card stat-card">

            <p class="stat-title">
                Invigilators
            </p>

            <h2 class="stat-value">
                {{ \App\Models\Invigilator::count() }}
            </h2>

            <p class="text-slate-400 text-sm mt-2">
                Assigned Staff
            </p>

        </div>

    </div>

    {{-- ========================= --}}
    {{-- Search --}}
    {{-- ========================= --}}
    <div class="card p-6">

        <form method="GET">

            <div class="flex flex-col md:flex-row items-center gap-4">

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search by course..."
                    class="input w-full">

                <button class="btn btn-primary">

                    Search

                </button>

                @if(request('search'))

                    <a href="{{ route('reports.exams') }}"
                       class="btn btn-outline">

                        Reset

                    </a>

                @endif

            </div>

        </form>

    </div>

    {{-- ========================= --}}
    {{-- Exam Table --}}
    {{-- ========================= --}}
    <div class="card p-6">

        <div class="flex justify-between items-center mb-6">

            <h2 class="text-xl font-semibold">

                Examination Schedule

            </h2>

            <span class="text-slate-400">

                {{ $exams->total() }} Records

            </span>

        </div>

        <div class="overflow-x-auto">

            <table class="table w-full">

                <thead>

                    <tr>

                        <th>#</th>
                        <th>Course</th>
                        <th>Exam Date</th>
                        <th>Exam Time</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($exams as $exam)

                        <tr>

                            <td>

                                {{ ($exams->currentPage()-1) * $exams->perPage() + $loop->iteration }}

                            </td>

                            <td>

                                {{ $exam->course->course_name ?? '-' }}

                            </td>

                            <td>

                                {{ \Carbon\Carbon::parse($exam->exam_date)->format('d M Y') }}

                            </td>

                            <td>

                                {{ \Carbon\Carbon::parse($exam->start_time)->format('h:i A') }}

                                -

                                {{ \Carbon\Carbon::parse($exam->end_time)->format('h:i A') }}

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="4" class="text-center py-12">

                                <div class="space-y-3">

                                    <div class="text-6xl">

                                        📝

                                    </div>

                                    <h3 class="text-xl font-semibold">

                                        No Examination Records Found

                                    </h3>

                                    <p class="text-slate-400">

                                        There are currently no examination schedules available.

                                    </p>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        @if($exams->count())

            <div class="mt-6">

                {{ $exams->withQueryString()->links() }}

            </div>

        @endif

    </div>

</div>

@endsection