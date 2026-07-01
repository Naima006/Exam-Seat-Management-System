@extends('reports.pdf.layout')

@section('title','Department Report')

@section('report_title')

Department Report

@endsection

@section('content')

<table class="report">

<thead>

<tr>

<th>#</th>

<th>Department</th>

<th>Code</th>

<th>Total Students</th>

</tr>

</thead>

<tbody>

@foreach($departments as $department)

<tr>

<td>{{ $loop->iteration }}</td>

<td>{{ $department->department_name }}</td>

<td>{{ $department->department_code }}</td>

<td>{{ $department->students_count }}</td>

</tr>

@endforeach

</tbody>

</table>

@endsection