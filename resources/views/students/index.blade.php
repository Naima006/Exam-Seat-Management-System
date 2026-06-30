@extends('layouts.app')

@section('title', 'Students')

@section('content')

<div class="space-y-6">

    {{-- Header --}}
    <div class="card p-6">

        <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center gap-5">

            <div>

                <h1 class="text-3xl font-bold">
                    Student Management
                </h1>

                <p class="text-slate-400 mt-2">
                    Manage students for examination seat allocation.
                </p>

            </div>

            <a
                href="{{ route('students.create') }}"
                class="btn btn-primary">

                + Add Student

            </a>

        </div>

    </div>


    {{-- Statistics --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

        <div class="card p-6">

            <p class="text-slate-400 text-sm">
                Total Students
            </p>

            <h2 class="text-4xl font-bold mt-2">
                {{ $totalStudents }}
            </h2>

        </div>

        <div class="card p-6">

            <p class="text-slate-400 text-sm">
                Latest Student
            </p>

            <h2 class="text-2xl font-bold mt-2 text-blue-400">

                {{ $latestStudent?->student_id ?? '-' }}

            </h2>

            <p class="text-slate-500 text-sm mt-2">

                {{ $latestStudent?->student_name ?? 'No students yet' }}

            </p>

        </div>

    </div>


    {{-- Search --}}
    <div class="card p-6">

        <form
            action="{{ route('students.index') }}"
            method="GET">

            <div class="flex flex-col md:flex-row gap-4">

                <div class="flex-1">

                    <input
                        id="studentSearch"
                        type="text"
                        name="search"
                        class="input w-full"
                        placeholder="Search student, ID, department or course..."
                        value="{{ request('search') }}">

                </div>

                <button
                    type="submit"
                    class="btn btn-primary">

                    Search

                </button>

                @if(request('search'))

                    <a
                        href="{{ route('students.index') }}"
                        class="btn btn-outline">

                        Reset

                    </a>

                @endif

            </div>

        </form>

    </div>


    {{-- Table --}}
    <div class="card overflow-hidden">

        <div class="overflow-x-auto">

            <table class="table w-full">

                <thead>

                    <tr>

                        <th>#</th>

                        <th>Student ID</th>

                        <th>Student Name</th>

                        <th>Department</th>

                        <th>Course</th>

                        <th>Batch</th>

                        <th class="text-center w-28">
                            Actions
                        </th>

                    </tr>

                </thead>

                @include('students.partials.table')

            </table>

        </div>

        @if($students->hasPages())

            <div class="p-5 border-t border-white/10">

                {{ $students->links() }}

            </div>

        @endif

    </div>

</div>

@endsection

@push('scripts')

<script>

let searchTimer;

const searchInput = document.getElementById('studentSearch');

searchInput.addEventListener('keyup', function () {

    clearTimeout(searchTimer);

    searchTimer = setTimeout(() => {

        fetch(`{{ route('students.index') }}?search=${encodeURIComponent(this.value)}`, {

            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }

        })

        .then(response => response.text())

        .then(html => {

            document.getElementById('studentTableBody').outerHTML = html;

        });

    }, 300);

});

</script>

@endpush