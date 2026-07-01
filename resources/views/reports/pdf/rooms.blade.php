@extends('reports.pdf.layout')

@section('title','Room Report')

@section('report_title')

Room Report

@endsection

@section('content')

<table class="report">

<thead>

<tr>

<th>#</th>

<th>Room</th>

<th>Building </th>

<th>Capacity</th>

<th>Status</th>

</tr>

</thead>

<tbody>

@foreach($rooms as $room)

<tr>

<td>{{ $loop->iteration }}</td>

<td>{{ $room->room_no }}</td>

<td>{{ $room->building }}</td>

<td>{{ $room->capacity }}</td>

<td>{{ $room->status }}</td>

</tr>

@endforeach

</tbody>

</table>

@endsection