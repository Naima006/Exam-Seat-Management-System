<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validation rules.
     */
    public function rules(): array
    {
        return [

            'student_id' => [
                'required',
                'string',
                'max:50',
                Rule::unique('students', 'student_id')->ignore($this->student),
            ],

            'student_name' => [
                'required',
                'string',
                'max:255',
            ],

            'department_id' => [
                'required',
                'exists:departments,id',
            ],

            'course_id' => [
                'required',
                'exists:courses,id',
            ],

            'batch' => [
                'required',
                'integer',
                'min:1',
            ],

        ];
    }
}