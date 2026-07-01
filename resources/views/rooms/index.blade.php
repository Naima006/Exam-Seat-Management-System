@extends('layouts.app')

@section('title', 'Room Management')

@section('content')

<div class="space-y-6">

    {{-- ============================= --}}
    {{-- Header --}}
    {{-- ============================= --}}
    <div class="card p-6">

        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

            <div>

                <h1 class="text-3xl font-bold">
                    Room Management
                </h1>

                <p class="text-slate-400 mt-2">
                    Manage examination rooms, buildings and seating capacity.
                </p>

            </div>

            <a href="{{ route('rooms.create') }}"
                class="btn btn-primary">

                + Add Room

            </a>

        </div>

    </div>

    {{-- ============================= --}}
    {{-- Statistics --}}
    {{-- ============================= --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6">

        <div class="card stat-card card-hover">

            <p class="stat-title">

                Total Rooms

            </p>

            <h2 class="stat-value">

                {{ $totalRooms }}

            </h2>

            <p class="text-slate-400 text-sm mt-2">

                Registered Rooms

            </p>

        </div>

        <div class="card stat-card card-hover">

            <p class="stat-title">

                Active Rooms

            </p>

            <h2 class="stat-value">

                {{ $activeRooms }}

            </h2>

            <p class="text-green-400 text-sm mt-2">

                Available for Exams

            </p>

        </div>

        <div class="card stat-card card-hover">

            <p class="stat-title">

                Total Capacity

            </p>

            <h2 class="stat-value">

                {{ $totalCapacity }}

            </h2>

            <p class="text-slate-400 text-sm mt-2">

                Student Seats

            </p>

        </div>

        <div class="card stat-card card-hover">

            <p class="stat-title">

                Average Capacity

            </p>

            <h2 class="stat-value">

                {{ round($averageCapacity) }}

            </h2>

            <p class="text-blue-400 text-sm mt-2">

                Seats per Room

            </p>

        </div>

    </div>

    {{-- ============================= --}}
    {{-- Search --}}
    {{-- ============================= --}}
    <div class="card p-6">

        <form
            action="{{ route('rooms.index') }}"
            method="GET">

            <div class="flex flex-col md:flex-row gap-4">

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search Room Number or Building no ..."
                    class="input w-full">

                <button
                    class="btn btn-primary">

                    Search

                </button>

                @if(request('search'))

                    <a href="{{ route('rooms.index') }}"
                        class="btn btn-outline">

                        Reset

                    </a>

                @endif

            </div>

        </form>

    </div>

    {{-- ============================= --}}
    {{-- Room Table --}}
    {{-- ============================= --}}
    <div class="card p-6">

        <div class="flex justify-between items-center mb-6">

            <h2 class="text-xl font-semibold">

                Room List

            </h2>

            <span class="text-slate-400">

                {{ $rooms->total() }}

                Rooms Found

            </span>

        </div>

        <div class="table-container">

            <table class="table">

                <thead>

                    <tr>

                        <th>#</th>

                        <th>Room No</th>

                        <th>Building no</th>

                        <th>Capacity</th>

                        <th>Status</th>

                       <th class="text-center w-56">

    Actions

</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($rooms as $room)

                        <tr>

                            <td>

                                {{ $loop->iteration }}

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

                                Seats

                            </td>

                            <td>

                                @if($room->status == 'Active')

                                    <span class="badge badge-success">

                                        Active

                                    </span>

                                @else

                                    <span class="badge badge-danger">

                                        Inactive

                                    </span>

                                @endif

                            </td>

                            <td class="text-center">

    <div class="flex items-center justify-center gap-2">

        <a href="{{ route('rooms.show', $room) }}"
            class="btn btn-outline text-xs">

            View

        </a>

        <a href="{{ route('rooms.edit', $room) }}"
            class="btn btn-primary text-xs">

            Edit

        </a>

        <form
            id="delete-form-{{ $room->id }}"
            action="{{ route('rooms.destroy', $room) }}"
            method="POST">

            @csrf
            @method('DELETE')

            <button
                type="button"
                onclick="confirmDelete({{ $room->id }}, '{{ $room->room_no }}')"
                class="btn btn-danger text-xs">

                Delete

            </button>

        </form>

    </div>

</td>
                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="6"
                                class="text-center py-12 text-slate-400">

                                <div class="space-y-3">

                                    <div class="text-5xl">

                                        🏫

                                    </div>

                                    <p>

                                        No Rooms Found

                                    </p>

                                    <a
                                        href="{{ route('rooms.create') }}"
                                        class="btn btn-primary mt-2">

                                        Add First Room

                                    </a>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        {{-- Pagination --}}
        @if($rooms->count())

            <div class="mt-6">

                {{ $rooms->withQueryString()->links() }}

            </div>

        @endif

    </div>

</div>

@endsection
@push('scripts')

<script>

function confirmDelete(id, roomNo)
{
    Swal.fire({
        title: 'Delete Room?',
        html: `
            <strong>${roomNo}</strong><br>
            This action cannot be undone.
        `,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#475569',
        confirmButtonText: 'Yes, Delete',
        cancelButtonText: 'Cancel'
    }).then((result) => {

        if (result.isConfirmed) {

            document.getElementById('delete-form-' + id).submit();

        }

    });
}

</script>

@endpush