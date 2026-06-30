<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateInvigilatorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'name' => 'required|string|max:255',

            'email' => [

                'required',

                'email',

                Rule::unique('invigilators')
                    ->ignore($this->invigilator),

            ],

            'phone' => 'required|string|max:20',

            'department_id' => 'required|exists:departments,id',

        ];
    }
}