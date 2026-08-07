
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    let currentEventId = null;
    let stagesData = [];

    // ── Open / Close modal ──
    const btnOpenModal = document.getElementById('btnOpenModal');
    if (btnOpenModal) {
        btnOpenModal.addEventListener('click', () => {
            if (typeof nextEventNumber !== 'undefined') {
                document.getElementById('event_name').value = `EVENT ${nextEventNumber}`;
            }
            document.getElementById('modalOverlay').classList.add('active');
            document.body.style.overflow = 'hidden';
        });
    }

    function closeModal() {
        document.getElementById('modalOverlay').classList.remove('active');
        document.body.style.overflow = '';
        resetModal();
        location.reload();
    }


    const btnCloseModal = document.getElementById('btnCloseModal');
    if (btnCloseModal) btnCloseModal.addEventListener('click', closeModal);
    const btnCancel = document.getElementById('btnCancel');
    if (btnCancel) btnCancel.addEventListener('click', closeModal);

    // document.getElementById('modalOverlay')
    // .addEventListener('click', function (e) {
    //     if (e.target === this) {
    //         closeModal();
    //     }
    // });

    function resetModal() {
    document.getElementById('event_name').value = `EVENT ${nextEventNumber}`;
    document.getElementById('event_name').disabled = false;
    
    document.getElementById('driver1_name').value = '';
    document.getElementById('driver1_name').disabled = false;
    document.getElementById('driver2_name').value = '';
    document.getElementById('driver2_name').disabled = false;
    
    // document.getElementById('class_select').disabled = false;
    // document.getElementById('car_select').disabled = false;

    document.getElementById('driver1_class').disabled = false;
    document.getElementById('driver1_car').disabled   = false;
    document.getElementById('driver2_class').disabled = false;
    document.getElementById('driver2_car').disabled   = false; 



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
    const rallySelect = document.getElementById('rally_select');
    if (rallySelect) {
        rallySelect.addEventListener('change', function () {
            const rallyId = this.value;
            const btnCreate = document.getElementById('btnCreateEvent');
            if (btnCreate) btnCreate.disabled = !rallyId;
        });
    }

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
                <div style="display:flex;flex-direction:column;gap:8px">
                    <div style="display:flex;align-items:center;gap:6px">
                        <span style="font-family:'Barlow Condensed',sans-serif;font-size:11px;
                            letter-spacing:2px;color:var(--accent);min-width:24px">D1</span>
                        <div class="time-input-row">
                            <input type="text" class="min-input" id="min-1-${stage.id}" placeholder="00" maxlength="2" inputmode="numeric">
                            <span class="time-sep">'</span>
                            <input type="text" class="sec-input" id="sec-1-${stage.id}" placeholder="00" maxlength="2" inputmode="numeric">
                            <span class="time-sep">"</span>
                            <input type="text" class="ms-input" id="ms-1-${stage.id}" placeholder="000" maxlength="3" inputmode="numeric">
                


                            <button class="btn-save-stage" id="btn-1-${stage.id}" onclick="saveStageTime(${stage.id}, 1)">Save</button>
                  
                  



                        </div>
                    </div>
                    <div style="display:flex;align-items:center;gap:6px">
                        <span style="font-family:'Barlow Condensed',sans-serif;font-size:11px;
                            letter-spacing:2px;color:var(--muted);min-width:24px">D2</span>
                        <div class="time-input-row">
                            <input type="text" class="min-input" id="min-2-${stage.id}" placeholder="00" maxlength="2" inputmode="numeric">
                            <span class="time-sep">'</span>
                            <input type="text" class="sec-input" id="sec-2-${stage.id}" placeholder="00" maxlength="2" inputmode="numeric">
                            <span class="time-sep">"</span>
                            <input type="text" class="ms-input" id="ms-2-${stage.id}" placeholder="000" maxlength="3" inputmode="numeric">
                            <button class="btn-save-stage" id="btn-2-${stage.id}" onclick="saveStageTime(${stage.id}, 2)">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        `).join('');

        // Auto-advance: kun käyttäjä kirjoittaa 2 merkkiä minuutteihin, hyppää sekunteihin jne.

        stages.forEach(stage => {
        [1, 2].forEach(driverNum => {
        const minEl = document.getElementById(`min-${driverNum}-${stage.id}`);
        const secEl = document.getElementById(`sec-${driverNum}-${stage.id}`);
        if (minEl) minEl.addEventListener('input', () => { if (minEl.value.length === 2) secEl.focus(); });
        if (secEl) secEl.addEventListener('input', () => { if (secEl.value.length === 2) {
            document.getElementById(`ms-${driverNum}-${stage.id}`).focus();
        }});
    });
    });


    }



    // ── Create event then save stage time ──
    async function ensureEventCreated() {
    if (currentEventId) return true;

    const eventName  = document.getElementById('event_name').value.trim();

    const driver1Name = document.getElementById('driver1_name').value.trim();
    const driver2Name = document.getElementById('driver2_name').value.trim();
    
    // const classVal   = document.getElementById('class_select').value;
    // const carVal     = document.getElementById('car_select').value;

    const driver1Class = document.getElementById('driver1_class').value;
    const driver1Car   = document.getElementById('driver1_car').value;
    const driver2Class = document.getElementById('driver2_class').value;
    const driver2Car   = document.getElementById('driver2_car').value;


    const rallyId    = document.getElementById('rally_select').value;

    if (!eventName) {
        showNotif('Enter the event name first.', true);
        document.getElementById('event_name').focus();
        return false;
    }

    if (!driver1Name) {
    showNotif('Enter driver 1s name first.', true);
    document.getElementById('driver1_name').focus();
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
            
            // body: JSON.stringify({
            //     event_name:  eventName,
            //     driver1_name: driver1Name,
            //     driver2_name: driver2Name,
            //     class:       classVal,
            //     car:         carVal,
            //     rally_id:    rallyId,
            // })

            body: JSON.stringify({
            event_name:    eventName,
            driver1_name:  driver1Name,
            driver1_class: driver1Class,
            driver1_car:   driver1Car,
            driver2_name:  driver2Name,
            driver2_class: driver2Class,
            driver2_car:   driver2Car,
            rally_id:      rallyId,
            })  

        });

        if (!res.ok) throw new Error();
        const data = await res.json();
        currentEventId = data.event_id;

        document.getElementById('event_name').disabled  = true;
        document.getElementById('driver1_name').disabled = true;
        document.getElementById('driver2_name').disabled = true;

        document.getElementById('driver1_class').disabled = true;
        document.getElementById('driver1_car').disabled   = true;
        document.getElementById('driver2_class').disabled = true;
        document.getElementById('driver2_car').disabled   = true;

        // document.getElementById('class_select').disabled = true;
        // document.getElementById('car_select').disabled   = true;

        document.getElementById('rally_select').disabled = true;

        return true;
    } catch {
        showNotif("Event creation failed.", true);
        return false;
    }
}




    
    async function saveStageTime(stageId, driverNumber = 1) {
    const ok = await ensureEventCreated();
    if (!ok) return;

    const minutes = document.getElementById(`min-${driverNumber}-${stageId}`).value.padStart(2, '0');
    const seconds = document.getElementById(`sec-${driverNumber}-${stageId}`).value.padStart(2, '0');
    const ms      = document.getElementById(`ms-${driverNumber}-${stageId}`).value.padStart(3, '0');

    if (!minutes || !seconds || ms.length < 3) {
        showNotif('Please fill all time fields', true);
        return;
    }


    const btn = document.getElementById(`btn-${driverNumber}-${stageId}`);
    
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
                stage_id:      stageId,
                driver_number: driverNumber,
                minutes,
                seconds,
                milliseconds:  ms,
            })
        });

        if (!res.ok) throw new Error();

        btn.textContent = '✓ Saved';
        btn.classList.add('saved');
        const stageName = stagesData.find(s => s.id === stageId)?.stage_number;
        showNotif(`SS${stageName} D${driverNumber} aika tallennettu!`);
    } catch {
        btn.disabled = false;
        btn.textContent = 'Save';
        showNotif('Saving failed', true);
    }
}
    // ── "Create Event" -nappi ilman stageja (jos haluaa luoda ensin) ──

const btnCreateEvent = document.getElementById('btnCreateEvent');
if (btnCreateEvent) {
    btnCreateEvent.addEventListener('click', async () => {
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
        btnCreateEvent.style.display = 'none';

        showNotif('Event created! Please enter stage times');
    });
}

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
    // const badgeClass = event.class === 'WRC' ? 'badge-wrc'
    //                  : event.class === 'WRC2' ? 'badge-wrc2' : 'badge-junior';

    const badgeClass = event.driver1_class === 'WRC' ? 'badge-wrc'
                 : event.driver1_class === 'WRC2' ? 'badge-wrc2' : 'badge-junior';

    

    document.getElementById('viewModalTitle').innerHTML =
        `${event.event_name} <span style="color:var(--accent)">//</span> ${event.rally.rally_name}`;

    const endBtn = document.getElementById('btnEndEvent');
    endBtn.style.display = event.completed ? 'none' : 'inline-flex';

    // Kerää tallennetut ajat driver_number mukaan
    const savedTimes = { 1: {}, 2: {} };
    event.stage_times.forEach(st => {
        savedTimes[st.driver_number][st.stage_id] = st;
    });

    // Rakenna stage-rivit
    const stageRows = event.rally.stages.map(stage => {
        const saved1 = savedTimes[1][stage.id];
        const saved2 = savedTimes[2][stage.id];

        const renderDriverTime = (saved, driverNum, driverName) => {
            const label = `<span style="font-family:'Barlow Condensed',sans-serif;font-size:11px;
                letter-spacing:2px;color:${driverNum === 1 ? 'var(--accent)' : 'var(--accent)'};
                min-width:28px;display:inline-block">${driverName}</span>`;

            if (saved) {
                return `
                    <div style="display:flex;align-items:center;gap:10px;padding:4px 0">
                        ${label}
                        <div class="stage-time-value" style="font-size:16px">
                            ${formatTime(saved.time_result)}
                        </div>
                    </div>`;
            } else if (!event.completed) {
                return `
                    <div style="display:flex;align-items:center;gap:6px;padding:4px 0"
                        id="view-stage-row-${driverNum}-${stage.id}">
                        ${label}
                        <div class="time-input-row">
                            <input type="text" class="min-input" id="view-min-${driverNum}-${stage.id}"
                                placeholder="00" maxlength="2" inputmode="numeric">
                            <span class="time-sep">'</span>
                            <input type="text" class="sec-input" id="view-sec-${driverNum}-${stage.id}"
                                placeholder="00" maxlength="2" inputmode="numeric">
                            <span class="time-sep">"</span>
                            <input type="text" class="ms-input" id="view-ms-${driverNum}-${stage.id}"
                                placeholder="000" maxlength="3" inputmode="numeric">
                            <button class="btn-save-stage"
                                onclick="saveStageTimeFromView(${stage.id}, ${event.id}, ${driverNum})">
                                Save
                            </button>
                        </div>
                    </div>`;
            } else {
                return `
                    <div style="display:flex;align-items:center;gap:10px;padding:4px 0">
                        ${label}
                        <span class="stage-time-missing">—</span>
                    </div>`;
            }
        };

        return `
            <div class="stage-time-view">
                <div>
                    <span class="stage-time-num">SS${stage.stage_number}</span>
                    <span class="stage-time-name">${stage.stage_name}</span>
                    <div style="font-size:12px;color:var(--muted);margin-top:2px;padding-left:34px">
                        ${stage.distance_km} km
                    </div>
                </div>
                <div style="display:flex;flex-direction:column;gap:2px;align-items:flex-end">
                    ${renderDriverTime(saved1, 1, event.driver1_name ?? 'D1')}
                    ${event.driver2_name ? renderDriverTime(saved2, 2, event.driver2_name) : ''}
                </div>
            </div>`;
    }).join('');

    // Total time molemmille
    const totalTimeRow = `
        <div style="display:flex;justify-content:space-between;align-items:center;
            padding:16px 0 4px;border-top:1px solid var(--border);margin-top:8px">
            <span style="font-family:'Barlow Condensed',sans-serif;font-size:11px;
                letter-spacing:3px;text-transform:uppercase;color:var(--muted)">Total Time</span>
            <div style="display:flex;flex-direction:column;align-items:flex-end;gap:4px">
                <div style="display:flex;align-items:center;gap:8px">
                    <span style="font-family:'Barlow Condensed',sans-serif;font-size:11px;
                        letter-spacing:2px;color:var(--accent)">${event.driver1_name ?? 'D1'}</span>
                    <span style="font-family:'Barlow Condensed',sans-serif;font-weight:700;
                        font-size:20px;color:var(--accent2)">
                        ${formatTime(event.total_time)}
                    </span>
                </div>
                ${event.driver2_name ? `
                <div style="display:flex;align-items:center;gap:8px">
                       <span style="font-family:'Barlow Condensed',sans-serif;font-size:11px;
                        letter-spacing:2px;color:var(--accent)">${event.driver2_name}</span>
                    <span style="font-family:'Barlow Condensed',sans-serif;font-weight:700;
                        font-size:20px;color:var(--accent2)">
                        ${formatTime(event.total_time_driver2)}
                    </span>
                </div>` : ''}
            </div>
        </div>`;

    document.getElementById('viewModalBody').innerHTML = `
        <div class="event-meta">
            

            <div class="event-meta-item">
                <div class="event-meta-label">Driver 1 Name</div>
                <div class="event-meta-value">
                
                <div class="event-meta-value" style="font-size:13px;font-weight:700">${event.driver1_name}</div>

                </div>
            </div>
            <div class="event-meta-item">
                <div class="event-meta-label">Driver 1 Car</div>
                <div class="event-meta-value" style="font-weight:500">${event.driver1_car}</div>
            </div>


            ${event.driver2_name ? `
            <div class="event-meta-item">
                <div class="event-meta-label">Driver 2 Name</div>
                <div class="event-meta-value">
                   
                <div class="event-meta-value" style="font-weight:700">${event.driver2_name}</div>


                </div>
            </div>
            <div class="event-meta-item">
                <div class="event-meta-label">Driver 2 Car</div>
                <div class="event-meta-value" style="font-size:13px;font-weight:500">${event.driver2_car}</div>
            </div>` : ''}




            <div class="event-meta-item">
                <div class="event-meta-label">Date</div>
                <div class="event-meta-value">
                    ${new Date(event.start_time).toLocaleDateString('fi-FI')}
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
        ${totalTimeRow}
    `;

    // Auto-advance kenttien välillä
    event.rally.stages.forEach(stage => {
        [1, 2].forEach(driverNum => {
            const minEl = document.getElementById(`view-min-${driverNum}-${stage.id}`);
            const secEl = document.getElementById(`view-sec-${driverNum}-${stage.id}`);
            const msEl  = document.getElementById(`view-ms-${driverNum}-${stage.id}`);
            if (minEl) minEl.addEventListener('input', () => { if (minEl.value.length === 2) secEl.focus(); });
            if (secEl) secEl.addEventListener('input', () => { if (secEl.value.length === 2) msEl.focus(); });
        });
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
const btnEndEvent = document.getElementById('btnEndEvent');
if (btnEndEvent) {
    btnEndEvent.addEventListener('click', async () => {
        if (!viewingEventId) return;
        if (!confirm('Mark the event finished?')) return;

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
            showNotif('Event finished!');
            btnEndEvent.style.display = 'none';

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
        showNotif('Refresh failed!', true);
    }
});
}
        // Sulje view-modaali
        function closeViewModal() {
            document.getElementById('viewModalOverlay').classList.remove('active');
            document.body.style.overflow = '';
            viewingEventId = null;
        }
        const btnCloseViewModal = document.getElementById('btnCloseViewModal');
        if (btnCloseViewModal) btnCloseViewModal.addEventListener('click', closeViewModal);
        const btnCloseViewModal2 = document.getElementById('btnCloseViewModal2');
        if (btnCloseViewModal2) btnCloseViewModal2.addEventListener('click', closeViewModal);

   
        // document.getElementById('viewModalOverlay')
        //     .addEventListener('click', function (e) {
        //         if (e.target === this) {
        //             closeViewModal();
        //         }
        //     });


async function saveStageTimeFromView(stageId, eventId, driverNumber = 1) {
    const minutes = document.getElementById(`view-min-${driverNumber}-${stageId}`).value.padStart(2, '0');
    const seconds = document.getElementById(`view-sec-${driverNumber}-${stageId}`).value.padStart(2, '0');
    const ms      = document.getElementById(`view-ms-${driverNumber}-${stageId}`).value.padStart(3, '0');

    if (!minutes || !seconds || ms.length < 3) {
        showNotif('Please fill all time fields', true);
        return;
    }

    const btn = document.querySelector(`#view-stage-row-${driverNumber}-${stageId} .btn-save-stage`);
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
                stage_id:      stageId,
                driver_number: driverNumber,
                minutes,
                seconds,
                milliseconds:  ms,
            })
        });

        if (!res.ok) throw new Error();

        const formattedTime = `${parseInt(minutes)}'${seconds}"${ms}`;
        const row = document.getElementById(`view-stage-row-${driverNumber}-${stageId}`);
        const timeDiv = row.querySelector('.time-input-row');
        timeDiv.outerHTML = `<div class="stage-time-value" style="font-size:16px">${formattedTime}</div>`;

        showNotif('Time saved succesfully!');
    } catch {
        btn.disabled = false;
        btn.textContent = 'Save';
        showNotif('Saving failed!', true);
    }
}

