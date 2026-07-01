<!DOCTYPE html>
<html>

<head>

<meta charset="utf-8">

<title>Seating Plan</title>

<style>

@page{

    margin:25px;

}

body{

    font-family:DejaVu Sans,sans-serif;
    font-size:11px;
    color:#222;

}

h1{

    text-align:center;
    margin-bottom:4px;

}

h2{

    text-align:center;
    font-size:15px;
    margin-top:0;

}

.info{

    margin-bottom:20px;

}

table{

    width:100%;
    border-collapse:collapse;
    margin-bottom:25px;

}

th{

    background:#e5e7eb;
    border:1px solid #444;
    padding:7px;

}

td{

    border:1px solid #555;
    padding:6px;

}

.room-title{

    background:#111827;
    color:white;
    padding:8px;
    font-weight:bold;
    margin-top:18px;

}

.summary{

    margin-top:20px;

}

.signature{

    margin-top:60px;
    width:100%;

}

.signature td{

    border:none;
    text-align:center;

}


.footer{

    position:fixed;
    bottom:-10px;
    left:0;
    right:0;
    text-align:center;
    font-size:10px;

}

</style>

</head>

<body>

<h1>EXAM SEAT MANAGEMENT SYSTEM</h1>

<h2>SEATING PLAN REPORT</h2>

<div class="info">

<b>Exam Date :</b> {{ \Carbon\Carbon::parse($examDate)->format('d M Y') }}

<br>

<b>Start Time :</b> {{ \Carbon\Carbon::parse($startTime)->format('h:i A') }}

<br>

<b>Generated :</b> {{ $generatedAt->format('d M Y h:i A') }}

</div>

@foreach($rooms as $roomNo=>$students)

<div class="room-title">

Room {{ $roomNo }}

—

Invigilator :

{{ optional($students->first()->invigilator)->name }}

</div>

<table>

<thead>

<tr>

<th>Seat</th>

<th>Student ID</th>

<th>Student Name</th>

<th>Department</th>

<th>Course</th>

<th>Row</th>

<th>Column</th>

</tr>

</thead>

<tbody>

@foreach($students as $allocation)

<tr>

<td>{{ $allocation->seat_number }}</td>

<td>{{ $allocation->student->student_id }}</td>

<td>{{ $allocation->student->student_name }}</td>

<td>{{ $allocation->student->department->department_name }}</td>

<td>{{ $allocation->exam->course->course_name }}</td>

<td>{{ $allocation->row_no }}</td>

<td>{{ $allocation->column_no }}</td>

</tr>

@endforeach

</tbody>

</table>

@endforeach

<h3>Summary</h3>

<table>

<tr>

<td>Total Students</td>

<td>{{ $totalStudents }}</td>

</tr>

<tr>

<td>Rooms Used</td>

<td>{{ $totalRooms }}</td>

</tr>

<tr>

<td>Invigilators</td>

<td>{{ $totalInvigilators }}</td>

</tr>

<tr>

<td>Courses</td>

<td>{{ $totalCourses }}</td>

</tr>

</table>

<table class="signature">

<tr>

<td>

_________________________

<br>

Controller of Examinations

</td>

<td>

_________________________

<br>

Chief Invigilator

</td>

</tr>

</table>

<div class="footer">

Exam Seat Management System

</div>

</body>

</html>
<script type="text/php">
if (isset($pdf)) {

    $pdf->page_text(
        730,
        560,
        "Page {PAGE_NUM} of {PAGE_COUNT}",
        null,
        10,
        array(0,0,0)
    );

}
</script>