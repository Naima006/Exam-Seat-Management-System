@extends('layouts.app')

@section('title', 'Invigilator Report')

@section('content')

<div class="space-y-6">

    {{-- ================================= --}}
    {{-- Header --}}
    {{-- ================================= --}}
    <div class="card p-6">

        <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center gap-5">

            <div>

                <h1 class="text-3xl font-bold">
                    Invigilator Report
                </h1>

                <p class="text-slate-400 mt-2">
                    View invigilator information and generate professional examination reports.
                </p>

            </div>

            <div class="flex gap-3">

                

                <a href="{{ route('reports.invigilators.pdf') }}"
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

    {{-- ================================= --}}
    {{-- Statistics --}}
    {{-- ================================= --}}

    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6">

        <div class="card stat-card card-hover">

            <p class="stat-title">

                Total Invigilators

            </p>

            <h2 class="stat-value">

                {{ $invigilators->total() }}

            </h2>

            <p class="text-slate-400 mt-2 text-sm">

                Registered Faculty

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

                Exams

            </p>

            <h2 class="stat-value">

                {{ \App\Models\Exam::count() }}

            </h2>

            <p class="text-green-400 mt-2 text-sm">

                Scheduled Exams

            </p>

        </div>

        <div class="card stat-card card-hover">

            <p class="stat-title">

                Rooms

            </p>

            <h2 class="stat-value">

                {{ \App\Models\Room::count() }}

            </h2>

            <p class="text-purple-400 mt-2 text-sm">

                Examination Rooms

            </p>

        </div>

    </div>

    {{-- ================================= --}}
    {{-- Search --}}
    {{-- ================================= --}}

    <div class="card p-6">

        <form
            action="{{ route('reports.invigilators') }}"
            method="GET">

            <div class="flex flex-col md:flex-row gap-4">

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search Name, Email or Phone..."
                    class="input flex-1">

                <button
                    class="btn btn-primary">

                    Search

                </button>

                @if(request('search'))

                    <a href="{{ route('reports.invigilators') }}"
                        class="btn btn-outline">

                        Reset

                    </a>

                @endif

            </div>

        </form>

    </div>

    {{-- ================================= --}}
    {{-- Table --}}
    {{-- ================================= --}}

    <div class="card p-6">

        <div class="flex justify-between items-center mb-5">

            <h2 class="text-xl font-semibold">

                Invigilator List

            </h2>

            <span class="text-slate-400">

                {{ $invigilators->total() }} Invigilators

            </span>

        </div>

        <div class="table-container">

            <table class="table">

                <thead>

                    <tr>

                        <th>#</th>

                        <th>Full Name</th>

                        <th>Email</th>

                        <th>Phone</th>

                        <th>Department</th>

                    </tr>

                </thead>

                <tbody>

                @forelse($invigilators as $invigilator)

                    <tr>

                        <td>

                            {{ $loop->iteration + ($invigilators->firstItem() - 1) }}

                        </td>

                        <td>

                            <span class="font-semibold">

                                {{ $invigilator->name }}

                            </span>

                        </td>

                        <td>

                            {{ $invigilator->email }}

                        </td>

                        <td>

                            {{ $invigilator->phone }}

                        </td>

                        <td>

                            {{ $invigilator->department->department_name ?? 'N/A' }}

                        </td>

                        <td>

                            {{ $invigilator->created_at->format('d M Y') }}

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="6"
                            class="text-center py-14">

                            <div class="space-y-3">

                                <div class="text-6xl">

                                    👨‍🏫

                                </div>

                                <h3 class="text-xl font-semibold">

                                    No Invigilators Found

                                </h3>

                                <p class="text-slate-400">

                                    No invigilator records match your search.

                                </p>

                            </div>

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

        {{-- Pagination --}}

        @if($invigilators->hasPages())

            <div class="mt-8">

                {{ $invigilators->withQueryString()->links() }}

            </div>

        @endif

    </div>

</div>

@endsection