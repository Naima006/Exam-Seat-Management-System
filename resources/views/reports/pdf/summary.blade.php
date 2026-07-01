@extends('reports.pdf.layout')

@section('title','System Summary')

@section('report_title')

System Summary Report

@endsection

@section('content')

<table class="report">

<thead>

<tr>

<th>Module</th>

<th>Total Records</th>

</tr>

</thead>

<tbody>

<tr>

<td>Students</td>

<td>{{ $students }}</td>

</tr>

<tr>

<td>Departments</td>

<td>{{ $departments }}</td>

</tr>

<tr>

<td>Courses</td>

<td>{{ $courses }}</td>

</tr>

<tr>

<td>Rooms</td>

<td>{{ $rooms }}</td>

</tr>

<tr>

<td>Invigilators</td>

<td>{{ $invigilators }}</td>

</tr>

<tr>

<td>Exams</td>

<td>{{ $exams }}</td>

</tr>

<tr>

<td>Room Capacity</td>

<td>{{ $roomCapacity }}</td>

</tr>

<tr>

<td>Active Rooms</td>

<td>{{ $activeRooms }}</td>

</tr>

<tr>

<td>Inactive Rooms</td>

<td>{{ $inactiveRooms }}</td>

</tr>

</tbody>

</table>

@endsection