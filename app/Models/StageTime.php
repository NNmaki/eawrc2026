<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StageTime extends Model
{
    protected $fillable = [
        'event_id',
        'stage_id',
        'driver_number',
        'time_result',
        'recorded_at',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }
}