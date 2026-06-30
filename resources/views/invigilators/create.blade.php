@extends('layouts.app')

@section('title','Add Invigilator')

@section('content')

<div class="max-w-5xl mx-auto">

    <div class="card p-8">

        <div class="mb-8">

            <h1 class="text-3xl font-bold">

                Add New Invigilator

            </h1>

            <p class="text-slate-400 mt-2">

                Enter invigilator information below.

            </p>

        </div>

        <form
            action="{{ route('invigilators.store') }}"
            method="POST">

            @include('invigilators._form')

        </form>

    </div>

</div>

@endsection