// ── Open / Close Single Time Modal ──
const btnOpenSingleTime = document.getElementById('btnOpenSingleTimeModal');
const singleTimeModalOverlay = document.getElementById('singleTimeModalOverlay');
const btnCloseSingleTime = document.getElementById('btnCloseSingleTimeModal');
const btnCancelSingleTime = document.getElementById('btnCancelSingleTime');
const btnSaveSingleTime = document.getElementById('btnSaveSingleTime');

if (btnOpenSingleTime) {
    btnOpenSingleTime.addEventListener('click', () => {
        singleTimeModalOverlay.classList.add('active');
        document.body.style.overflow = 'hidden';
    });
}

function closeSingleTimeModal() {
    singleTimeModalOverlay.classList.remove('active');
    document.body.style.overflow = '';
    // Reset values
    document.getElementById('single_rally_select').value = '';
    document.getElementById('single_stage_select').innerHTML = '<option value="" disabled selected>— Select Stage —</option>';
    document.getElementById('singleStageWrapper').style.display = 'none';
    document.getElementById('single_driver_name').value = '';
    document.getElementById('single_min').value = '';
    document.getElementById('single_sec').value = '';
    document.getElementById('single_ms').value = '';
}

if (btnCloseSingleTime) btnCloseSingleTime.addEventListener('click', closeSingleTimeModal);
if (btnCancelSingleTime) btnCancelSingleTime.addEventListener('click', closeSingleTimeModal);

