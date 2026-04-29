
<!DOCTYPE html>
<html lang="fi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>EA WRC 2026 — Results Tracker</title>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@400;600;700;900&family=Barlow:wght@300;400;500&display=swap" rel="stylesheet">
    
     <!-- Oma CSS -->
    <!-- <link rel="stylesheet" href="/css/style.css"> -->
    <style>


:root {
            --bg:        #0a0a0a;
            --surface:   #111111;
            --surface2:  #1a1a1a;
            --border:    #2a2a2a;
            --accent:    #e8001d;
            --accent2:   #ff6b00;
            --text:      #f0f0f0;
            --muted:     #666;
            --success:   #00c853;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            background: var(--bg);
            color: var(--text);
            font-family: 'Barlow', sans-serif;
            font-weight: 400;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* ── HEADER ── */
        header {
            position: relative;
            padding: 48px 48px 36px;
            border-bottom: 1px solid var(--border);
            background: linear-gradient(135deg, #0a0a0a 60%, #1a0305 100%);
            overflow: hidden;
        }
        header::before {
            content: 'WRC';
            position: absolute;
            right: -20px;
            top: -30px;
            font-family: 'Barlow Condensed', sans-serif;
            font-weight: 900;
            font-size: 200px;
            color: rgba(232,0,29,0.04);
            line-height: 1;
            pointer-events: none;
            user-select: none;
        }
        .header-inner {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 24px;
            flex-wrap: wrap;
        }
        .logo-block { display: flex; flex-direction: column; gap: 4px; }
        .logo-eyebrow {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 4px;
            text-transform: uppercase;
            color: var(--accent);
        }
        h1 {
            font-family: 'Barlow Condensed', sans-serif;
            font-weight: 900;
            font-size: clamp(36px, 5vw, 64px);
            line-height: 1;
            letter-spacing: -1px;
            text-transform: uppercase;
        }
        h1 span { color: var(--accent); }

        /* ── MAIN ── */
        main { padding: 48px; max-width: 1200px; }

        /* ── START BUTTON ── */
        .btn-start {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            background: var(--accent);
            color: #fff;
            border: none;
            padding: 16px 36px;
            font-family: 'Barlow Condensed', sans-serif;
            font-weight: 700;
            font-size: 18px;
            letter-spacing: 2px;
            text-transform: uppercase;
            cursor: pointer;
            clip-path: polygon(0 0, calc(100% - 12px) 0, 100% 12px, 100% 100%, 0 100%);
            transition: background 0.15s, transform 0.1s;
            position: relative;
        }
        .btn-start::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, transparent 60%);
            pointer-events: none;
        }
        .btn-start:hover { background: #c8001a; transform: translateY(-1px); }
        .btn-start:active { transform: translateY(0); }
        .btn-start svg { width: 20px; height: 20px; }

        /* ── EVENTS SECTION ── */
        .section-header {
            display: flex;
            align-items: center;
            gap: 16px;
            margin: 48px 0 24px;
        }
        .section-label {
            font-family: 'Barlow Condensed', sans-serif;
            font-weight: 700;
            font-size: 13px;
            letter-spacing: 4px;
            text-transform: uppercase;
            color: var(--muted);
        }
        .section-line {
            flex: 1;
            height: 1px;
            background: var(--border);
        }

        /* ── EVENTS TABLE ── */
        .events-table {
            width: 100%;
            border-collapse: collapse;
        }
        .events-table th {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--muted);
            text-align: left;
            padding: 0 16px 12px;
            border-bottom: 1px solid var(--border);
        }
        .events-table td {
            padding: 16px;
            border-bottom: 1px solid var(--border);
            font-size: 14px;
            vertical-align: middle;
        }
        .events-table tr:hover td { background: var(--surface); cursor: pointer; }

        .driver-name {
            font-family: 'Barlow Condensed', sans-serif;
            font-weight: 700;
            font-size: 18px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }
        .car-name { color: var(--muted); font-size: 13px; margin-top: 2px; }

        .badge {
            display: inline-block;
            padding: 3px 10px;
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
        }
        .badge-wrc    { background: rgba(232,0,29,0.15); color: var(--accent); border: 1px solid rgba(232,0,29,0.3); }
        .badge-wrc2   { background: rgba(255,107,0,0.15); color: var(--accent2); border: 1px solid rgba(255,107,0,0.3); }
        .badge-junior { background: rgba(255,255,255,0.07); color: #aaa; border: 1px solid rgba(255,255,255,0.15); }

        .status-dot {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            font-family: 'Barlow Condensed', sans-serif;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
        }
        .status-dot::before {
            content: '';
            width: 7px; height: 7px;
            border-radius: 50%;
        }
        .status-active { color: var(--success); }
        .status-active::before { background: var(--success); box-shadow: 0 0 6px var(--success); }
        .status-done { color: var(--muted); }
        .status-done::before { background: var(--muted); }

        .empty-state {
            text-align: center;
            padding: 80px 24px;
            color: var(--muted);
        }
        .empty-state p {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 16px;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        /* ── MODAL OVERLAY ── */
        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.85);
            z-index: 1000;
            backdrop-filter: blur(4px);
            align-items: flex-start;
            justify-content: center;
            padding: 40px 16px;
            overflow-y: auto;
        }
        .modal-overlay.active { display: flex; }

        .modal {
            background: var(--surface);
            border: 1px solid var(--border);
            width: 100%;
            max-width: 640px;
            position: relative;
            animation: modalIn 0.2s ease;
            clip-path: polygon(0 0, calc(100% - 16px) 0, 100% 16px, 100% 100%, 0 100%);
        }
        @keyframes modalIn {
            from { opacity: 0; transform: translateY(-20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .modal-header {
            padding: 28px 32px 20px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .modal-title {
            font-family: 'Barlow Condensed', sans-serif;
            font-weight: 900;
            font-size: 28px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }
        .modal-title span { color: var(--accent); }

        .modal-close {
            background: none;
            border: 1px solid var(--border);
            color: var(--muted);
            width: 36px; height: 36px;
            cursor: pointer;
            font-size: 18px;
            display: flex; align-items: center; justify-content: center;
            transition: color 0.15s, border-color 0.15s;
        }
        .modal-close:hover { color: var(--text); border-color: var(--muted); }

        .modal-body { padding: 28px 32px; }

        /* ── FORM ── */
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin-bottom: 16px;
        }
        .form-group { display: flex; flex-direction: column; gap: 6px; }
        .form-group.full { grid-column: 1 / -1; }

        label {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--muted);
        }

        input[type="text"], select {
            background: var(--surface2);
            border: 1px solid var(--border);
            color: var(--text);
            padding: 11px 14px;
            font-family: 'Barlow', sans-serif;
            font-size: 14px;
            outline: none;
            width: 100%;
            transition: border-color 0.15s;
            appearance: none;
            -webkit-appearance: none;
        }
        input[type="text"]:focus, select:focus {
            border-color: var(--accent);
        }
        select {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath fill='%23666' d='M6 8L0 0h12z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 14px center;
            padding-right: 40px;
            cursor: pointer;
        }
        select option { background: var(--surface2); }

        /* ── STAGES SECTION ── */
        .stages-wrapper {
            margin-top: 24px;
            border-top: 1px solid var(--border);
            padding-top: 20px;
            display: none;
        }
        .stages-wrapper.visible { display: block; }

        .stages-label {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: 16px;
        }

        .stage-row {
            background: var(--surface2);
            border: 1px solid var(--border);
            margin-bottom: 10px;
            padding: 14px 16px;
        }
        .stage-info {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 12px;
        }
        .stage-num {
            font-family: 'Barlow Condensed', sans-serif;
            font-weight: 700;
            font-size: 22px;
            color: var(--accent);
            min-width: 32px;
        }
        .stage-details {}
        .stage-name-text {
            font-family: 'Barlow Condensed', sans-serif;
            font-weight: 700;
            font-size: 16px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .stage-km { font-size: 12px; color: var(--muted); margin-top: 1px; }

        /* Time input row */
        .time-input-row {
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .time-input-row input[type="text"] {
            text-align: center;
            padding: 8px 4px;
            font-family: 'Barlow Condensed', sans-serif;
            font-weight: 700;
            font-size: 20px;
            letter-spacing: 1px;
        }
        .time-input-row input.min-input { width: 56px; }
        .time-input-row input.sec-input { width: 56px; }
        .time-input-row input.ms-input  { width: 68px; }

        .time-sep {
            font-family: 'Barlow Condensed', sans-serif;
            font-weight: 700;
            font-size: 20px;
            color: var(--muted);
            line-height: 1;
        }

        .btn-save-stage {
            background: none;
            border: 1px solid var(--accent);
            color: var(--accent);
            padding: 8px 18px;
            font-family: 'Barlow Condensed', sans-serif;
            font-weight: 700;
            font-size: 13px;
            letter-spacing: 2px;
            text-transform: uppercase;
            cursor: pointer;
            transition: background 0.15s, color 0.15s;
            white-space: nowrap;
            margin-left: 8px;
            flex-shrink: 0;
        }
        .btn-save-stage:hover { background: var(--accent); color: #fff; }
        .btn-save-stage.saved { border-color: var(--success); color: var(--success); }
        .btn-save-stage.saved:hover { background: var(--success); color: #fff; }

        /* ── MODAL FOOTER ── */
        .modal-footer {
            padding: 20px 32px 28px;
            border-top: 1px solid var(--border);
            display: flex;
            gap: 12px;
            justify-content: flex-end;
        }
        .btn-cancel {
            background: none;
            border: 1px solid var(--border);
            color: var(--muted);
            padding: 12px 28px;
            font-family: 'Barlow Condensed', sans-serif;
            font-weight: 700;
            font-size: 14px;
            letter-spacing: 2px;
            text-transform: uppercase;
            cursor: pointer;
            transition: color 0.15s, border-color 0.15s;
        }
        .btn-cancel:hover { color: var(--text); border-color: var(--muted); }

        .btn-create {
            background: var(--accent);
            border: none;
            color: #fff;
            padding: 12px 32px;
            font-family: 'Barlow Condensed', sans-serif;
            font-weight: 700;
            font-size: 14px;
            letter-spacing: 2px;
            text-transform: uppercase;
            cursor: pointer;
            clip-path: polygon(0 0, calc(100% - 8px) 0, 100% 8px, 100% 100%, 0 100%);
            transition: background 0.15s;
        }
        .btn-create:hover { background: #c8001a; }
        .btn-create:disabled { background: var(--border); color: var(--muted); cursor: not-allowed; }

        /* ── NOTIFICATION ── */
        .notif {
            position: fixed;
            bottom: 32px;
            right: 32px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-left: 3px solid var(--success);
            padding: 14px 20px;
            font-family: 'Barlow Condensed', sans-serif;
            font-weight: 600;
            font-size: 14px;
            letter-spacing: 1px;
            text-transform: uppercase;
            z-index: 2000;
            opacity: 0;
            transform: translateY(10px);
            transition: opacity 0.2s, transform 0.2s;
            pointer-events: none;
        }
        .notif.show { opacity: 1; transform: translateY(0); }
        .notif.error { border-left-color: var(--accent); }

        @media (max-width: 600px) {
            header, main { padding: 24px; }
            .form-row { grid-template-columns: 1fr; }
            .modal-header, .modal-body, .modal-footer { padding-left: 20px; padding-right: 20px; }
        }
    
    </style>
    
        
</head>
<body>

<header>
    <div class="header-inner">
        <div class="logo-block">
            <span class="logo-eyebrow">EA Sports</span>
            <h1>WRC <span>2026</span><br>Results Tracker</h1>
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

    @if($events->isEmpty())
        <div class="empty-state">
            <p>No events recorded yet</p>
        </div>
    @else
        <table class="events-table">
            <thead>
                <tr>
                    <th>Driver</th>
                    <th>Rally</th>
                    <th>Class</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Total Time</th>
                </tr>
            </thead>
            <tbody>
                @foreach($events as $event)
                <tr>
                    <td>
                        <div class="driver-name">{{ $event->driver_name }}</div>
                        <div class="car-name">{{ $event->car }}</div>
                    </td>
                    <td>{{ $event->rally->rally_name }}</td>
                    <td>
                        <span class="badge {{ $event->class === 'WRC' ? 'badge-wrc' : ($event->class === 'WRC2' ? 'badge-wrc2' : 'badge-junior') }}">
                            {{ $event->class }}
                        </span>
                    </td>
                    <td>{{ $event->start_time->format('d.m.Y') }}</td>
                    <td>
                        <span class="status-dot {{ $event->completed ? 'status-done' : 'status-active' }}">
                            {{ $event->completed ? 'Finished' : 'Active' }}
                        </span>
                    </td>
                    <td>{{ $event->total_time ?? '—' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</main>

<!-- ── MODAL ── -->
<div class="modal-overlay" id="modalOverlay">
    <div class="modal" id="modal">
        <div class="modal-header">
            <span class="modal-title">New <span>Event</span></span>
            <button class="modal-close" id="btnCloseModal">✕</button>
        </div>

        <div class="modal-body">
            <div class="form-row">
                <div class="form-group full">
                    <label for="driver_name">Driver Name</label>
                    <input type="text" id="driver_name" placeholder="e.g. Kalle Rovanperä">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="class_select">Class</label>
                    <select id="class_select">
                        <option value="WRC">WRC</option>
                        <option value="WRC2">WRC2</option>
                        <option value="JUNIOR WRC">Junior WRC</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="car_select">Car</label>
                    <select id="car_select">
                        <option value="Ford Puma Rally1 HYBRID '23">Ford Puma Rally1 HYBRID '23</option>
                        <option value="Ford Puma Rally1 HYBRID '24">Ford Puma Rally1 HYBRID '24</option>
                        <option value="Hyundai i20 N Rally1 HYBRID '23">Hyundai i20 N Rally1 HYBRID '23</option>
                        <option value="Hyundai i20 N Rally1 HYBRID '24">Hyundai i20 N Rally1 HYBRID '24</option>
                        <option value="Toyota GR Yaris Rally1 HYBRID '23" selected>Toyota GR Yaris Rally1 HYBRID '23</option>
                        <option value="Toyota GR Yaris Rally1 HYBRID '24">Toyota GR Yaris Rally1 HYBRID '24</option>
                        <option value="Citroën C3 Rally2">Citroën C3 Rally2</option>
                        <option value="Ford Fiesta Rally2">Ford Fiesta Rally2</option>
                        <option value="Hyundai i20 N Rally2">Hyundai i20 N Rally2</option>
                        <option value="ŠKODA Fabia Rally2 Evo">ŠKODA Fabia Rally2 Evo</option>
                        <option value="ŠKODA Fabia RS Rally2">ŠKODA Fabia RS Rally2</option>
                        <option value="Toyota GR Yaris Rally2">Toyota GR Yaris Rally2</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group full">
                    <label for="rally_select">Select Rally</label>
                    <select id="rally_select">
                        <option value="">— Choose a rally —</option>
                        @foreach($rallies as $rally)
                            <option value="{{ $rally->id }}">{{ $rally->rally_name }} ({{ $rally->country }})</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Stages appear here after rally is selected -->
            <div class="stages-wrapper" id="stagesWrapper">
                <div class="stages-label">Stage Times</div>
                <div id="stagesList"></div>
            </div>
        </div>

        <div class="modal-footer">
            <button class="btn-cancel" id="btnCancel">Cancel</button>
            <button class="btn-create" id="btnCreateEvent" disabled>Create Event</button>
        </div>
    </div>
</div>

<!-- Notification -->
<div class="notif" id="notif"></div>

<script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    let currentEventId = null;
    let stagesData = [];

    // ── Open / Close modal ──
    document.getElementById('btnOpenModal').addEventListener('click', () => {
        document.getElementById('modalOverlay').classList.add('active');
        document.body.style.overflow = 'hidden';
    });

    function closeModal() {
        document.getElementById('modalOverlay').classList.remove('active');
        document.body.style.overflow = '';
        resetModal();
    }
    document.getElementById('btnCloseModal').addEventListener('click', closeModal);
    document.getElementById('btnCancel').addEventListener('click', closeModal);
    document.getElementById('modalOverlay').addEventListener('click', (e) => {
        if (e.target === document.getElementById('modalOverlay')) closeModal();
    });

    function resetModal() {
        document.getElementById('driver_name').value = '';
        document.getElementById('rally_select').value = '';
        document.getElementById('stagesWrapper').classList.remove('visible');
        document.getElementById('stagesList').innerHTML = '';
        document.getElementById('btnCreateEvent').disabled = true;
        currentEventId = null;
        stagesData = [];
    }

    // ── Fetch stages when rally is selected ──
    document.getElementById('rally_select').addEventListener('change', async function () {
        const rallyId = this.value;
        const wrapper = document.getElementById('stagesWrapper');
        const list = document.getElementById('stagesList');
        const btnCreate = document.getElementById('btnCreateEvent');

        if (!rallyId) {
            wrapper.classList.remove('visible');
            list.innerHTML = '';
            btnCreate.disabled = true;
            return;
        }

        list.innerHTML = '<p style="color:var(--muted);font-size:13px;">Ladataan staget...</p>';
        wrapper.classList.add('visible');

        try {
            const res = await fetch(`/rallies/${rallyId}/stages`);
            stagesData = await res.json();
            renderStages(stagesData);
            btnCreate.disabled = false;
        } catch (err) {
            list.innerHTML = '<p style="color:var(--accent);font-size:13px;">Virhe stagejen latauksessa.</p>';
        }
    });

    function renderStages(stages) {
        const list = document.getElementById('stagesList');
        list.innerHTML = stages.map(stage => `
            <div class="stage-row" id="stage-row-${stage.id}">
                <div class="stage-info">
                    <span class="stage-num">SS${stage.stage_number}</span>
                    <div class="stage-details">
                        <div class="stage-name-text">${stage.stage_name}</div>
                        <div class="stage-km">${stage.distance_km} km</div>
                    </div>
                </div>
                <div class="time-input-row">
                    <input type="text" class="min-input" id="min-${stage.id}"
                        placeholder="00" maxlength="2" pattern="\\d{1,2}"
                        title="Minuutit" inputmode="numeric">
                    <span class="time-sep">'</span>
                    <input type="text" class="sec-input" id="sec-${stage.id}"
                        placeholder="00" maxlength="2" pattern="\\d{2}"
                        title="Sekunnit (00-59)" inputmode="numeric">
                    <span class="time-sep">"</span>
                    <input type="text" class="ms-input" id="ms-${stage.id}"
                        placeholder="000" maxlength="3" pattern="\\d{3}"
                        title="Millisekunnit (000-999)" inputmode="numeric">
                    <button class="btn-save-stage" onclick="saveStageTime(${stage.id})">Save</button>
                </div>
            </div>
        `).join('');

        // Auto-advance: kun käyttäjä kirjoittaa 2 merkkiä minuutteihin, hyppää sekunteihin jne.
        stages.forEach(stage => {
            const minEl = document.getElementById(`min-${stage.id}`);
            const secEl = document.getElementById(`sec-${stage.id}`);
            const msEl  = document.getElementById(`ms-${stage.id}`);

            minEl.addEventListener('input', () => { if (minEl.value.length === 2) secEl.focus(); });
            secEl.addEventListener('input', () => { if (secEl.value.length === 2) msEl.focus(); });
        });
    }

    // ── Create event then save stage time ──
    async function ensureEventCreated() {
        if (currentEventId) return true;

        const driverName = document.getElementById('driver_name').value.trim();
        const classVal   = document.getElementById('class_select').value;
        const carVal     = document.getElementById('car_select').value;
        const rallyId    = document.getElementById('rally_select').value;

        if (!driverName) {
            showNotif('Syötä kuljettajan nimi ensin.', true);
            document.getElementById('driver_name').focus();
            return false;
        }

        try {
            const res = await fetch('/events', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({
                    driver_name: driverName,
                    class: classVal,
                    car: carVal,
                    rally_id: rallyId,
                })
            });

            if (!res.ok) throw new Error();
            const data = await res.json();
            currentEventId = data.event_id;

            // Lukitse perustietokentät
            document.getElementById('driver_name').disabled = true;
            document.getElementById('class_select').disabled = true;
            document.getElementById('car_select').disabled = true;
            document.getElementById('rally_select').disabled = true;

            return true;
        } catch {
            showNotif('Eventin luonti epäonnistui.', true);
            return false;
        }
    }

    async function saveStageTime(stageId) {
        const ok = await ensureEventCreated();
        if (!ok) return;

        const minutes = document.getElementById(`min-${stageId}`).value.padStart(2, '0');
        const seconds = document.getElementById(`sec-${stageId}`).value.padStart(2, '0');
        const ms      = document.getElementById(`ms-${stageId}`).value.padStart(3, '0');

        if (!minutes || !seconds || !ms || ms.length < 3) {
            showNotif('Täytä kaikki aikakentät.', true);
            return;
        }

        const btn = document.querySelector(`#stage-row-${stageId} .btn-save-stage`);
        btn.disabled = true;
        btn.textContent = '...';

        try {
            const res = await fetch(`/events/${currentEventId}/stage-times`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({
                    stage_id: stageId,
                    minutes,
                    seconds,
                    milliseconds: ms,
                })
            });

            if (!res.ok) throw new Error();

            btn.textContent = '✓ Saved';
            btn.classList.add('saved');
            showNotif(`SS${stagesData.find(s=>s.id===stageId)?.stage_number} aika tallennettu!`);
        } catch {
            btn.disabled = false;
            btn.textContent = 'Save';
            showNotif('Tallennus epäonnistui.', true);
        }
    }

    // ── "Create Event" -nappi ilman stageja (jos haluaa luoda ensin) ──
    document.getElementById('btnCreateEvent').addEventListener('click', async () => {
        const ok = await ensureEventCreated();
        if (ok) showNotif('Event luotu! Syötä stage-ajat.');
    });

    // ── Notification ──
    function showNotif(msg, isError = false) {
        const el = document.getElementById('notif');
        el.textContent = msg;
        el.classList.toggle('error', isError);
        el.classList.add('show');
        setTimeout(() => el.classList.remove('show'), 3000);
    }
</script>

</body>
</html>