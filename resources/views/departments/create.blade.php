@extends('layouts.app')

@section('title', 'Add Department')

@section('content')

<div class="max-w-3xl mx-auto">

    <div class="card p-6">

        <div class="mb-6">

            <h1 class="text-3xl font-bold">

                Add Department

            </h1>

            <p class="text-slate-400 mt-2">

                Create a new department for the examination system.

            </p>

        </div>

        <form
            action="{{ route('departments.store') }}"
            method="POST"
            class="space-y-6">

            @csrf

            <div>

                <label class="label">

                    Department Name

                </label>

                <input
                    type="text"
                    name="department_name"
                    class="input"
                    value="{{ old('department_name') }}"
                    placeholder="Software Engineering">

                @error('department_name')

                    <p class="text-red-400 text-sm mt-2">

                        {{ $message }}

                    </p>

                @enderror

            </div>

            <div>

                <label class="label">

                    Department Code

                </label>

                <input
                    type="text"
                    name="department_code"
                    class="input"
                    value="{{ old('department_code') }}"
                    placeholder="SWE">

                @error('department_code')

                    <p class="text-red-400 text-sm mt-2">

                        {{ $message }}

                    </p>

                @enderror

            </div>

            <div class="flex gap-3">

                <button
                    type="submit"
                    class="btn btn-primary loading-btn">

                    Save Department

                </button>

                <a
                    href="{{ route('departments.index') }}"
                    class="btn btn-danger">

                    Cancel

                </a>

            </div>

        </form>

    </div>

</div>

@endsection