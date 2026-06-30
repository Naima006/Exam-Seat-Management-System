@extends('layouts.app')

@section('title','Edit Invigilator')

@section('content')

<div class="max-w-5xl mx-auto">

    <div class="card p-8">

        <div class="mb-8">

            <h1 class="text-3xl font-bold">

                Edit Invigilator

            </h1>

            <p class="text-slate-400 mt-2">

                Update invigilator information.

            </p>

        </div>

        <form
            action="{{ route('invigilators.update',$invigilator) }}"
            method="POST">

            @csrf

            @method('PUT')

            @include('invigilators._form')

        </form>

    </div>

</div>

@endsection