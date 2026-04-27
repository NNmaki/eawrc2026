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
    return view('app', compact('rallies', 'events'));
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
            'driver_name' => 'required|string|max:255',
            'class'       => 'required|in:WRC,WRC2,JUNIOR WRC',
            'car'         => 'required|string',
            'rally_id'    => 'required|exists:rallies,id',
        ]);

        $event = Event::create([
            'driver_name' => $request->driver_name,
            'class'       => $request->class,
            'car'         => $request->car,
            'rally_id'    => $request->rally_id,
            'start_time'  => now(),
            'completed'   => false,
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

        $stageTime = StageTime::updateOrCreate(
            [
                'event_id' => $event->id,
                'stage_id' => $request->stage_id,
            ],
            [
                'time_result' => $time,
                'recorded_at' => now(),
            ]
        );

        return response()->json(['success' => true, 'time' => $time]);
    }
}