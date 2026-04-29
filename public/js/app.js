
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    let currentEventId = null;
    let stagesData = [];

    // ── Open / Close modal ──
    document.getElementById('btnOpenModal').addEventListener('click', () => {
        document.getElementById('event_name').value = `EVENT ${nextEventNumber}`;
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
    document.getElementById('event_name').value = `EVENT ${nextEventNumber}`;
    document.getElementById('event_name').disabled = false;
    document.getElementById('driver_name').value = '';
    document.getElementById('driver_name').disabled = false;
    document.getElementById('class_select').disabled = false;
    document.getElementById('car_select').disabled = false;
    document.getElementById('rally_select').value = '';
    document.getElementById('rally_select').disabled = false;
    document.getElementById('stagesWrapper').classList.remove('visible');
    document.getElementById('stagesList').innerHTML = '';
    document.getElementById('btnCreateEvent').disabled = true;
    document.getElementById('btnCreateEvent').style.display = '';
    currentEventId = null;
    stagesData = [];
}

    // ── Fetch stages when rally is selected ──    
    document.getElementById('rally_select').addEventListener('change', function () {
    const rallyId = this.value;
    const btnCreate = document.getElementById('btnCreateEvent');
    btnCreate.disabled = !rallyId;
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

    const eventName  = document.getElementById('event_name').value.trim();
    const driverName = document.getElementById('driver_name').value.trim();
    const classVal   = document.getElementById('class_select').value;
    const carVal     = document.getElementById('car_select').value;
    const rallyId    = document.getElementById('rally_select').value;

    if (!eventName) {
        showNotif('Syötä tapahtuman nimi ensin.', true);
        document.getElementById('event_name').focus();
        return false;
    }

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
                event_name:  eventName,
                driver_name: driverName,
                class:       classVal,
                car:         carVal,
                rally_id:    rallyId,
            })
        });

        if (!res.ok) throw new Error();
        const data = await res.json();
        currentEventId = data.event_id;

        document.getElementById('event_name').disabled  = true;
        document.getElementById('driver_name').disabled = true;
        document.getElementById('class_select').disabled = true;
        document.getElementById('car_select').disabled   = true;
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
    if (!ok) return;

    // Lataa staget vasta nyt
    const rallyId = document.getElementById('rally_select').value;
    const list = document.getElementById('stagesList');
    const wrapper = document.getElementById('stagesWrapper');

    list.innerHTML = '<p style="color:var(--muted);font-size:13px;">Ladataan staget...</p>';
    wrapper.classList.add('visible');

    try {
        const res = await fetch(`/rallies/${rallyId}/stages`);
        stagesData = await res.json();
        renderStages(stagesData);
    } catch {
        list.innerHTML = '<p style="color:var(--accent);font-size:13px;">Virhe stagejen latauksessa.</p>';
    }

    // Piilota CREATE EVENT -nappi kun event on luotu
    document.getElementById('btnCreateEvent').style.display = 'none';

    showNotif('Event luotu! Syötä stage-ajat.');
});

    // ── Notification ──
    function showNotif(msg, isError = false) {
        const el = document.getElementById('notif');
        el.textContent = msg;
        el.classList.toggle('error', isError);
        el.classList.add('show');
        setTimeout(() => el.classList.remove('show'), 3000);
    }

    // ── VIEW EVENT MODAL ──
let viewingEventId = null;

async function openEventView(eventId) {
    viewingEventId = eventId;
    document.getElementById('viewModalOverlay').classList.add('active');
    document.body.style.overflow = 'hidden';
    document.getElementById('viewModalBody').innerHTML =
        '<p style="color:var(--muted);padding:20px 0">Ladataan...</p>';

    try {
        const res = await fetch(`/events/${eventId}`, {
            headers: { 'Accept': 'application/json' }
        });
        const event = await res.json();
        renderEventView(event);
    } catch {
        document.getElementById('viewModalBody').innerHTML =
            '<p style="color:var(--accent)">Lataus epäonnistui.</p>';
    }
}

