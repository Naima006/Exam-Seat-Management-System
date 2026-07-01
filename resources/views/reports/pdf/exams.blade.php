@extends('reports.pdf.layout')

@section('title','Exam Report')

@section('report_title')

Exam Schedule Report

@endsection

@section('content')

<table class="report">

<thead>

<tr>

<th>#</th>

<th>Course</th>

<th>Date</th>

<th>Time</th>

</tr>

</thead>

<tbody>

@foreach($exams as $exam)

<tr>

<td>{{ $loop->iteration }}</td>

<td>{{ $exam->course->course_name }}</td>

<td>{{ $exam->exam_date }}</td>

<td>{{ $exam->start_time }} - {{ $exam->end_time }}</td>

</tr>

@endforeach

</tbody>

</table>

@endsection