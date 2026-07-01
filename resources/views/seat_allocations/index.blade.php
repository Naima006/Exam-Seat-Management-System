@extends('layouts.app')

@section('title', 'Seat Allocations')

@section('content')

<div class="space-y-6">

    {{-- Header --}}
    <div class="card p-6">

        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

            <div>

                <h1 class="text-3xl font-bold">
                    Seat Allocations
                </h1>

                <p class="text-slate-400 mt-2">
                    Generate and manage examination seat allocations.
                </p>

            </div>

            <div class="flex gap-3">

                <a
                    href="{{ route('seat-allocations.lookup') }}"
                    class="btn btn-outline">

                    Student Lookup

                </a>

                <a
                    href="{{ route('seat-allocations.room-invigilators') }}"
                    class="btn btn-outline">

                    Room Invigilators

                </a>

                <a
                    href="{{ route('seat-allocations.create') }}"
                    class="btn btn-primary">

                    Generate Seating

                </a>

            </div>

        </div>

    </div>

    {{-- Statistics --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <div class="card stat-card">

            <p class="stat-title">
                Total Allocations
            </p>

            <h2 class="stat-value">

                {{ $totalAllocations }}

            </h2>

        </div>

        <div class="card stat-card">

            <p class="stat-title">
                Total Rooms Used
            </p>

            <h2 class="stat-value">

                {{ $totalRooms }}

            </h2>

        </div>

        <div class="card stat-card">

            <p class="stat-title">
                Total Invigilators Assigned
            </p>

            <h2 class="stat-value">

                {{ $totalInvigilators }}

            </h2>

        </div>

    </div>

    {{-- Search --}}
    <div class="card p-5">

        <form
            method="GET"
            action="{{ route('seat-allocations.index') }}">

            <div class="flex flex-col md:flex-row gap-4">

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search by Student ID or Student Name..."
                    class="input flex-1">

                <div class="flex gap-3">

                    <button
                        type="submit"
                        class="btn btn-primary">

                        Search

                    </button>

                    @if(request()->filled('search'))

                        <a
                            href="{{ route('seat-allocations.index') }}"
                            class="btn btn-outline">

                            Reset

                        </a>

                    @endif

                </div>

            </div>

        </form>

    </div>

    {{-- Table --}}
    <div class="card overflow-hidden">

        @include('seat_allocations.partials.table')

    </div>

</div>

@endsection