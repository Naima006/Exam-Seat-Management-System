<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invigilator extends Model
{
    protected $fillable = [

        'name',

        'email',

        'phone',

        'department_id',

    ];

    /**
     * Department Relationship
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * Dashboard Statistics
     */
    public static function statistics()
    {
        return [

            'totalInvigilators' => self::count(),

            'totalDepartments' => Department::count(),

        ];
    }
}