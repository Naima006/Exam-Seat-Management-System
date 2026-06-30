<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
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
                'unique:students,student_id',
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

            'semester' => [
                'required',
                'integer',
                'min:1',
                'max:12',
            ],

            'section' => [
                'required',
                'string',
                'max:10',
            ],

            'batch' => [
                'required',
                'integer',
                'min:1',
            ],

            'email' => [
                'nullable',
                'email',
                'max:255',
                'unique:students,email',
            ],

            'phone' => [
                'nullable',
                'string',
                'max:20',
            ],

            'status' => [
                'required',
                'in:Active,Inactive',
            ],

        ];
    }
}