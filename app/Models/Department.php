<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [

        'department_name',

        'department_code',

    ];
    public function courses()
{
    return $this->hasMany(Course::class);
}

public function students()
{
    return $this->hasMany(Student::class);
}
}