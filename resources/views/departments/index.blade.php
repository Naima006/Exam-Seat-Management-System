@extends('layouts.app')

@section('title', 'Departments')

@section('content')

<div class="space-y-6">

    {{-- Header --}}
    <div class="card p-6 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

        <div>

            <h1 class="text-3xl font-bold">
                Department Management
            </h1>

            <p class="text-slate-400 mt-2">
                Manage all academic departments.
            </p>

        </div>

        <a href="{{ route('departments.create') }}"
            class="btn btn-primary whitespace-nowrap">

            + Add Department

        </a>

    </div>

    {{-- Search --}}
    <div class="card p-5">

        <form method="GET" action="{{ route('departments.index') }}">

            <div class="flex flex-col md:flex-row gap-4">

                <input
                    type="text"
                    name="search"
                    value="{{ $search }}"
                    placeholder="Search department..."
                    class="input flex-1">

                <button
                    class="btn btn-primary">

                    Search

                </button>

                @if($search)

                    <a href="{{ route('departments.index') }}"
                        class="btn btn-danger">

                        Clear

                    </a>

                @endif

            </div>

        </form>

    </div>

    {{-- Table --}}
    <div class="card p-6">

        <div class="overflow-x-auto">

            <table class="table w-full">

                <thead>

                    <tr>

                        <th>#</th>

                        <th>Department Name</th>

                        <th>Department Code</th>

                        <th>Created</th>

                        <th class="text-center">
                            Actions
                        </th>

                    </tr>

                </thead>

                <tbody>

                @forelse($departments as $department)

                    <tr>

                        <td>
                            {{ $departments->firstItem() + $loop->index }}
                        </td>

                        <td>

                            {{ $department->department_name }}

                        </td>

                        <td>

                            <span class="px-3 py-1 rounded-full bg-blue-500/20 text-blue-300">

                                {{ $department->department_code }}

                            </span>

                        </td>

                        <td>

                            {{ $department->created_at->format('d M Y') }}

                        </td>

                        <td>

                            <div class="flex justify-center gap-2">

                                <a
                                    href="{{ route('departments.edit',$department) }}"
                                    class="btn btn-success">

                                    Edit

                                </a>

                                <form
                                    action="{{ route('departments.destroy',$department) }}"
                                    method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        class="btn btn-danger confirm-delete">

                                        Delete

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5" class="text-center py-10 text-slate-400">

                            No departments found.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

        <div class="mt-6">

            {{ $departments->links() }}

        </div>

    </div>

</div>

@endsection