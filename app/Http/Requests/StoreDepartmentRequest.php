<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDepartmentRequest extends FormRequest
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

                'unique:departments,department_code',

            ],

        ];
    }
}