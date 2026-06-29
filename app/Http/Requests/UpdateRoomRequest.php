<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class UpdateRoomRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $room = $this->route('room');

        return [

            'room_no' => [
                'required',
                'string',
                'max:50',
                'unique:rooms,room_no,' . $room->id,
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