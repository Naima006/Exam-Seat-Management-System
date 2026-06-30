<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImportStudentRequest extends FormRequest
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

            'csv_file' => [
                'required',
                'file',
                'mimes:csv,txt',
                'max:2048', // 2MB
            ],

        ];
    }

    /**
     * Custom messages.
     */
    public function messages(): array
    {
        return [

            'csv_file.required' => 'Please choose a CSV file.',

            'csv_file.mimes' => 'Only CSV files are allowed.',

            'csv_file.max' => 'CSV file size must not exceed 2MB.',

        ];
    }
}