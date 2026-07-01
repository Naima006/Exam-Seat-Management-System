@extends('reports.pdf.layout')

@section('title','Invigilator Report')

@section('report_title')

Invigilator Report

@endsection

@section('content')

<table class="report">

<thead>

<tr>

<th>#</th>

<th>Name</th>

<th>Email</th>

<th>Phone</th>

<th>Department</th>

</tr>

</thead>

<tbody>

@foreach($invigilators as $invigilator)

<tr>

<td>{{ $loop->iteration }}</td>

<td>{{ $invigilator->name }}</td>

<td>{{ $invigilator->email }}</td>

<td>{{ $invigilator->phone }}</td>

<td>{{ $invigilator->department->department_name ?? 'N/A' }}</td>

</tr>

@endforeach

</tbody>

</table>

@endsection