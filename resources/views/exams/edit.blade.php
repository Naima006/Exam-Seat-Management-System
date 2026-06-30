@extends('layouts.app')

@section('title','Edit Exam')

@section('content')

<div class="max-w-5xl mx-auto">

    <div class="card p-8">

        <h1 class="text-3xl font-bold mb-8">

            Edit Examination

        </h1>

        <form
            method="POST"
            action="{{ route('exams.update',$exam) }}">

            @csrf
            @method('PUT')

            @include('exams._form',[

                'button'=>'Update Exam'

            ])

        </form>

    </div>

</div>

@endsection