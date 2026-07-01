<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [

        'room_no',

        'building',

        'capacity',

        'status',

    ];
    /**
     * Seat Allocations
     */
    public function seatAllocations()
    {
        return $this->hasMany(SeatAllocation::class);
    }
}