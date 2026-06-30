@extends('layouts.app')

@section('title','Exam Details')

@section('content')

<div class="max-w-5xl mx-auto">

    <div class="card overflow-hidden">

        {{-- Header --}}
        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-8 py-8">

            <h1 class="text-3xl font-bold">

                Examination Details

            </h1>

            <p class="text-blue-100 mt-2">

                {{ $exam->course->course_name }}

            </p>

        </div>

        {{-- Body --}}
        <div class="p-8">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                <div>

                    <h4 class="text-slate-400">

                        Course

                    </h4>

                    <p class="text-xl font-semibold mt-1">

                        {{ $exam->course->course_name }}

                    </p>

                </div>

                <div>

                    <h4 class="text-slate-400">

                        Exam Date

                    </h4>

                    <p class="text-xl font-semibold mt-1">

                        {{ \Carbon\Carbon::parse($exam->exam_date)->format('d F Y') }}

                    </p>

                </div>

                <div>

                    <h4 class="text-slate-400">

                        Start Time

                    </h4>

                    <p class="text-xl font-semibold mt-1">

                        {{ \Carbon\Carbon::parse($exam->start_time)->format('h:i A') }}

                    </p>

                </div>

                <div>

                    <h4 class="text-slate-400">

                        End Time

                    </h4>

                    <p class="text-xl font-semibold mt-1">

                        {{ \Carbon\Carbon::parse($exam->end_time)->format('h:i A') }}

                    </p>

                </div>

                <div>

                    <h4 class="text-slate-400">

                        Created

                    </h4>

                    <p class="text-xl font-semibold mt-1">

                        {{ $exam->created_at->format('d M Y') }}

                    </p>

                </div>

                <div>

                    <h4 class="text-slate-400">

                        Last Updated

                    </h4>

                    <p class="text-xl font-semibold mt-1">

                        {{ $exam->updated_at->format('d M Y') }}

                    </p>

                </div>

            </div>

            <div class="flex justify-end gap-3 mt-10">

                <a
                    href="{{ route('exams.edit',$exam) }}"
                    class="btn btn-primary">

                    Edit

                </a>

                <a
                    href="{{ route('exams.index') }}"
                    class="btn btn-outline">

                    Back

                </a>

            </div>

        </div>

    </div>

</div>

@endsection