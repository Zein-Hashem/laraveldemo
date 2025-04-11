<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Driver;
use App\Models\Vehicle;

class Mission extends Model{
    protected $fillable = [
        'driver_id',
        'vehicle_id',
        'address',
        'description',
        'estimated_time',
        'final_time',
    ];

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}


