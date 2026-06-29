@extends('layouts.app')

@section('title', 'Add Room')

@section('content')

<div class="space-y-6">

    {{-- Page Header --}}
    <div class="card p-6">

        <div class="flex justify-between items-center">

            <div>

                <h1 class="text-3xl font-bold">

                    Add Examination Room

                </h1>

                <p class="text-slate-400 mt-2">

                    Create a new room for examination seating.

                </p>

            </div>

            <a href="{{ route('rooms.index') }}"
               class="btn btn-outline">

                ← Back

            </a>

        </div>

    </div>

    {{-- Form --}}
    <div class="card p-6">

        @if ($errors->any())

            <div class="mb-6 rounded-xl bg-red-500/10 border border-red-500/30 p-4">

                <h4 class="font-semibold text-red-400 mb-2">

                    Please correct the following errors:

                </h4>

                <ul class="list-disc list-inside text-red-300">

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        <form
            action="{{ route('rooms.store') }}"
            method="POST">

            @csrf

            @include('rooms._form')

        </form>

    </div>

</div>

@endsection