<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExamRequest;
use App\Http\Requests\UpdateExamRequest;
use App\Models\Course;
use App\Models\Exam;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function index(Request $request)
{
    $search = $request->search;

    $exams = Exam::with('course')

        ->when($search,function($query) use($search){

            $query->whereHas('course',function($q) use($search){

                $q->where('course_name','like',"%$search%");

            });

        })

        ->latest()

        ->paginate(10);

    $totalExams = Exam::count();

    $todayExams = Exam::whereDate('exam_date',today())->count();

    $upcomingExams = Exam::whereDate('exam_date','>',today())->count();

    $courseCount = Course::count();

    return view('exams.index',compact(

        'exams',

        'totalExams',

        'todayExams',

        'upcomingExams',

        'courseCount'

    ));
}

    public function create()
    {
        $courses = Course::orderBy('course_name')->get();

        return view('exams.create', compact('courses'));
    }

    public function store(StoreExamRequest $request)
    {
        Exam::create($request->validated());

        return redirect()

            ->route('exams.index')

            ->with('success', 'Exam created successfully.');
    }

    public function show(Exam $exam)
    {
        $exam->load('course');

        return view('exams.show', compact('exam'));
    }

    public function edit(Exam $exam)
    {
        $courses = Course::orderBy('course_name')->get();

        return view('exams.edit', compact(

            'exam',

            'courses'

        ));
    }

    public function update(UpdateExamRequest $request, Exam $exam)
    {
        $exam->update($request->validated());

        return redirect()

            ->route('exams.index')

            ->with('success', 'Exam updated successfully.');
    }

    public function destroy(Exam $exam)
    {
        $exam->delete();

        return redirect()

            ->route('exams.index')

            ->with('success', 'Exam deleted successfully.');
    }
}