@extends('reports.pdf.layout')

@section('title','Course Report')

@section('report_title')

Course Report

@endsection

@section('content')

<table class="report">

<thead>

<tr>

<th>#</th>

<th>Course Code</th>

<th>Course Name</th>

<th>Department</th>

</tr>

</thead>

<tbody>

@foreach($courses as $course)

<tr>

<td>{{ $loop->iteration }}</td>

<td>{{ $course->course_code }}</td>

<td>{{ $course->course_name }}</td>

<td>{{ $course->department->department_name ?? 'N/A' }}</td>

</tr>

@endforeach

</tbody>

</table>

@endsection