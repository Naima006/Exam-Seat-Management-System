<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoomRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'room_no' => [
                'required',
                'string',
                'max:50',
                'unique:rooms,room_no',
            ],

            'building' => [
                'required',
                'string',
                'max:100',
            ],

            'capacity' => [
                'required',
                'integer',
                'min:1',
            ],

            'status' => [
                'required',
                'in:Active,Inactive',
            ],

        ];
    }
}