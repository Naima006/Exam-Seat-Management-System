@extends('layouts.app')

@section('title', 'Add Student')

@section('content')

<div class="space-y-6">

    {{-- Header --}}
    <div class="card p-6">

        <div class="flex items-center justify-between">

            <div>

                <h1 class="text-3xl font-bold">
                    Add Student
                </h1>

                <p class="text-slate-400 mt-2">
                    Register a new student for examination seat allocation.
                </p>

            </div>

            <a
                href="{{ route('students.index') }}"
                class="btn btn-outline">

                Back

            </a>

        </div>

    </div>

    {{-- Form --}}
    <div class="card p-6">

        <form
            method="POST"
            action="{{ route('students.store') }}">

            @csrf

            @include('students._form')

        </form>

    </div>

</div>

@endsection