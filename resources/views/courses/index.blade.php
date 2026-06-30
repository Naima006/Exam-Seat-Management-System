@extends('layouts.app')

@section('title', 'Courses')

@section('content')

<div class="space-y-6">

    {{-- Page Header --}}
    <div class="card p-6">

        <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center gap-5">

            <div>

                <h1 class="text-3xl font-bold">

                    Course Management

                </h1>

                <p class="text-slate-400 mt-2">

                    Manage academic courses for examination seat allocation.

                </p>

            </div>

            <a
                href="{{ route('courses.create') }}"
                class="btn btn-primary">

                + Add Course

            </a>

        </div>

    </div>

    {{-- Statistics --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

        <div class="card p-6">

            <p class="text-slate-400 text-sm">

                Total Courses

            </p>

            <h2 class="text-4xl font-bold mt-2">

                {{ $totalCourses }}

            </h2>

        </div>

        <div class="card p-6">

            <p class="text-slate-400 text-sm">

                Total Departments

            </p>

            <h2 class="text-4xl font-bold mt-2">

                {{ $totalDepartments }}

            </h2>

        </div>

        <div class="card p-6">

            <p class="text-slate-400 text-sm">

                Highest Semester

            </p>

            <h2 class="text-4xl font-bold mt-2">

                {{ $highestSemester }}

            </h2>

        </div>

    </div>

    {{-- Search --}}
    <div class="card p-6">

        <form
            action="{{ route('courses.index') }}"
            method="GET">

            <div class="flex flex-col lg:flex-row gap-4">

                <div class="flex-1">

                    <input
                        type="text"
                        name="search"
                        class="input w-full"
                        placeholder="Search by course name, code or department..."
                        value="{{ request('search') }}">

                </div>

                <button
                    type="submit"
                    class="btn btn-primary">

                    Search

                </button>

                @if(request('search'))

                    <a
                        href="{{ route('courses.index') }}"
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

                        <th>Course Name</th>

                        <th>Course Code</th>

                        <th>Department</th>

                        <th>Semester</th>

                        <th>Created</th>

                        <th class="text-center w-36">

                            Actions

                        </th>

                    </tr>

                </thead>

                <tbody>

                @forelse($courses as $course)

                    <tr>

                        <td>

                            {{ $course->id }}

                        </td>

                        <td>

                            <div class="font-semibold">

                                {{ $course->course_name }}

                            </div>

                        </td>

                        <td>

                            <span class="px-3 py-1 rounded-full bg-blue-500/20 text-blue-300">

                                {{ $course->course_code }}

                            </span>

                        </td>

                        <td>

                            {{ $course->department->department_name }}

                        </td>

                        <td>

                            <span class="px-3 py-1 rounded-full bg-purple-500/20 text-purple-300">

                                Semester {{ $course->semester }}

                            </span>

                        </td>

                        <td>

                            {{ $course->created_at->format('d M Y') }}

                        </td>

                        <td>

                            <div class="flex justify-center items-center gap-3">

                                {{-- Edit --}}
                                <a
                                    href="{{ route('courses.edit',$course) }}"
                                    class="text-blue-400 hover:text-blue-300 transition"
                                    title="Edit">

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         class="w-5 h-5"
                                         fill="none"
                                         viewBox="0 0 24 24"
                                         stroke="currentColor">

                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M16.5 3.5a2.121 2.121 0 113 3L12 14l-4 1 1-4 7.5-7.5z"/>

                                    </svg>

                                </a>

                                {{-- Delete --}}
                                <form
                                    action="{{ route('courses.destroy',$course) }}"
                                    method="POST"
                                    class="delete-form inline">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="text-red-400 hover:text-red-300 transition"
                                        title="Delete">

                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="w-5 h-5"
                                             fill="none"
                                             viewBox="0 0 24 24"
                                             stroke="currentColor">

                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  stroke-width="2"
                                                  d="M19 7L5 7M10 11V17M14 11V17M6 7L7 20A2 2 0 009 22H15A2 2 0 0017 20L18 7M9 7V4A1 1 0 0110 3H14A1 1 0 0115 4V7"/>

                                        </svg>

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="7"
                            class="text-center py-16">

                            <div class="space-y-4">

                                <div class="text-6xl">

                                    📚

                                </div>

                                <h3 class="text-2xl font-bold">

                                    No Courses Found

                                </h3>

                                <p class="text-slate-400">

                                    Start by adding your first course.

                                </p>

                                <a
                                    href="{{ route('courses.create') }}"
                                    class="btn btn-primary">

                                    + Add Course

                                </a>

                            </div>

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

        @if($courses->hasPages())

            <div class="border-t border-white/10 p-5">

                {{ $courses->links() }}

            </div>

        @endif

    </div>

</div>

@endsection

@push('scripts')

<script>

document.querySelectorAll('.delete-form').forEach(form => {

    form.addEventListener('submit', function(e){

        e.preventDefault();

        Swal.fire({

            title: 'Delete Course?',

            text: 'This action cannot be undone.',

            icon: 'warning',

            showCancelButton: true,

            confirmButtonColor: '#ef4444',

            confirmButtonText: 'Delete',

            cancelButtonText: 'Cancel'

        }).then((result)=>{

            if(result.isConfirmed){

                form.submit();

            }

        });

    });

});

</script>

@endpush