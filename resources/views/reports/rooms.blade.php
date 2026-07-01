@extends('layouts.app')

@section('title', 'Room Report')

@section('content')

<div class="space-y-6">

    {{-- ================================= --}}
    {{-- Header --}}
    {{-- ================================= --}}
    <div class="card p-6">

        <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center gap-5">

            <div>

                <h1 class="text-3xl font-bold">
                    Room Report
                </h1>

                <p class="text-slate-400 mt-2">
                    View examination rooms, seating capacity and generate printable reports.
                </p>

            </div>

            <div class="flex gap-3">

                

                <a href="{{ route('reports.rooms.pdf') }}"
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
                Total Rooms
            </p>

            <h2 class="stat-value">
                {{ $rooms->total() }}
            </h2>

            <p class="text-slate-400 mt-2 text-sm">
                Registered Rooms
            </p>

        </div>

        <div class="card stat-card card-hover">

            <p class="stat-title">
                Active Rooms
            </p>

            <h2 class="stat-value">
                {{ \App\Models\Room::where('status','Active')->count() }}
            </h2>

            <p class="text-green-400 mt-2 text-sm">
                Available for Exams
            </p>

        </div>

        <div class="card stat-card card-hover">

            <p class="stat-title">
                Total Capacity
            </p>

            <h2 class="stat-value">
                {{ \App\Models\Room::sum('capacity') }}
            </h2>

            <p class="text-blue-400 mt-2 text-sm">
                Student Seats
            </p>

        </div>

        <div class="card stat-card card-hover">

            <p class="stat-title">
                Average Capacity
            </p>

            <h2 class="stat-value">
                {{ round(\App\Models\Room::avg('capacity')) }}
            </h2>

            <p class="text-purple-400 mt-2 text-sm">
                Seats per Room
            </p>

        </div>

    </div>

    {{-- ================================= --}}
    {{-- Search --}}
    {{-- ================================= --}}

    <div class="card p-6">

        <form method="GET"
              action="{{ route('reports.rooms') }}">

            <div class="flex flex-col md:flex-row gap-4">

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search Room Number or Building..."
                    class="input flex-1">

                <button class="btn btn-primary">

                    Search

                </button>

                @if(request('search'))

                    <a href="{{ route('reports.rooms') }}"
                       class="btn btn-outline">

                        Reset

                    </a>

                @endif

            </div>

        </form>

    </div>

    {{-- ================================= --}}
    {{-- Room Table --}}
    {{-- ================================= --}}

    <div class="card p-6">

        <div class="flex justify-between items-center mb-5">

            <h2 class="text-xl font-semibold">

                Room List

            </h2>

            <span class="text-slate-400">

                {{ $rooms->total() }} Rooms

            </span>

        </div>

        <div class="table-container">

            <table class="table">

                <thead>

                    <tr>

                        <th>#</th>
                        <th>Room No</th>
                        <th>Building</th>
                        <th>Capacity</th>
                        <th>Status</th>
                        <th>Created</th>

                    </tr>

                </thead>

                <tbody>

                @forelse($rooms as $room)

                    <tr>

                        <td>

                            {{ $loop->iteration + ($rooms->firstItem()-1) }}

                        </td>

                        <td>

                            <span class="font-semibold">

                                {{ $room->room_no }}

                            </span>

                        </td>

                        <td>

                            {{ $room->building }}

                        </td>

                        <td>

                            {{ $room->capacity }}

                        </td>

                        <td>

                            @if($room->status=='Active')

                                <span class="badge badge-success">

                                    Active

                                </span>

                            @else

                                <span class="badge badge-danger">

                                    Inactive

                                </span>

                            @endif

                        </td>

                        <td>

                            {{ $room->created_at->format('d M Y') }}

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="6"
                            class="text-center py-14">

                            <div class="space-y-3">

                                <div class="text-6xl">

                                    🏫

                                </div>

                                <h3 class="text-xl font-semibold">

                                    No Rooms Found

                                </h3>

                                <p class="text-slate-400">

                                    No room records match your search.

                                </p>

                            </div>

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

        {{-- Pagination --}}

        @if($rooms->hasPages())

            <div class="mt-8">

                {{ $rooms->withQueryString()->links() }}

            </div>

        @endif

    </div>

</div>

@endsection