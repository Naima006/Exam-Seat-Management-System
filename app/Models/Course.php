<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [

        'department_id',

        'course_name',

        'course_code',

        'semester',

    ];

    /**
     * A course belongs to one department.
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function exams()
{
    return $this->hasMany(Exam::class);
}
}