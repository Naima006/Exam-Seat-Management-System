@extends('layouts.app')

@section('title', 'Invigilator Management')

@section('content')

<div class="space-y-6">

    {{-- Header --}}
    <div class="card p-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

            <div>
                <h1 class="text-3xl font-bold">
                    Invigilator Management
                </h1>

                <p class="text-slate-400 mt-2">
                    Manage examination invigilators and their departments.
                </p>
            </div>

            <a href="{{ route('invigilators.create') }}"
               class="btn btn-primary">
                + Add Invigilator
            </a>

        </div>
    </div>

    {{-- Statistics --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6">

        <div class="card stat-card card-hover">
            <p class="stat-title">Total Invigilators</p>

            <h2 class="stat-value">
                {{ $totalInvigilators }}
            </h2>

            <p class="text-slate-400 mt-2 text-sm">
                Registered Staff
            </p>
        </div>

        <div class="card stat-card card-hover">

            <p class="stat-title">
                Departments
            </p>

            <h2 class="stat-value">
                {{ $totalDepartments }}
            </h2>

            <p class="text-blue-400 mt-2 text-sm">
                Active Departments
            </p>

        </div>

        <div class="card stat-card card-hover">

            <p class="stat-title">
                Showing
            </p>

            <h2 class="stat-value">
                {{ $invigilators->count() }}
            </h2>

            <p class="text-green-400 mt-2 text-sm">
                Current Page
            </p>

        </div>

        <div class="card stat-card card-hover">

            <p class="stat-title">
                Total Pages
            </p>

            <h2 class="stat-value">
                {{ $invigilators->lastPage() }}
            </h2>

            <p class="text-yellow-400 mt-2 text-sm">
                Pagination
            </p>

        </div>

    </div>

    {{-- Search --}}
    <div class="card p-6">

        <form method="GET"
              action="{{ route('invigilators.index') }}">

            <div class="flex flex-col md:flex-row gap-4">

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search name, email, phone or department..."
                    class="input w-full">

                <button class="btn btn-primary">

                    Search

                </button>

                @if(request('search'))

                    <a href="{{ route('invigilators.index') }}"
                       class="btn btn-outline">

                        Reset

                    </a>

                @endif

            </div>

        </form>

    </div>

    {{-- Table --}}
    <div class="card p-6">

        <div class="flex justify-between items-center mb-6">

            <h2 class="text-xl font-semibold">

                Invigilator List

            </h2>

            <span class="text-slate-400">

                {{ $invigilators->total() }}

                Records

            </span>

        </div>

        <div class="overflow-x-auto">

            <table class="table">

                <thead>

                <tr>

                    <th>#</th>

                    <th>Name</th>

                    <th>Email</th>

                    <th>Phone</th>

                    <th>Department</th>

                    <th class="text-center w-56">

                        Actions

                    </th>

                </tr>

                </thead>

                <tbody>

                @forelse($invigilators as $invigilator)

                    <tr>

                        <td>

                            {{ $loop->iteration + ($invigilators->firstItem()-1) }}

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

                            <span class="badge badge-primary">

                                {{ $invigilator->department->department_name }}

                            </span>

                        </td>

                        <td class="text-center">

                            <div class="flex justify-center gap-2">

                                <a href="{{ route('invigilators.show',$invigilator) }}"
                                   class="btn btn-outline text-xs">

                                    View

                                </a>

                                <a href="{{ route('invigilators.edit',$invigilator) }}"
                                   class="btn btn-primary text-xs">

                                    Edit

                                </a>

                                <form
                                    id="delete-form-{{ $invigilator->id }}"
                                    action="{{ route('invigilators.destroy',$invigilator) }}"
                                    method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="button"
                                        onclick="confirmDelete({{ $invigilator->id }},'{{ $invigilator->name }}')"
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
                            class="text-center py-12">

                            <div class="space-y-4">

                                <div class="text-6xl">

                                    👨‍🏫

                                </div>

                                <h3 class="text-xl font-semibold">

                                    No Invigilators Found

                                </h3>

                                <p class="text-slate-400">

                                    Start by adding your first invigilator.

                                </p>

                                <a href="{{ route('invigilators.create') }}"
                                   class="btn btn-primary">

                                    + Add Invigilator

                                </a>

                            </div>

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

        {{-- Pagination --}}
        @if($invigilators->count())

            <div class="mt-6">

                {{ $invigilators->links() }}

            </div>

        @endif

    </div>

</div>

@endsection

@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

function confirmDelete(id,name){

    Swal.fire({

        title:'Delete Invigilator?',

        html:'<b>'+name+'</b><br>This action cannot be undone.',

        icon:'warning',

        showCancelButton:true,

        confirmButtonColor:'#ef4444',

        cancelButtonColor:'#64748b',

        confirmButtonText:'Delete',

        cancelButtonText:'Cancel'

    }).then((result)=>{

        if(result.isConfirmed){

            document.getElementById('delete-form-'+id).submit();

        }

    });

}

</script>

@endpush