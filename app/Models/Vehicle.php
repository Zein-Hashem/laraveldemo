<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Mission;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function missions()
    {
        return $this->hasMany(Mission::class);
    }
}
