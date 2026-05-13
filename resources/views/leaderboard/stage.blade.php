
<!DOCTYPE html>
<html lang="fi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>EAWRC 2024 — Results Tracker</title>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@400;600;700;900&family=Barlow:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">


</head>
<body>

<header>
    <div class="header-inner">
        <div class="logo-block">
            <span class="logo-eyebrow">EA Sports</span>
            <h1>EAWRC <span>2024</span><br>Results Tracker</h1>
        </div>
        <button class="btn-start" id="btnOpenModal">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <path d="M12 5v14M5 12h14"/>
            </svg>
            Start New Event
        </button>
    </div>
</header>

<main>
    <div class="section-header">
        <span class="section-label">Previous Events</span>
        <div class="section-line"></div>
    </div>

</main>






<!-- Notification -->
<div class="notif" id="notif"></div>

<script>
    const nextEventNumber = {{ $nextEventNumber }};
</script>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>