<!DOCTYPE html>
<html lang="fi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EAWRC 2024 — Leaderboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@400;600;700;900&family=Barlow:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

<header>
    <div class="header-inner">
        <div class="logo-block">
            <span class="logo-eyebrow">EA Sports</span>
            <h1>EAWRC <span>2024</span><br>Leaderboard</h1>
        </div>
        <a href="{{ route('home') }}" class="btn-start">
            ← Back
        </a>
    </div>
</header>

<main>
    @foreach($rallies as $rally)
    <div class="section-header">
        <span class="section-label">{{ $rally->rally_name }}</span>
        <div class="section-line"></div>
    </div>

    <table class="events-table">
        <thead>
            <tr>
                <th>SS</th>
                <th>Stage Name</th>
                <th>Distance</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($rally->stages->sortBy('stage_number') as $stage)
            <tr onclick="window.location='{{ route('leaderboard.stage', $stage) }}'" style="cursor:pointer">
                <td>
                    <span style="font-family:'Barlow Condensed',sans-serif;font-weight:700;font-size:22px;color:var(--accent)">
                        SS{{ $stage->stage_number }}
                    </span>
                </td>
                <td>
                    <div class="driver-name">{{ $stage->stage_name }}</div>
                </td>
                <td>
                    <span style="font-family:'Barlow Condensed',sans-serif;font-weight:700;font-size:16px">
                        {{ $stage->distance_km }} km
                    </span>
                </td>
                <td style="text-align:right">
                    <span class="status-dot status-active" style="font-size:11px;letter-spacing:2px">
                        View →
                    </span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endforeach
</main>

</body>
</html>