function renderEventView(event) {
    const badgeClass = event.class === 'WRC' ? 'badge-wrc'
                     : event.class === 'WRC2' ? 'badge-wrc2' : 'badge-junior';

    document.getElementById('viewModalTitle').innerHTML =
        `${event.driver_name} <span style="color:var(--accent)">//</span> ${event.rally.rally_name}`;

    const endBtn = document.getElementById('btnEndEvent');
    endBtn.style.display = event.completed ? 'none' : 'inline-flex';

    // Kerää jo tallennetut stage_id:t
    const savedTimes = {};
    event.stage_times.forEach(st => {
        savedTimes[st.stage_id] = st;
    });

    // Rakenna stage-rivit kaikista rallin stageista
    const stageRows = event.rally.stages.map(stage => {
        const saved = savedTimes[stage.id];

        if (saved) {
            // Aika on jo tallennettu — näytä se
            return `
                <div class="stage-time-view">
                    <div>
                        <span class="stage-time-num">SS${stage.stage_number}</span>
                        <span class="stage-time-name">${stage.stage_name}</span>
                        <div style="font-size:12px;color:var(--muted);margin-top:2px;padding-left:34px">
                            ${stage.distance_km} km
                        </div>
                    </div>
                    <div class="stage-time-value">${formatTime(saved.time_result)}</div>
                </div>
            `;
        } else if (!event.completed) {
            // Aika puuttuu ja event on aktiivinen — näytä syöttökenttä
            return `
                <div class="stage-time-view" id="view-stage-row-${stage.id}">
                    <div>
                        <span class="stage-time-num">SS${stage.stage_number}</span>
                        <span class="stage-time-name">${stage.stage_name}</span>
                        <div style="font-size:12px;color:var(--muted);margin-top:2px;padding-left:34px">
                            ${stage.distance_km} km
                        </div>
                    </div>
                    <div class="time-input-row">
                        <input type="text" class="min-input" id="view-min-${stage.id}"
                            placeholder="00" maxlength="2" inputmode="numeric">
                        <span class="time-sep">'</span>
                        <input type="text" class="sec-input" id="view-sec-${stage.id}"
                            placeholder="00" maxlength="2" inputmode="numeric">
                        <span class="time-sep">"</span>
                        <input type="text" class="ms-input" id="view-ms-${stage.id}"
                            placeholder="000" maxlength="3" inputmode="numeric">
                        <button class="btn-save-stage" 
                            onclick="saveStageTimeFromView(${stage.id}, ${event.id})">
                            Save
                        </button>
                    </div>
                </div>
            `;
        } else {
            // Event on päättynyt eikä aikaa ole — näytä viiva
            return `
                <div class="stage-time-view">
                    <div>
                        <span class="stage-time-num">SS${stage.stage_number}</span>
                        <span class="stage-time-name">${stage.stage_name}</span>
                    </div>
                    <div class="stage-time-missing">—</div>
                </div>
            `;
        }
    }).join('');

    document.getElementById('viewModalBody').innerHTML = `
        <div class="event-meta">
            <div class="event-meta-item">
                <div class="event-meta-label">Class</div>
                <div class="event-meta-value">
                    <span class="badge ${badgeClass}">${event.class}</span>
                </div>
            </div>
            <div class="event-meta-item">
                <div class="event-meta-label">Car</div>
                <div class="event-meta-value" style="font-size:13px;font-weight:500">${event.car}</div>
            </div>
            <div class="event-meta-item">
                <div class="event-meta-label">Date</div>
                <div class="event-meta-value">
                    ${new Date(event.start_time).toLocaleDateString('fi-FI')}
                </div>
            </div>


            <div class="event-meta-item">
                <div class="event-meta-label">Total Time</div>
                <div class="event-meta-value" style="color:var(--accent2)">
                    ${formatTime(event.total_time)}
                </div>
            </div>

            <div class="event-meta-item">
                <div class="event-meta-label">Status</div>
                <div class="event-meta-value">
                    <span class="status-dot ${event.completed ? 'status-done' : 'status-active'}">
                        ${event.completed ? 'Ended' : 'Active'}
                    </span>
                </div>
            </div>

        </div>
        <div class="stages-label">Stage Times</div>
        <div>${stageRows}</div>
    `;

    // Auto-advance kenttien välillä
    event.rally.stages.forEach(stage => {
        const minEl = document.getElementById(`view-min-${stage.id}`);
        const secEl = document.getElementById(`view-sec-${stage.id}`);
        const msEl  = document.getElementById(`view-ms-${stage.id}`);
        if (minEl) minEl.addEventListener('input', () => { if (minEl.value.length === 2) secEl.focus(); });
        if (secEl) secEl.addEventListener('input', () => { if (secEl.value.length === 2) msEl.focus(); });
    });
}

