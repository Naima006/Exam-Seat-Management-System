<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDepartmentRequest extends FormRequest
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

            'department_name' => [

                'required',

                'string',

                'max:100',

            ],

            'department_code' => [

                'required',

                'string',

                'max:20',

                Rule::unique('departments', 'department_code')
                    ->ignore($this->department),

            ],

        ];
    }

    /**
     * Custom validation messages.
     */
    public function messages(): array
    {
        return [

            'department_name.required' => 'Department name is required.',

            'department_code.required' => 'Department code is required.',

            'department_code.unique' => 'This department code already exists.',

        ];
    }
}