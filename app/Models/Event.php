<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class Event extends Model
{

    // protected $fillable = [
    // 'event_name',
    // 'rally_id',
    // 'driver1_name',
    // 'driver2_name',
    // 'class', 
    // 'car',
    // 'start_time', 
    // 'completed', 
    // 'total_time', 
    // 'total_time_driver2'
    // ];

    protected $fillable = [
    'event_name', 
    'rally_id',
    'driver1_name', 
    'driver1_class', 
    'driver1_car',
    'driver2_name', 
    'driver2_class', 
    'driver2_car',
    'start_time', 
    'completed', 
    'total_time', 
    'total_time_driver2'
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

    // Vanha yhden pelaajan ajan kutsuminen
    // public function getFormattedTotalTimeAttribute(): ?string
    // {
    //     if (!$this->total_time) return null;

    //     // Muoto tietokannassa: "HH:MM:SS.mmm" tai "00:MM:SS.mmm"
    //     $parts = explode(':', $this->total_time);
    //     if (count($parts) !== 3) return $this->total_time;

    //     [$h, $m, $rest] = $parts;
    //     [$s, $ms] = array_pad(explode('.', $rest), 2, '000');

    //     $totalMinutes = ((int)$h * 60) + (int)$m;
    //     return sprintf("%d'%02d\"%03d", $totalMinutes, $s, str_pad($ms, 3, '0'));
    // }

    public function getFormattedTotalTimeAttribute(): ?string
    {
    return $this->formatTimeString($this->total_time);
    }

    public function getFormattedTotalTimeDriver2Attribute(): ?string
    {
    return $this->formatTimeString($this->total_time_driver2);
    }

    private function formatTimeString(?string $time): ?string
    {
    if (!$time) return null;
    $parts = explode(':', $time);
    if (count($parts) !== 3) return $time;
    [$h, $m, $rest] = $parts;
    [$s, $ms] = array_pad(explode('.', $rest), 2, '000');
    $totalMinutes = ((int)$h * 60) + (int)$m;
    return sprintf("%d'%02d\"%03d", $totalMinutes, $s, str_pad($ms, 3, '0'));
    }   

}