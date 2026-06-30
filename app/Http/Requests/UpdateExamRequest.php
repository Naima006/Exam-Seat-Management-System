<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Exam;

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
                'exists:courses,id',
            ],

            'exam_date' => [
                'required',
                'date',
            ],

            'start_time' => [
                'required',
            ],

            'end_time' => [
                'required',
                'after:start_time',
            ],

        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {

            $conflict = Exam::where('course_id', $this->course_id)
                ->where('exam_date', $this->exam_date)
                ->where('id', '!=', $this->exam->id)
                ->where(function ($query) {

                    $query->whereBetween('start_time', [
                        $this->start_time,
                        $this->end_time
                    ])

                    ->orWhereBetween('end_time', [
                        $this->start_time,
                        $this->end_time
                    ])

                    ->orWhere(function ($q) {

                        $q->where('start_time', '<=', $this->start_time)
                          ->where('end_time', '>=', $this->end_time);

                    });

                })
                ->exists();

            if ($conflict) {

                $validator->errors()->add(
                    'course_id',
                    'This course already has an exam scheduled during the selected time.'
                );

            }

        });
    }

    public function messages()
    {
        return [

            'course_id.required' => 'Please select a course.',

            'course_id.exists' => 'Selected course is invalid.',

            'end_time.after' => 'End time must be after start time.',

        ];
    }
}