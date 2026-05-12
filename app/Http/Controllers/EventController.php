<?php

namespace App\Http\Controllers;
use App\Models\Rally;
use App\Models\Event;
use App\Models\Stage;
use App\Models\StageTime;
use Illuminate\Http\Request;

class EventController extends Controller
{
    // Etusivu — välitetään rallyt dropdownia varten
   

    public function index()
{
    $rallies = Rally::orderBy('rally_name')->get();
    $events  = Event::with('rally')->latest('start_time')->get();
    $nextEventNumber = Event::count() + 1;
    return view('app', compact('rallies', 'events','nextEventNumber'));
}



    // AJAX: palauttaa staget kun rally valitaan
    public function getStages(Rally $rally)
    {
        $stages = $rally->stages()->orderBy('stage_number')->get();
        return response()->json($stages);
    }

    // Luo uusi event (popup-lomakkeen submit)
    public function store(Request $request)
    {
    $request->validate([
    'event_name'    => 'required|string|max:255',
    'driver1_name'  => 'required|string|max:255',
    'driver1_class' => 'required|in:WRC,WRC2,JUNIOR WRC',
    'driver1_car'   => 'required|string',
    'driver2_name'  => 'nullable|string|max:255',
    'driver2_class' => 'nullable|in:WRC,WRC2,JUNIOR WRC',
    'driver2_car'   => 'nullable|string',
    'rally_id'      => 'required|exists:rallies,id',
    ]);

    $event = Event::create([
        'event_name'    => $request->event_name,
        'driver1_name'  => $request->driver1_name,
        'driver1_class' => $request->driver1_class,
        'driver1_car'   => $request->driver1_car,
        'driver2_name'  => $request->driver2_name,
        'driver2_class' => $request->driver2_class,
        'driver2_car'   => $request->driver2_car,
        'rally_id'      => $request->rally_id,
        'start_time'    => now(),
        'completed'     => false,
    ]);
        return response()->json(['event_id' => $event->id]);
    }

    // Tallenna yhden stagen aika
    public function saveStageTime(Request $request, Event $event)
    {
        $request->validate([
            'stage_id'    => 'required|exists:stages,id',
            'minutes'     => 'required|digits_between:1,2',
            'seconds'     => 'required|digits:2',
            'milliseconds'=> 'required|digits:3',
        ]);

        // Muodosta TIME-arvo: 00:MM:SS.mmm
        $time = sprintf('00:%02d:%02d.%s',
            $request->minutes,
            $request->seconds,
            $request->milliseconds
        );

        // $stageTime = StageTime::updateOrCreate(
        //     [
        //         'event_id' => $event->id,
        //         'stage_id' => $request->stage_id,
        //     ],
        //     [
        //         'time_result' => $time,
        //         'recorded_at' => now(),
        //     ]
        // );
        // return response()->json(['success' => true, 'time' => $time]);

            // ...olemassa oleva koodi pysyy samana...

        $stageTime = StageTime::updateOrCreate(
            [
                'event_id' => $event->id,
                'stage_id' => $request->stage_id,
                'driver_number' => $request->driver_number,
            ],
            [
                'time_result' => $time,
                'recorded_at' => now(),
            ]
        );

        // Laske ja päivitä total_time aina kun aika tallennetaan
        $this->updateTotalTime($event);
        return response()->json(['success' => true, 'time' => $time]);
    }

    // // Hae eventin tiedot + stage-ajat JSON-vastauksena
    // public function show(Event $event)
    // {
    //     $event->load(['rally', 'stageTimes.stage']);
    //     return response()->json($event);
    // }

    public function show(Event $event)
{
    $event->load(['rally.stages', 'stageTimes.stage']);
    return response()->json($event);
}





