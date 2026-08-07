<!-- ── SINGLE TIME MODAL ── -->
<div class="modal-overlay" id="singleTimeModalOverlay">
    <div class="modal" id="singleTimeModal" style="max-width: 600px;">
        <div class="modal-header">
            <span class="modal-title">Add <span>Single Time</span></span>
            <button class="modal-close" id="btnCloseSingleTimeModal">✕</button>
        </div>

        <div class="modal-body">
            <div class="form-row">
                <div class="form-group full">
                    <label for="single_rally_select">Rally</label>
                    <select id="single_rally_select">
                        <option value="" disabled selected>— Select Rally —</option>
                        @foreach($rallies as $rally)
                            <option value="{{ $rally->id }}">{{ $rally->rally_name }} ({{ $rally->country }})</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-row" id="singleStageWrapper" style="display:none;">
                <div class="form-group full">
                    <label for="single_stage_select">Stage</label>
                    <select id="single_stage_select">
                        <option value="" disabled selected>— Select Stage —</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group full">
                    <label for="single_driver_name">Driver Name (3 letters)</label>
                    <input type="text" id="single_driver_name" placeholder="e.g. ROV" maxlength="3" style="text-transform: uppercase;">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="single_class_select">Class</label>
                    <select id="single_class_select">
                        <option value="WRC">WRC</option>
                        <option value="WRC2">WRC2</option>
                        <option value="JUNIOR WRC">Junior WRC</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="single_car_select">Car</label>
                    <select id="single_car_select">
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
                <div class="form-group">
                    <label>Time</label>
                    <div style="display: flex; gap: 8px; align-items: center;">
                        <div class="time-input-row" style="padding: 0; background: transparent; border: none;">
                            <input type="text" class="min-input" id="single_min" placeholder="00" maxlength="2" inputmode="numeric">
                            <span class="time-sep">'</span>
                            <input type="text" class="sec-input" id="single_sec" placeholder="00" maxlength="2" inputmode="numeric">
                            <span class="time-sep">"</span>
                            <input type="text" class="ms-input" id="single_ms" placeholder="000" maxlength="3" inputmode="numeric">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <button class="btn-cancel" id="btnCancelSingleTime">Close</button>
            <button class="btn-create" id="btnSaveSingleTime" style="background: var(--accent2);">Save Time</button>
        </div>
    </div>
</div>

<!-- Notification -->
<div class="notif" id="notif"></div>
