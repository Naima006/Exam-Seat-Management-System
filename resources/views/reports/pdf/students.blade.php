@extends('reports.pdf.layout')

@section('title','Student Report')

@section('report_title')

Student Report

@endsection

@section('content')

<table class="report">

<thead>

<tr>

<th>#</th>

<th>Student ID</th>

<th>Name</th>

<th>Department</th>

</tr>

</thead>

<tbody>

@foreach($students as $student)

<tr>

<td>{{ $loop->iteration }}</td>

<td>{{ $student->student_id }}</td>

<td>{{ $student->student_name }}</td>

<td>{{ $student->department->department_name ?? '-' }}</td>

</tr>

@endforeach

</tbody>

</table>

@endsection