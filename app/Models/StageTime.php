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
        'time_ms',
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

    // Kutsutaan ennen tallennusta automaattisesti
    protected static function booted(): void
    {
        static::saving(function (StageTime $stageTime) {
            if ($stageTime->time_result) {
                $stageTime->time_ms = self::convertToMs($stageTime->time_result);
            }
        });
    }

    public static function convertToMs(string $timeStr): int
    {
        // "HH:MM:SS.mmm" → millisekunteja
        [$h, $m, $rest] = explode(':', $timeStr);
        [$s, $ms] = explode('.', $rest);
        
        return ((int)$h * 3600000)
            + ((int)$m * 60000)
            + ((int)$s * 1000)
            + (int)str_pad($ms, 3, '0');
    }


}