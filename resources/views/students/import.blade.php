@extends('layouts.app')

@section('title', 'Import Students')

@section('content')

<div class="space-y-6">

    {{-- Header --}}
    <div class="card p-6">

        <div class="flex justify-between items-center">

            <div>

                <h1 class="text-3xl font-bold">
                    Import Students
                </h1>

                <p class="text-slate-400 mt-2">
                    Upload a CSV file to import multiple students at once.
                </p>

            </div>

            <a
                href="{{ route('students.index') }}"
                class="btn btn-outline">

                Back

            </a>

        </div>

    </div>

    {{-- Success --}}
    @if(session('success'))

        <div class="card p-4 border border-green-500/30 bg-green-500/10 text-green-300">

            {{ session('success') }}

        </div>

    @endif

    {{-- Errors --}}
    @if($errors->any())

        <div class="card p-4 border border-red-500/30 bg-red-500/10">

            <ul class="list-disc ml-6 text-red-300">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    {{-- Upload Form --}}
    <div class="card p-6">

        <form
            action="{{ route('students.import') }}"
            method="POST"
            enctype="multipart/form-data">

            @csrf

            <div>

                <label class="block mb-2 font-medium">
                    CSV File
                </label>

                <input
                    type="file"
                    name="csv_file"
                    accept=".csv"
                    class="input w-full"
                    required>

            </div>

            <div class="mt-6 flex gap-4">

                <button
                    type="submit"
                    class="btn btn-primary">

                    Import CSV

                </button>

            </div>

        </form>

    </div>

    {{-- Sample Format --}}
    <div class="card p-6">

        <h2 class="text-xl font-bold mb-4">
            Required CSV Format
        </h2>

<pre class="text-sm text-slate-300 overflow-x-auto">
student_id,student_name,department_name,course_name,batch
221-15-1234,John Doe,Software Engineering,Structured Programming,61
</pre>

        <p class="text-slate-400 mt-4">

            <strong>Note:</strong>
                Department name and Course name must exactly match existing records in the database.

        </p>

    </div>

</div>

@endsection