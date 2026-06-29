@extends('layouts.app')

@section('title', 'Edit Room')

@section('content')

<div class="space-y-6">

    {{-- Header --}}
    <div class="card p-6">

        <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4">

            <div>

                <h1 class="text-3xl font-bold">

                    Edit Room

                </h1>

                <p class="text-slate-400 mt-2">

                    Update examination room information.

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

            <div class="mb-6 rounded-xl border border-red-500/30 bg-red-500/10 p-4">

                <h4 class="font-semibold text-red-400 mb-2">

                    Please correct the following errors

                </h4>

                <ul class="list-disc list-inside text-red-300">

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        <form action="{{ route('rooms.update',$room) }}"
              method="POST">

            @csrf
            @method('PUT')

            @include('rooms._form')

        </form>

    </div>

</div>

@endsection