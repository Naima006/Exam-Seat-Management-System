@extends('layouts.app')

@section('title','Exam Management')

@section('content')

<div class="space-y-6">

    {{-- Header --}}
    <div class="card p-6">

        <div class="flex justify-between items-center">

            <div>

                <h1 class="text-3xl font-bold">
                    Exam Management
                </h1>

                <p class="text-slate-400 mt-2">
                    Schedule and manage examination sessions.
                </p>

            </div>

            <a href="{{ route('exams.create') }}"
               class="btn btn-primary">

                + Add Exam

            </a>

        </div>

    </div>

    {{-- Statistics --}}
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

        <div class="card stat-card">

            <p class="stat-title">
                Total Exams
            </p>

            <h2 class="stat-value">
                {{ $totalExams }}
            </h2>

        </div>

        <div class="card stat-card">

            <p class="stat-title">
                Today's Exams
            </p>

            <h2 class="stat-value">
                {{ $todayExams }}
            </h2>

        </div>

        <div class="card stat-card">

            <p class="stat-title">
                Upcoming Exams
            </p>

            <h2 class="stat-value">
                {{ $upcomingExams }}
            </h2>

        </div>

        <div class="card stat-card">

            <p class="stat-title">
                Courses Covered
            </p>

            <h2 class="stat-value">
                {{ $courseCount }}
            </h2>

        </div>

    </div>

    {{-- Search --}}
    <div class="card p-6">

        <form method="GET">

            <div class="flex gap-3">

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search Course..."

                    class="input flex-1">

                <button class="btn btn-primary">

                    Search

                </button>

                @if(request('search'))

                <a href="{{ route('exams.index') }}"
                   class="btn btn-outline">

                    Reset

                </a>

                @endif

            </div>

        </form>

    </div>

    {{-- Table --}}
    <div class="card p-6">

        <div class="table-container">

            <table class="table">

                <thead>

                <tr>

                    <th>#</th>

                    <th>Course</th>

                    <th>Date</th>

                    <th>Start Time</th>

                    <th>End Time</th>

                    <th class="text-center w-60">
                        Actions
                    </th>

                </tr>

                </thead>

                <tbody>

                @forelse($exams as $exam)

                <tr>

                    <td>

                        {{ $loop->iteration + ($exams->currentPage()-1)*$exams->perPage() }}

                    </td>

                    <td>

                        <span class="font-semibold">

                            {{ $exam->course->course_name }}

                        </span>

                    </td>

                    <td>

                        {{ \Carbon\Carbon::parse($exam->exam_date)->format('d M Y') }}

                    </td>

                    <td>

                        {{ \Carbon\Carbon::parse($exam->start_time)->format('h:i A') }}

                    </td>

                    <td>

                        {{ \Carbon\Carbon::parse($exam->end_time)->format('h:i A') }}

                    </td>

                    <td>

                        <div class="flex justify-center gap-2">

                            <a href="{{ route('exams.show',$exam) }}"
                               class="btn btn-outline text-xs">

                                View

                            </a>

                            <a href="{{ route('exams.edit',$exam) }}"
                               class="btn btn-primary text-xs">

                                Edit

                            </a>

                            <form
                                id="delete-form-{{ $exam->id }}"
                                method="POST"
                                action="{{ route('exams.destroy',$exam) }}">

                                @csrf
                                @method('DELETE')

                                <button
                                    type="button"
                                    onclick="deleteExam({{ $exam->id }})"
                                    class="btn btn-danger text-xs">

                                    Delete

                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="6"
                        class="text-center py-12 text-slate-400">

                        <div class="space-y-4">

                            <div class="text-5xl">

                                📝

                            </div>

                            <p>

                                No Exams Found

                            </p>

                            <a href="{{ route('exams.create') }}"
                               class="btn btn-primary">

                                Add First Exam

                            </a>

                        </div>

                    </td>

                </tr>

                @endforelse

                </tbody>

            </table>

        </div>

        {{-- Pagination --}}

        @if($exams->hasPages())

        <div class="mt-6">

            {{ $exams->links() }}

        </div>

        @endif

    </div>

</div>

@endsection

@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

function deleteExam(id){

Swal.fire({

title:'Delete Exam?',

text:'This action cannot be undone.',

icon:'warning',

showCancelButton:true,

confirmButtonColor:'#ef4444',

cancelButtonColor:'#64748b',

confirmButtonText:'Delete'

}).then((result)=>{

if(result.isConfirmed){

document.getElementById('delete-form-'+id).submit();

}

});

}

</script>

@endpush