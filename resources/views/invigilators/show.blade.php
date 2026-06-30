@extends('layouts.app')

@section('title', 'Invigilator Details')

@section('content')

<div class="max-w-5xl mx-auto space-y-6">

    {{-- Header --}}
    <div class="card p-6">

        <div class="flex justify-between items-center">

            <div>

                <h1 class="text-3xl font-bold">

                    Invigilator Details

                </h1>

                <p class="text-slate-400 mt-2">

                    View complete information about the invigilator.

                </p>

            </div>

            <a href="{{ route('invigilators.index') }}"
               class="btn btn-outline">

                ← Back

            </a>

        </div>

    </div>

    {{-- Profile Card --}}
    <div class="card p-8">

        <div class="flex flex-col lg:flex-row items-start gap-8">

            {{-- Details --}}
            <div class="flex-1 w-full">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>

                        <label class="text-slate-400 text-sm">

                            Full Name

                        </label>

                        <h3 class="text-xl font-semibold mt-1">

                            {{ $invigilator->name }}

                        </h3>

                    </div>

                    <div>

                        <label class="text-slate-400 text-sm">

                            Department

                        </label>

                        <h3 class="text-xl font-semibold mt-1">

                            {{ $invigilator->department->department_name }}

                        </h3>

                    </div>

                    <div>

                        <label class="text-slate-400 text-sm">

                            Email

                        </label>

                        <h3 class="text-lg mt-1">

                            {{ $invigilator->email }}

                        </h3>

                    </div>

                    <div>

                        <label class="text-slate-400 text-sm">

                            Phone

                        </label>

                        <h3 class="text-lg mt-1">

                            {{ $invigilator->phone }}

                        </h3>

                    </div>

                    <div>

                        <label class="text-slate-400 text-sm">

                            Created

                        </label>

                        <h3 class="text-lg mt-1">

                            {{ $invigilator->created_at->format('d M Y') }}

                        </h3>

                    </div>

                    <div>

                        <label class="text-slate-400 text-sm">

                            Last Updated

                        </label>

                        <h3 class="text-lg mt-1">

                            {{ $invigilator->updated_at->format('d M Y') }}

                        </h3>

                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- Actions --}}
    <div class="card p-6">

        <div class="flex justify-end gap-3">

            <a href="{{ route('invigilators.edit',$invigilator) }}"
               class="btn btn-primary">

                Edit

            </a>

            <a href="{{ route('invigilators.index') }}"
               class="btn btn-outline">

                Back to List

            </a>

        </div>

    </div>

</div>

@endsection