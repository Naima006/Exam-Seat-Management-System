<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCourseRequest extends FormRequest
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

            'department_id' => [
                'required',
                'exists:departments,id',
            ],

            'course_name' => [
                'required',
                'string',
                'max:150',
            ],

            'course_code' => [
                'required',
                'string',
                'max:20',
                'unique:courses,course_code,' . $this->route('course')->id,
            ],

            'semester' => [
                'required',
                'integer',
                'between:1,12',
            ],

        ];
    }
}