// Dynamic stages load for Single Time Modal
const singleRallySelect = document.getElementById('single_rally_select');
if (singleRallySelect) {
    singleRallySelect.addEventListener('change', async function () {
        const rallyId = this.value;
        const stageSelect = document.getElementById('single_stage_select');
        const stageWrapper = document.getElementById('singleStageWrapper');

        if (!rallyId) {
            stageWrapper.style.display = 'none';
            return;
        }

        stageSelect.innerHTML = '<option value="" disabled selected>Loading stages...</option>';
        stageWrapper.style.display = 'block';

        try {
            const res = await fetch(`/rallies/${rallyId}/stages`);
            if (!res.ok) throw new Error();
            const stages = await res.json();

            stageSelect.innerHTML = '<option value="" disabled selected>— Select Stage —</option>';
            stages.forEach(stage => {
                const opt = document.createElement('option');
                opt.value = stage.id;
                opt.textContent = `SS${stage.stage_number} ${stage.stage_name} (${stage.distance_km} km)`;
                stageSelect.appendChild(opt);
            });
        } catch {
            stageSelect.innerHTML = '<option value="" disabled>Error loading stages.</option>';
        }
    });
}

// Upper case conversion for single driver input
const singleDriverInput = document.getElementById('single_driver_name');
if (singleDriverInput) {
    singleDriverInput.addEventListener('input', (e) => {
        e.target.value = e.target.value.toUpperCase().slice(0, 3);
    });
}

