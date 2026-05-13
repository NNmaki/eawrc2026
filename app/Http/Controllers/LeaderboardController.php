<?php

namespace App\Http\Controllers;

use App\Models\Stage;
use App\Models\StageTime;
use App\Models\Rally;

class LeaderboardController extends Controller
{
    // Kaikki staget listattuna — valintasivu
    public function index()
    {
        $rallies = Rally::with('stages')->orderBy('rally_name')->get();
        return view('leaderboard.index', compact('rallies'));
    }

    // Yhden stagen tulokset
    public function stage(Stage $stage)
    {
        $times = StageTime::where('stage_id', $stage->id)
            ->join('events', 'stage_times.event_id', '=', 'events.id')
            ->select(
                'stage_times.id',
                'stage_times.time_result',
                'stage_times.time_ms',
                'stage_times.driver_number',
                'stage_times.recorded_at',
                'events.event_name',
                // Haetaan oikea kuljettajan nimi driver_numberin mukaan
                \DB::raw("
                    CASE
                        WHEN stage_times.driver_number = 1 THEN events.driver1_name
                        ELSE events.driver2_name
                    END AS driver_name
                "),
                \DB::raw("
                    CASE
                        WHEN stage_times.driver_number = 1 THEN events.driver1_car
                        ELSE events.driver2_car
                    END AS car
                "),
                \DB::raw("
                    CASE
                        WHEN stage_times.driver_number = 1 THEN events.driver1_class
                        ELSE events.driver2_class
                    END AS class
                ")
            )
            ->orderBy('stage_times.time_ms', 'asc')
            ->get()
            ->map(function ($row, $index) {
                $row->position = $index + 1;

                // Gap laskenta — ero kärkeen millisekunteina
                $row->gap_ms = $index === 0 ? 0 : null; // täytetään alla
                return $row;
            });

        // Lasketaan gap kärkeen
        $leaderMs = $times->first()?->time_ms ?? 0;
        $times = $times->map(function ($row) use ($leaderMs) {
            $row->gap_ms = $row->time_ms - $leaderMs;
            return $row;
        });

        return view('leaderboard.stage', compact('stage', 'times'));
    }
}