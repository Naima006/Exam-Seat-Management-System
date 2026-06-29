@extends('layouts.app')

@section('title', 'Departments')

@section('content')

<div class="space-y-6">

    {{-- Page Header --}}
    <div class="card p-6">

        <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center gap-5">

            <div>

                <h1 class="text-3xl font-bold">

                    Department Management

                </h1>

                <p class="text-slate-400 mt-2">

                    Manage academic departments for examination seat allocation.

                </p>

            </div>

            <a
                href="{{ route('departments.create') }}"
                class="btn btn-primary">

                + Add Department

            </a>

        </div>

    </div>

    {{-- Statistics --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

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
                Searchable Fields
            </p>

            <h2 class="text-4xl font-bold mt-2">
                2
            </h2>

            <p class="text-slate-500 mt-2 text-sm">
                Name & Code
            </p>

        </div>

        <div class="card p-6">

            <p class="text-slate-400 text-sm">
                Latest Department
            </p>

            <h2 class="text-2xl font-bold mt-2 text-blue-400">

                {{ $latestDepartment?->department_code ?? '-' }}

            </h2>

            <p class="text-slate-500 text-sm mt-2">

                {{ $latestDepartment?->department_name ?? 'No departments yet' }}

            </p>

        </div>

    </div>

    {{-- Search --}}
    <div class="card p-6">

        <form
            method="GET"
            action="{{ route('departments.index') }}">

            <div class="flex flex-col md:flex-row gap-4">

                <div class="flex-1">

                    <input
                        type="text"
                        name="search"
                        class="input w-full"
                        placeholder="Search department name or code..."
                        value="{{ request('search') }}">

                </div>

                <button
                    type="submit"
                    class="btn btn-primary">

                    Search

                </button>

                @if(request('search'))

                    <a
                        href="{{ route('departments.index') }}"
                        class="btn btn-outline">

                        Reset

                    </a>

                @endif

            </div>

        </form>

    </div>

    {{-- Department Table --}}
    <div class="card overflow-hidden">

        <div class="overflow-x-auto">

            <table class="table w-full">

                <thead>

                    <tr>

                        <th>#</th>

                        <th>Department Name</th>

                        <th>Department Code</th>

                        <th>Created</th>

                        <th class="text-center w-28">Actions</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($departments as $department)
                        <tr class="hover:bg-white/5 transition border-b border-white/5">
                            <td>
                                {{ $loop->iteration + ($departments->currentPage()-1) * $departments->perPage() }}
                            </td>
                            <td>
                                <span class="font-semibold text-white">
                                    {{ $department->department_name }}
                                </span>
                            </td>
                            <td>
                                <span class="px-3 py-1 rounded-full bg-blue-500/10 text-blue-400 text-sm font-medium border border-blue-500/20">
                                    {{ $department->department_code }}
                                </span>
                            </td>
                            <td class="text-slate-400">
                                {{ $department->created_at->format('d M Y') }}
                            </td>
                            <td class="text-center whitespace-nowrap">
                                <div class="flex justify-center items-center gap-2">
                                    
                                    {{-- Edit Button - Colored by default --}}
                                    <a href="{{ route('departments.edit', $department) }}"
                                    class="p-2 rounded-lg bg-blue-500/10 border border-blue-500/20 text-blue-400 hover:bg-blue-500/20 hover:text-blue-300 transition-all duration-200"
                                    title="Edit Department">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="w-4 h-4"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.5-9.5a2.121 2.121 0 113 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                        </svg>
                                    </a>

                                    {{-- Delete Button - Red Warning colored by default --}}
                                    <form action="{{ route('departments.destroy', $department) }}"
                                        method="POST"
                                        class="delete-form inline">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="p-2 rounded-lg bg-red-500/10 border border-red-500/20 text-red-400 hover:bg-red-500/20 hover:text-red-300 transition-all duration-200 transform hover:scale-105"
                                                title="Delete Department">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="w-4 h-4"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M19 7H5m2 0V5a2 2 0 012-2h6a2 2 0 012 2v2m-9 0v12a2 2 0 002 2h6a2 2 0 002-2V7m-10 11V11m4 7V11"/>
                                            </svg>
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                    @empty

                        <tr>

                            <td
                                colspan="5"
                                class="text-center py-16">

                                <div class="space-y-3">

                                    <div class="text-6xl">

                                        📂

                                    </div>

                                    <h3 class="text-2xl font-semibold">

                                        No Departments Found

                                    </h3>

                                    <p class="text-slate-400">

                                        Create your first department to get started.

                                    </p>

                                    <a
                                        href="{{ route('departments.create') }}"
                                        class="btn btn-primary mt-3">

                                        Add Department

                                    </a>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        @if($departments->hasPages())

            <div class="p-5 border-t border-white/10">

                {{ $departments->links() }}

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

            title: 'Delete Department?',

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