@extends('layouts.app')

@section('title','Reports')

@section('content')

<div class="space-y-6">

    {{-- ========================= --}}
    {{-- Header --}}
    {{-- ========================= --}}
    <div class="card p-6">

        <div class="flex flex-col lg:flex-row justify-between items-center gap-5">

            <div>

                <h1 class="text-3xl font-bold">

                    Reports Dashboard

                </h1>

                <p class="text-slate-400 mt-2">

                    Generate, preview and export professional examination reports.

                </p>

            </div>

            <a href="{{ route('reports.summary') }}"
               class="btn btn-primary">

                View Summary

            </a>

        </div>

    </div>

    {{-- ========================= --}}
{{-- Statistics --}}
{{-- ========================= --}}

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-6">

    {{-- Students --}}
    <div class="card stat-card">

        <p class="stat-title">
            Students
        </p>

        <h2 class="stat-value">
            {{ $students }}
        </h2>

    </div>

    {{-- Departments --}}
    <div class="card stat-card">

        <p class="stat-title">
            Departments
        </p>

        <h2 class="stat-value">
            {{ $departments }}
        </h2>

    </div>

    {{-- Courses --}}
    <div class="card stat-card">

        <p class="stat-title">
            Courses
        </p>

        <h2 class="stat-value">
            {{ $courses }}
        </h2>

    </div>

    {{-- Rooms --}}
    <div class="card stat-card">

        <p class="stat-title">
            Rooms
        </p>

        <h2 class="stat-value">
            {{ $rooms }}
        </h2>

    </div>

    {{-- Invigilators --}}
    <div class="card stat-card">

        <p class="stat-title">
            Invigilators
        </p>

        <h2 class="stat-value">
            {{ $invigilators }}
        </h2>

    </div>

    {{-- Exams --}}
    <div class="card stat-card">

        <p class="stat-title">
            Exams
        </p>

        <h2 class="stat-value">
            {{ $exams }}
        </h2>

    </div>

</div>

    {{-- ========================= --}}
    {{-- Reports --}}
    {{-- ========================= --}}

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

        {{-- Student Report --}}
        <div class="card p-6 hover:scale-[1.02] duration-300">

            <div class="flex justify-between">

                <h2 class="font-bold text-xl">

                    Student Report

                </h2>

                🎓

            </div>

            <p class="text-slate-400 mt-3">

                Student list with department information.

            </p>

            <div class="flex gap-3 mt-6">

                <a href="{{ route('reports.students') }}"
                   class="btn btn-primary flex-1">

                    View

                </a>

                <a href="{{ route('reports.students.pdf') }}"
                   class="btn btn-success">

                    PDF

                </a>

            </div>

        </div>

        {{-- Department --}}
        <div class="card p-6 hover:scale-[1.02] duration-300">

            <div class="flex justify-between">

                <h2 class="font-bold text-xl">

                    Department Report

                </h2>

                🏢

            </div>

            <p class="text-slate-400 mt-3">

                Department details.

            </p>

            <div class="flex gap-3 mt-6">

                <a href="{{ route('reports.departments') }}"
                   class="btn btn-primary flex-1">

                    View

                </a>

                <a href="{{ route('reports.departments.pdf') }}"
                   class="btn btn-success">

                    PDF

                </a>

            </div>

        </div>

        {{-- Course --}}
        <div class="card p-6 hover:scale-[1.02] duration-300">

            <div class="flex justify-between">

                <h2 class="font-bold text-xl">

                    Course Report

                </h2>

                📘

            </div>

            <p class="text-slate-400 mt-3">

                Course information.

            </p>

            <div class="flex gap-3 mt-6">

                <a href="{{ route('reports.courses') }}"
                   class="btn btn-primary flex-1">

                    View

                </a>

                <a href="{{ route('reports.courses.pdf') }}"
                   class="btn btn-success">

                    PDF

                </a>

            </div>

        </div>

        {{-- Room --}}
        <div class="card p-6 hover:scale-[1.02] duration-300">

            <div class="flex justify-between">

                <h2 class="font-bold text-xl">

                    Room Report

                </h2>

                🏫

            </div>

            <p class="text-slate-400 mt-3">

                Capacity and room status.

            </p>

            <div class="flex gap-3 mt-6">

                <a href="{{ route('reports.rooms') }}"
                   class="btn btn-primary flex-1">

                    View

                </a>

                <a href="{{ route('reports.rooms.pdf') }}"
                   class="btn btn-success">

                    PDF

                </a>

            </div>

        </div>

        {{-- Invigilators --}}
        <div class="card p-6 hover:scale-[1.02] duration-300">

            <div class="flex justify-between">

                <h2 class="font-bold text-xl">

                    Invigilator Report

                </h2>

                👨‍🏫

            </div>

            <p class="text-slate-400 mt-3">

                Invigilator details.

            </p>

            <div class="flex gap-3 mt-6">

                <a href="{{ route('reports.invigilators') }}"
                   class="btn btn-primary flex-1">

                    View

                </a>

                <a href="{{ route('reports.invigilators.pdf') }}"
                   class="btn btn-success">

                    PDF

                </a>

            </div>

        </div>

        {{-- Exams --}}
        <div class="card p-6 hover:scale-[1.02] duration-300">

            <div class="flex justify-between">

                <h2 class="font-bold text-xl">

                    Exam Report

                </h2>

                📝

            </div>

            <p class="text-slate-400 mt-3">

                Complete examination schedule.

            </p>

            <div class="flex gap-3 mt-6">

                <a href="{{ route('reports.exams') }}"
                   class="btn btn-primary flex-1">

                    View

                </a>

                <a href="{{ route('reports.exams.pdf') }}"
                   class="btn btn-success">

                    PDF

                </a>

            </div>

        </div>

    </div>

</div>

@endsection