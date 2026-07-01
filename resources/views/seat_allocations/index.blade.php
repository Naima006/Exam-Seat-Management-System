@extends('layouts.app')

@section('title', 'Seat Allocations')

@section('content')

<div class="space-y-6">

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

                Rooms Used

            </p>

            <h2 class="stat-value">

                {{ $totalRoomsUsed }}

            </h2>

        </div>

        <div class="card stat-card">

            <p class="stat-title">

                Invigilators Assigned

            </p>

            <h2 class="stat-value">

                {{ $totalInvigilators }}

            </h2>

        </div>

    </div>

    {{-- Toolbar --}}
    <div class="card p-6">

        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

            <div>

                <h2 class="text-2xl font-bold">

                    Seat Allocation Management

                </h2>

                <p class="text-slate-400 mt-1">

                    Generate seating plans and manage exam seating assignments.

                </p>

            </div>

            <div class="flex flex-wrap gap-3">

                {{-- Search --}}
                <div class="relative">

                    <input
                        id="tableSearch"
                        type="text"
                        placeholder="Search Student / Room / Invigilator..."
                        class="input w-80 pl-10">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="absolute left-3 top-3.5 w-5 h-5 text-slate-400"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M21 21l-4.35-4.35M11 18a7 7 0 100-14 7 7 0 000 14z"/>

                    </svg>

                </div>

                {{-- Generate Button --}}
                <a
                    href="#"
                    class="btn btn-primary">

                    Generate Seating Plan

                </a>

                {{-- Lookup Button --}}
                <a
                    href="#"
                    class="btn btn-outline">

                    Student Lookup

                </a>

            </div>

        </div>

    </div>

    {{-- Table --}}
    <div class="card overflow-hidden">

        <div
            id="tableContainer">

            @include('seat_allocations.partials.table')

        </div>

    </div>

</div>

@endsection

@push('scripts')

<script>

let timer;

const input = document.getElementById('tableSearch');

input?.addEventListener('keyup', function(){

    clearTimeout(timer);

    timer = setTimeout(function(){

        fetch(
            "{{ route('seat-allocations.index') }}?search=" +
            encodeURIComponent(input.value),

            {
                headers:{
                    'X-Requested-With':'XMLHttpRequest'
                }
            }

        )

        .then(response => response.text())

        .then(html => {

            document.getElementById('tableContainer').innerHTML = html;

        });

    },300);

});

</script>

@endpush