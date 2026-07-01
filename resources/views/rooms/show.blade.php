@extends('layouts.app')

@section('title','Room Details')

@section('content')

<div class="space-y-6">

    {{-- Header --}}
    <div class="card p-6">

        <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4">

            <div>

                <h1 class="text-3xl font-bold">

                    Room Details

                </h1>

                <p class="text-slate-400 mt-2">

                    View complete information about this examination room.

                </p>

            </div>

            <div class="flex gap-3">

                <a href="{{ route('rooms.edit',$room) }}"
                   class="btn btn-primary">

                    Edit

                </a>

                <a href="{{ route('rooms.index') }}"
                   class="btn btn-outline">

                    Back

                </a>

            </div>

        </div>

    </div>

    {{-- Information --}}
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        {{-- Left Card --}}
        <div class="xl:col-span-2 card p-6">

            <h2 class="text-xl font-semibold mb-6">

                Room Information

            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>

                    <p class="text-slate-400 text-sm">

                        Room Number

                    </p>

                    <h3 class="text-xl font-semibold mt-2">

                        {{ $room->room_no }}

                    </h3>

                </div>

                <div>

                    <p class="text-slate-400 text-sm">

                        Building no

                    </p>

                    <h3 class="text-xl font-semibold mt-2">

                        {{ $room->building }}

                    </h3>

                </div>

                <div>

                    <p class="text-slate-400 text-sm">

                        Seating Capacity

                    </p>

                    <h3 class="text-xl font-semibold mt-2">

                        {{ $room->capacity }} Seats

                    </h3>

                </div>

                <div>

                    <p class="text-slate-400 text-sm">

                        Status

                    </p>

                    <div class="mt-2">

                        @if($room->status=='Active')

                            <span class="badge badge-success">

                                Active

                            </span>

                        @else

                            <span class="badge badge-danger">

                                Inactive

                            </span>

                        @endif

                    </div>

                </div>

            </div>

        </div>

        {{-- Right Card --}}
        <div class="card p-6">

            <h2 class="text-xl font-semibold mb-6">

                Additional Information

            </h2>

            <div class="space-y-6">

                <div>

                    <p class="text-slate-400 text-sm">

                        Created At

                    </p>

                    <h4 class="mt-2">

                        {{ $room->created_at->format('d M Y') }}

                    </h4>

                </div>

                <div>

                    <p class="text-slate-400 text-sm">

                        Last Updated

                    </p>

                    <h4 class="mt-2">

                        {{ $room->updated_at->format('d M Y') }}

                    </h4>

                </div>

                <div>

                    <p class="text-slate-400 text-sm">

                        Availability

                    </p>

                    <h4 class="mt-2 text-green-400">

                        Ready for Examination

                    </h4>

                </div>

            </div>

        </div>

    </div>

    {{-- Quick Actions --}}
    <div class="card p-6">

        <h2 class="text-xl font-semibold mb-5">

            Quick Actions

        </h2>

        <div class="flex flex-wrap gap-4">

            <a href="{{ route('rooms.edit',$room) }}"
               class="btn btn-primary">

                Edit Room

            </a>

            <form action="{{ route('rooms.destroy',$room) }}"
                  method="POST"
                  onsubmit="return confirm('Delete this room permanently?')">

                @csrf
                @method('DELETE')

                <button
                    class="btn btn-danger">

                    Delete Room

                </button>

            </form>

            <a href="{{ route('rooms.index') }}"
               class="btn btn-outline">

                Return to Room List

            </a>

        </div>

    </div>

</div>

@endsection