    // Merkitse event päättyneeksi
    public function end(Event $event)
    {
        $this->updateTotalTime($event);
        $event->update(['completed' => true]);

        return response()->json([
            'success'         => true,
            'total_time'      => $event->fresh()->formatted_total_time ?? '—',
            'total_time_driver2' => $event->fresh()->formatted_total_time_driver2 ?? '—',
        ]);
    }



// public function end(Event $event)
// {
//     $totalTime = $this->updateTotalTime($event);

//     $event->update(['completed' => true]);

//     $hours   = (int) substr($totalTime, 0, 2);
//     $minutes = (int) substr($totalTime, 3, 2);
//     $seconds = (int) substr($totalTime, 6, 2);
//     $ms      = (int) substr($totalTime, 9, 3);

//     $displayTime = sprintf("%d'%02d\"%03d", ($hours * 60) + $minutes, $seconds, $ms);

//     return response()->json(['success' => true, 'total_time' => $displayTime]);
// }


// public function end(Event $event)
// {
//     $stageTimes = $event->stageTimes()->pluck('time_result');

//     $totalMs = $stageTimes->sum(function ($time) {
//         $parts = explode(':', $time);

//         if (count($parts) === 3) {
//             [$h, $m, $rest] = $parts;
//         } elseif (count($parts) === 2) {
//             $h = 0;
//             [$m, $rest] = $parts;
//         } else {
//             return 0;
//         }

//         // Käsittele sekunnit ja mahdolliset millisekunnit erikseen
//         $secParts = explode('.', $rest);
//         $s  = (int) $secParts[0];
//         $ms = isset($secParts[1]) ? (int) str_pad($secParts[1], 3, '0') : 0;

//         return ((int)$h * 3600000) + ((int)$m * 60000) + ($s * 1000) + $ms;
//     });

//     // Muunna millisekunnit HH:MM:SS.mmm muotoon MySQL TIME-saraketta varten
//     $hours   = floor($totalMs / 3600000);
//     $totalMs -= $hours * 3600000;
//     $minutes = floor($totalMs / 60000);
//     $totalMs -= $minutes * 60000;
//     $seconds = floor($totalMs / 1000);
//     $ms      = $totalMs - ($seconds * 1000);

//     // MySQL TIME muoto: HH:MM:SS.mmm
//     $totalTime = sprintf('%02d:%02d:%02d.%03d', $hours, $minutes, $seconds, $ms);

//     $event->update([
//         'completed'  => true,
//         'total_time' => $totalTime,
//     ]);

//     // Palautetaan näyttöystävällinen muoto frontendille
//     $displayTime = sprintf("%d'%02d\"%03d", ($hours * 60) + $minutes, $seconds, $ms);

//     return response()->json(['success' => true, 'total_time' => $displayTime]);
// }








    // public function end(Event $event)
    // {
    //     $event->update(['completed' => true]);
    //     return response()->json(['success' => true]);
    // }

private function updateTotalTime(Event $event): void
{
    $this->calculateAndSave($event, 1, 'total_time');
    $this->calculateAndSave($event, 2, 'total_time_driver2');
}

private function calculateAndSave(Event $event, int $driverNumber, string $column): void
{
    $times = $event->stageTimes()
        ->where('driver_number', $driverNumber)
        ->pluck('time_result');

    if ($times->isEmpty()) return;

    $totalMs = $times->sum(function ($time) {
        $parts = explode(':', $time);
        if (count($parts) === 3) {
            [$h, $m, $rest] = $parts;
        } else {
            $h = 0; [$m, $rest] = $parts;
        }
        $secParts = explode('.', $rest);
        $s  = (int) $secParts[0];
        $ms = isset($secParts[1]) ? (int) str_pad($secParts[1], 3, '0') : 0;
        return ((int)$h * 3600000) + ((int)$m * 60000) + ($s * 1000) + $ms;
    });

    $hours   = floor($totalMs / 3600000);
    $totalMs -= $hours * 3600000;
    $minutes = floor($totalMs / 60000);
    $totalMs -= $minutes * 60000;
    $seconds = floor($totalMs / 1000);
    $ms      = $totalMs - ($seconds * 1000);

    $event->update([$column => sprintf('%02d:%02d:%02d.%03d', $hours, $minutes, $seconds, $ms)]);
}

}