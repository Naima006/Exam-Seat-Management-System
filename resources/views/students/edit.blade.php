@extends('layouts.app')

@section('title', 'Edit Student')

@section('content')

<div class="max-w-5xl mx-auto space-y-6">

    {{-- Header --}}
    <div class="card p-6">

        <div class="flex items-center justify-between">

            <div>

                <h1 class="text-3xl font-bold">
                    Edit Student
                </h1>

                <p class="text-slate-400 mt-2">
                    Update student information.
                </p>

            </div>

            <a href="{{ route('students.index') }}"
               class="btn btn-outline">

                Back

            </a>

        </div>

    </div>

    {{-- Form --}}
    <div class="card p-6">

        <form
            method="POST"
            action="{{ route('students.update', $student) }}">

            @csrf
            @method('PUT')

            @include('students._form')

            <div class="mt-8 flex justify-end gap-3">

                <a href="{{ route('students.index') }}"
                   class="btn btn-outline">

                    Cancel

                </a>

                <button
                    type="submit"
                    class="btn btn-primary loading-btn">

                    Update Student

                </button>

            </div>

        </form>

    </div>

</div>

@endsection