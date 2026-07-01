<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeatAllocation extends Model
{
    protected $fillable = [

        'exam_id',

        'student_id',

        'room_id',

        'invigilator_id',

        'seat_number',

        'row_no',

        'column_no',

    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /**
     * Student
     */
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * Exam
     */
    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    /**
     * Room
     */
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    /**
     * Invigilator
     */
    public function invigilator()
    {
        return $this->belongsTo(Invigilator::class);
    }
}