// Auto-advance for single time inputs
const singleMin = document.getElementById('single_min');
const singleSec = document.getElementById('single_sec');
const singleMs  = document.getElementById('single_ms');
if (singleMin) singleMin.addEventListener('input', () => { if (singleMin.value.length === 2) singleSec.focus(); });
if (singleSec) singleSec.addEventListener('input', () => { if (singleSec.value.length === 2) singleMs.focus(); });

// Save Single Time
if (btnSaveSingleTime) {
    btnSaveSingleTime.addEventListener('click', async () => {
        const rallyId = document.getElementById('single_rally_select').value;
        const stageId = document.getElementById('single_stage_select').value;
        const driverName = document.getElementById('single_driver_name').value.trim();
        const className = document.getElementById('single_class_select').value;
        const carName = document.getElementById('single_car_select').value;
        const minutes = document.getElementById('single_min').value.padStart(2, '0');
        const seconds = document.getElementById('single_sec').value.padStart(2, '0');
        const ms = document.getElementById('single_ms').value.padStart(3, '0');

        if (!rallyId || !stageId) {
            showNotif('Please select rally and stage.', true);
            return;
        }
        if (!driverName || driverName.length !== 3) {
            showNotif('Driver name must be exactly 3 characters.', true);
            return;
        }
        if (!document.getElementById('single_sec').value || ms.length < 3) {
            showNotif('Please fill all time fields.', true);
            return;
        }

        btnSaveSingleTime.disabled = true;
        btnSaveSingleTime.textContent = 'Saving...';

        try {
            const res = await fetch('/stage-times/single', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({
                    stage_id: stageId,
                    driver_name: driverName,
                    class: className,
                    car: carName,
                    minutes: minutes,
                    seconds: seconds,
                    milliseconds: ms,
                })
            });

            if (!res.ok) throw new Error();

            showNotif('Time saved successfully!');
            setTimeout(() => {
                closeSingleTimeModal();
                location.reload();
            }, 1000);
        } catch {
            btnSaveSingleTime.disabled = false;
            btnSaveSingleTime.textContent = 'Save Time';
            showNotif('Saving failed!', true);
        }
    });
}