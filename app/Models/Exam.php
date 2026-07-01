<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $fillable = [

        'course_id',

        'exam_date',

        'start_time',

        'end_time'

    ];

    protected $casts = [

        'exam_date' => 'date',

    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Seat Allocations
     */
    public function seatAllocations()
    {
        return $this->hasMany(SeatAllocation::class);
    }
}