@extends('layouts.app')

@section('title','Add Exam')

@section('content')

<div class="max-w-5xl mx-auto">

    <div class="card p-8">

        <h1 class="text-3xl font-bold mb-8">

            Add Examination

        </h1>

        <form
            method="POST"
            action="{{ route('exams.store') }}">

            @include('exams._form',[

                'button'=>'Create Exam'

            ])

        </form>

    </div>

</div>

@endsection