<!DOCTYPE html>
<html lang="fi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EAWRC 2024 — {{ $stage->stage_name }} Leaderboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@400;600;700;900&family=Barlow:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

<header>
    <div class="header-inner">
        <div class="logo-block">
            <span class="logo-eyebrow">{{ $stage->rally->rally_name }}</span>
            <h1>SS{{ $stage->stage_number }} <span>{{ $stage->stage_name }}</span></h1>
        </div>
        <a href="{{ route('leaderboard.index') }}" class="btn-start">
            ← Leaderboard
        </a>
    </div>
</header>

<main>
    <div class="section-header">
        <span class="section-label">{{ $stage->distance_km }} km — All Time Results</span>
        <div class="section-line"></div>
    </div>

    @if($times->isEmpty())
        <div class="empty-state">
            <p>No times recorded for this stage yet</p>
        </div>
    @else
        <table class="events-table">
            <thead>
                <tr>
                    <th>P</th>
                    <th>Driver</th>
                    <th>Car</th>
                    <th>Class</th>
                    <th>Time</th>
                    <th>Gap</th>
                    <th>Event</th>
                </tr>
            </thead>
            <tbody>
                @foreach($times as $t)
                <tr>
                    <td>
                        @if($t->position === 1)
                            <span style="font-family:'Barlow Condensed',sans-serif;font-weight:900;font-size:22px;color:var(--accent)">
                                P1
                            </span>
                        @else
                            <span style="font-family:'Barlow Condensed',sans-serif;font-weight:700;font-size:18px;color:var(--muted)">
                                P{{ $t->position }}
                            </span>
                        @endif
                    </td>
                    <td>
                        <div class="driver-name">{{ $t->driver_name }}</div>
                    </td>
                    <td>
                        <div class="car-name" style="font-size:14px;color:var(--text)">{{ $t->car }}</div>
                    </td>
                    <td>
                        <span class="badge {{ $t->class === 'WRC' ? 'badge-wrc' : ($t->class === 'WRC2' ? 'badge-wrc2' : 'badge-junior') }}">
                            {{ $t->class }}
                        </span>
                    </td>
                    <td>
                        <span style="font-family:'Barlow Condensed',sans-serif;font-weight:700;font-size:20px;letter-spacing:1px">
                            {{ formatTime($t->time_result) }}
                        </span>
                    </td>
                    <td>
                        <span style="font-family:'Barlow Condensed',sans-serif;font-weight:600;font-size:16px;color:var(--muted)">
                            @if($t->gap_ms === 0)
                                —
                            @else
                                +{{ formatGap($t->gap_ms) }}
                            @endif
                        </span>
                    </td>
                    <td>
                        <div class="car-name">{{ $t->event_name }}</div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</main>

</body>
</html>