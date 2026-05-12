
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

    @if($events->isEmpty())
        <div class="empty-state">
            <p>No events recorded yet</p>
        </div>
    @else
        <table class="events-table">
            <thead>
                <tr>
                    <th>Event</th>
                    <th>Rally</th>
                    <th>Players</th>
                    <th>Cars</th>
                    <th>Date</th>
                    <th>Status</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach($events as $event)
                <tr onclick="openEventView({{ $event->id }})" style="cursor:pointer">
                    <td>
                            <div class="driver-name">{{ $event->event_name }}</div>
                            <div class="car-name">{{ $event->driver_name }}</div>
                    </td>
                    <td>{{ $event->rally->rally_name }}</td>
                        <td>
                            <div style="font-family:'Barlow Condensed',sans-serif;font-weight:700;font-size:15px">
                                {{ $event->driver1_name }}
                            </div>
                            @if($event->driver2_name)
                            <div style="font-family:'Barlow Condensed',sans-serif;font-weight:700;font-size:15px">
                                {{ $event->driver2_name }}
                            </div>
                            @endif
                      </td>
                    
                    
                    <!-- <td>
                        <span class="badge {{ $event->class === 'WRC' ? 'badge-wrc' : ($event->class === 'WRC2' ? 'badge-wrc2' : 'badge-junior') }}">
                            {{ $event->class }}
                        </span>
                    </td> -->

                    <td>
                        
                        <div style="font-family:'Barlow Condensed',sans-serif;font-weight:700;font-size:15px">
                                {{ $event->driver1_car }}
                            </div>
                          
                            <div style="font-family:'Barlow Condensed',sans-serif;font-weight:700;font-size:15px">
                                {{ $event->driver2_car }}
                            </div>
                          


                    </td>


                    <td>{{ $event->start_time->format('d.m.Y') }}</td>
                    <td>
                        <span class="status-dot {{ $event->completed ? 'status-done' : 'status-active' }}">
                            {{ $event->completed ? 'Finished' : 'Active' }}
                        </span>
                    </td>
                    <!-- <td>{{ $event->formatted_total_time ?? '—' }}</td> -->
                    
                    
                    <!-- <td>
                    <div style="font-family:'Barlow Condensed',sans-serif;font-weight:700;font-size:15px">
                        {{ $event->driver1_name }}
                    </div>
                    @if($event->driver2_name)
                    <div style="font-family:'Barlow Condensed',sans-serif;font-weight:700;font-size:15px">
                        {{ $event->driver2_name }}
                    </div>
                    @endif
                    </td>
                     -->
                    
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
                    <label for="event_name">Event Name</label>
                    <input type="text" id="event_name" placeholder="EVENT 1">
                </div>
            </div>
        
            <!-- <div class="form-row">
                <div class="form-group full">
                    <label for="driver1_name">Driver 1 Name</label>
                    <input type="text" id="driver1_name" placeholder="e.g. Kalle Rovanperä">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group full">
                    <label for="driver2_name">Driver 2 Name</label>
                    <input type="text" id="driver2_name" placeholder="e.g. Sebastien Ogier">
                </div>
            </div> -->







            <!-- <div class="form-row">
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
            </div> -->



{{-- DRIVER 1 --}}
<div class="form-row">
    <div class="form-group full">
        <label for="driver1_name">Driver 1 Name</label>
        <input type="text" id="driver1_name" placeholder="e.g. Kalle Rovanperä">
    </div>
</div>
<div class="form-row">
    <div class="form-group">
        <label for="driver1_class">Driver 1 Class</label>
        <select id="driver1_class">
            <option value="WRC">WRC</option>
            <option value="WRC2">WRC2</option>
            <option value="JUNIOR WRC">Junior WRC</option>
        </select>
    </div>
    <div class="form-group">
        <label for="driver1_car">Driver 1 Car</label>
        <select id="driver1_car">
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

{{-- DRIVER 2 --}}
<div class="form-row">
    <div class="form-group full">
        <label for="driver2_name">Driver 2 Name</label>
        <input type="text" id="driver2_name" placeholder="e.g. Sébastien Ogier">
    </div>
</div>
<div class="form-row">
    <div class="form-group">
        <label for="driver2_class">Driver 2 Class</label>
        <select id="driver2_class">
            <option value="WRC">WRC</option>
            <option value="WRC2">WRC2</option>
            <option value="JUNIOR WRC">Junior WRC</option>
        </select>
    </div>
    <div class="form-group">
        <label for="driver2_car">Driver 2 Car</label>
        <select id="driver2_car">
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
            <button class="btn-cancel" id="btnCancel">Close</button>
            <button class="btn-create" id="btnCreateEvent" disabled>Create Event</button>
        </div>
    </div>
</div>


<!-- ── VIEW EVENT MODAL ── -->
<div class="modal-overlay" id="viewModalOverlay">
    <div class="modal" id="viewModal">
        <div class="modal-header">
            <span class="modal-title" id="viewModalTitle">Event</span>
            <button class="modal-close" id="btnCloseViewModal">✕</button>
        </div>
        <div class="modal-body" id="viewModalBody">
            <!-- Täytetään JavaScriptillä -->
        </div>
        <div class="modal-footer">
            <button class="btn-cancel" id="btnCloseViewModal2">Close</button>
            <button class="btn-end-event" id="btnEndEvent" style="display:none">
                ⬛ End Event
            </button>
        </div>
    </div>
</div>


<!-- Notification -->
<div class="notif" id="notif"></div>

<script>
    const nextEventNumber = {{ $nextEventNumber }};
</script>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>