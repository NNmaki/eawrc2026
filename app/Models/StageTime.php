<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'rally_id', 'driver_name', 'class', 'car',
        'start_time', 'completed', 'total_time'
    ];

    public function rally() {
        return $this->belongsTo(Rally::class);
    }

    public function stageTimes() {
        return $this->hasMany(StageTime::class);
    }
}