<!DOCTYPE html>
<html lang="fi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>EAWRC 2024 — {{ $stage->stage_name }} Leaderboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@400;600;700;900&family=Barlow:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

<header>
    <div class="header-inner">
        <a href="{{ route('home') }}" class="logo-link" style="text-decoration: none; color: inherit;">
            <div class="logo-block">
                <span class="logo-eyebrow">{{ $stage->rally->rally_name }}</span>
                <h1>SS{{ $stage->stage_number }} <span>{{ $stage->stage_name }}</span></h1>
            </div>
        </a>
        <button class="btn-start" id="btnOpenSingleTimeModal">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <path d="M12 5v14M5 12h14"/>
            </svg>
            Add Single Time
        </button>
        <a href="{{ route('locations') }}" class="btn-start">
            Stage Locations
        </a>
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
                    <th>Date</th>
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
                    <td>
                        <div class="car-name" style="font-size:14px;color:var(--muted)">{{ \Carbon\Carbon::parse($t->recorded_at)->format('d.m.Y') }}</div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</main>

<footer class="site-footer">
    <a href="https://nnmaki.com/" target="_blank" rel="noopener noreferrer">
        <img src="https://nnmaki.com/wp-content/uploads/2026/06/nnlogo.png" alt="Niko Nmaki Logo" class="footer-logo">
    </a>
    <p class="copyright">Copyright © 2026 Niko Nmaki</p>
</footer>

@include('partials.single-time-modal')
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>