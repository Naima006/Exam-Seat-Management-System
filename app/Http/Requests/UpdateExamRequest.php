<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateExamRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'course_id' => [
                'required',
                'exists:courses,id'
            ],

            'exam_date' => [
                'required',
                'date'
            ],

            'start_time' => [
                'required'
            ],

            'end_time' => [
                'required',
                'after:start_time'
            ],

        ];
    }

    public function messages()
    {
        return [

            'course_id.required' => 'Please select a course.',

            'course_id.exists' => 'Selected course is invalid.',

            'end_time.after' => 'End time must be after start time.'

        ];
    }
}