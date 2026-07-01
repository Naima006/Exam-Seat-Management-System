<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [

        'student_id',
        'student_name',
        'department_id',
        'course_id',
        'batch',

    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

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