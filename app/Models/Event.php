<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class Event extends Model
{
    protected $fillable = [
        'event_name',
        'rally_id', 
        'driver_name', 
        'class', 'car',
        'start_time', 
        'completed', 
        'total_time'
    ];

    protected $casts = [
    'start_time' => 'datetime',
    'completed'  => 'boolean',
    ];

    public function rally() {
        return $this->belongsTo(Rally::class);
    }

    public function stageTimes() {
        return $this->hasMany(StageTime::class);
    }

    // app/Models/Event.php
    public function getFormattedTotalTimeAttribute(): ?string
    {
        if (!$this->total_time) return null;

        // Muoto tietokannassa: "HH:MM:SS.mmm" tai "00:MM:SS.mmm"
        $parts = explode(':', $this->total_time);
        if (count($parts) !== 3) return $this->total_time;

        [$h, $m, $rest] = $parts;
        [$s, $ms] = array_pad(explode('.', $rest), 2, '000');

        $totalMinutes = ((int)$h * 60) + (int)$m;
        return sprintf("%d'%02d\"%03d", $totalMinutes, $s, str_pad($ms, 3, '0'));
}
}