function formatTime(timeStr) {
    // "00:MM:SS.mmm" → "MM'SS"mmm"
    if (!timeStr) return '—';
    const parts = timeStr.split(':');
    if (parts.length < 3) return timeStr;
    const min = parseInt(parts[1]);
    const secMs = parts[2]; // "SS.mmm"
    const [sec, ms] = secMs.split('.');
    return `${min}'${sec}"${ms ?? '000'}`;
}

// End event
document.getElementById('btnEndEvent').addEventListener('click', async () => {
    if (!viewingEventId) return;
    if (!confirm('Merkitäänkö event päättyneeksi?')) return;

    try {
        const res = await fetch(`/events/${viewingEventId}/end`, {
            method: 'PATCH',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
            }
        });
        if (!res.ok) throw new Error();

        const data = await res.json();
        showNotif('Event merkitty päättyneeksi!');
        document.getElementById('btnEndEvent').style.display = 'none';

        // Päivitä status ja total_time listassa
        const row = document.querySelector(`tr[onclick="openEventView(${viewingEventId})"]`);
        if (row) {
            const statusCell = row.querySelector('.status-dot');
            if (statusCell) {
                statusCell.className = 'status-dot status-done';
                statusCell.textContent = 'Ended';
            }
            // Päivitä total_time-sarake (viimeinen td)
            const cells = row.querySelectorAll('td');
            if (cells.length > 0) {
                cells[cells.length - 1].textContent = data.total_time ?? '—';
            }
        }
    } catch {
        showNotif('Päivitys epäonnistui.', true);
    }
});
        // Sulje view-modaali
        function closeViewModal() {
            document.getElementById('viewModalOverlay').classList.remove('active');
            document.body.style.overflow = '';
            viewingEventId = null;
        }
        document.getElementById('btnCloseViewModal').addEventListener('click', closeViewModal);
        document.getElementById('btnCloseViewModal2').addEventListener('click', closeViewModal);
        document.getElementById('viewModalOverlay').addEventListener('click', (e) => {
            if (e.target === document.getElementById('viewModalOverlay')) closeViewModal();
        });

    async function saveStageTimeFromView(stageId, eventId) {
    const minutes = document.getElementById(`view-min-${stageId}`).value.padStart(2, '0');
    const seconds = document.getElementById(`view-sec-${stageId}`).value.padStart(2, '0');
    const ms      = document.getElementById(`view-ms-${stageId}`).value.padStart(3, '0');

    if (!minutes || !seconds || ms.length < 3) {
        showNotif('Täytä kaikki aikakentät.', true);
        return;
    }

    const btn = document.querySelector(`#view-stage-row-${stageId} .btn-save-stage`);
    btn.disabled = true;
    btn.textContent = '...';

    try {
        const res = await fetch(`/events/${eventId}/stage-times`, {
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

        // Korvaa syöttörivi tallennetulla ajalla
        const formattedTime = `${parseInt(minutes)}'${seconds}"${ms}`;
        const row = document.getElementById(`view-stage-row-${stageId}`);
        const timeDiv = row.querySelector('.time-input-row');
        timeDiv.outerHTML = `<div class="stage-time-value">${formattedTime}</div>`;

        showNotif('Aika tallennettu!');
    } catch {
        btn.disabled = false;
        btn.textContent = 'Save';
        showNotif('Tallennus epäonnistui.', true);
    }
}