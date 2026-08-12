<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EAWRC 2024 — Rally Template Guide</title>
    <meta name="description" content="Step-by-step instructions for creating and loading your own rally templates in the EA Sports WRC PlayStation game.">
    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">
    <link rel="icon" href="{{ asset('favicon-32x32.png') }}" type="image/png" sizes="32x32">
    <link rel="icon" href="{{ asset('favicon-16x16.png') }}" type="image/png" sizes="16x16">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@400;600;700;900&family=Barlow:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        /* ── GUIDE PAGE SPECIFIC ── */
        .guide-hero {
            padding: 0 48px 48px;
            max-width: 1200px;
        }
        .guide-intro {
            color: var(--muted);
            font-size: 15px;
            line-height: 1.6;
            margin-top: 8px;
            max-width: 600px;
        }

        .guide-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 32px;
            padding: 0 48px 80px;
            max-width: 1200px;
        }

        .guide-card {
            background: var(--surface);
            border: 1px solid var(--border);
            position: relative;
            overflow: hidden;
        }
        .guide-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
        }
        .guide-card.save::before  { background: linear-gradient(90deg, var(--accent), var(--accent2)); }
        .guide-card.load::before  { background: linear-gradient(90deg, #0066cc, #00aaff); }

        .guide-card-header {
            padding: 28px 28px 20px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 16px;
        }
        .guide-card-icon {
            width: 44px;
            height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .guide-card.save .guide-card-icon svg  { color: var(--accent); }
        .guide-card.load .guide-card-icon svg  { color: #00aaff; }

        .guide-card-title {
            font-family: 'Barlow Condensed', sans-serif;
            font-weight: 900;
            font-size: 22px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }
        .guide-card-subtitle {
            font-size: 12px;
            color: var(--muted);
            margin-top: 2px;
            letter-spacing: 0.5px;
        }

        .guide-steps {
            padding: 24px 28px 28px;
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 0;
        }
        .guide-step {
            display: flex;
            gap: 16px;
            align-items: flex-start;
            padding: 14px 0;
            border-bottom: 1px solid rgba(255,255,255,0.04);
            position: relative;
        }
        .guide-step:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }
        .guide-step:first-child {
            padding-top: 0;
        }

        /* Vertical connector line */
        .guide-step:not(:last-child)::after {
            content: '';
            position: absolute;
            left: 17px;
            top: 38px;
            width: 1px;
            height: calc(100% - 10px);
            background: var(--border);
        }

        .step-number {
            font-family: 'Barlow Condensed', sans-serif;
            font-weight: 700;
            font-size: 12px;
            letter-spacing: 1px;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            position: relative;
            z-index: 1;
        }
        .guide-card.save .step-number {
            background: rgba(240,90,0,0.15);
            color: var(--accent);
            border: 1px solid rgba(240,90,0,0.3);
        }
        .guide-card.load .step-number {
            background: rgba(0,170,255,0.12);
            color: #00aaff;
            border: 1px solid rgba(0,170,255,0.25);
        }

        .step-content {
            flex: 1;
            padding-top: 6px;
        }
        .step-text {
            font-size: 14px;
            line-height: 1.5;
            color: #c8d8e8;
        }

        /* Inline action chips (SELECT X, press X etc.) */
        .step-action {
            display: inline-block;
            font-family: 'Barlow Condensed', sans-serif;
            font-weight: 700;
            font-size: 12px;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            padding: 2px 8px;
            border-radius: 3px;
            margin: 0 1px;
        }
        .guide-card.save .step-action {
            background: rgba(240,90,0,0.18);
            color: var(--accent2);
        }
        .guide-card.load .step-action {
            background: rgba(0,170,255,0.15);
            color: #00aaff;
        }

        /* Tip box */
        .guide-tip {
            margin: 0 28px 28px;
            padding: 14px 16px;
            background: rgba(240,90,0,0.07);
            border-left: 3px solid var(--accent);
            font-size: 13px;
            color: var(--muted);
            line-height: 1.5;
        }
        .guide-tip strong {
            color: var(--accent2);
            font-weight: 600;
        }

        /* Finish badge at last step */
        .step-finish {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-top: 6px;
            font-family: 'Barlow Condensed', sans-serif;
            font-weight: 700;
            font-size: 11px;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--success);
        }
        .step-finish::before {
            content: '';
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: var(--success);
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 900px) {
            .guide-grid {
                grid-template-columns: 1fr;
                padding: 0 24px 60px;
                gap: 24px;
            }
            .guide-hero {
                padding: 0 24px 32px;
            }
        }
        @media (max-width: 600px) {
            .guide-grid {
                padding: 0 16px 48px;
            }
            .guide-hero {
                padding: 0 16px 24px;
            }
            .guide-card-header {
                padding: 20px 20px 16px;
            }
            .guide-steps {
                padding: 16px 20px 20px;
            }
            .guide-tip {
                margin: 0 20px 20px;
            }
            .step-text {
                font-size: 13px;
            }
        }
    </style>
</head>
<body>

<header>
    <div class="header-inner">
        <a href="{{ route('home') }}" class="logo-link" style="text-decoration: none; color: inherit;">
            <div class="logo-block">
                <span class="logo-eyebrow">EA Sports</span>
                <h1>EAWRC <span>2024</span><br>Rally Guide</h1>
            </div>
        </a>
        <a href="{{ route('home') }}" class="btn-start" style="text-decoration: none;">
            ← Back
        </a>
    </div>
</header>

<main style="padding: 0; max-width: 1200px;">

    <div class="section-header" style="margin: 40px 48px 32px; padding: 0;">
        <span class="section-label">Rally Template Instructions</span>
        <div class="section-line"></div>
    </div>

    <div class="guide-hero">
        <p class="guide-intro">
            Step-by-step instructions for creating your own rally championship template in the EAWRC PlayStation game, and how to load it for future sessions.
        </p>
    </div>

    <div class="guide-grid">

        {{-- ── SAVE CARD ── --}}
        <div class="guide-card save">
            <div class="guide-card-header">
                <div class="guide-card-icon">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
                        <polyline points="17 21 17 13 7 13 7 21"/>
                        <polyline points="7 3 7 8 15 8"/>
                    </svg>
                </div>
                <div>
                    <div class="guide-card-title">Create &amp; Save Template</div>
                    <div class="guide-card-subtitle">Build your rally championship from scratch</div>
                </div>
            </div>

            <ol class="guide-steps">
                <li class="guide-step">
                    <span class="step-number">1</span>
                    <div class="step-content">
                        <div class="step-text">From the main menu, select <span class="step-action">Quick Play</span></div>
                    </div>
                </li>
                <li class="guide-step">
                    <span class="step-number">2</span>
                    <div class="step-content">
                        <div class="step-text">Select <span class="step-action">Solo</span></div>
                    </div>
                </li>
                <li class="guide-step">
                    <span class="step-number">3</span>
                    <div class="step-content">
                        <div class="step-text">Select <span class="step-action">Create Rally</span></div>
                    </div>
                </li>
                <li class="guide-step">
                    <span class="step-number">4</span>
                    <div class="step-content">
                        <div class="step-text">Select <span class="step-action">Create Championship</span></div>
                    </div>
                </li>
                <li class="guide-step">
                    <span class="step-number">5</span>
                    <div class="step-content">
                        <div class="step-text">Select <span class="step-action">Add Event</span></div>
                    </div>
                </li>
                <li class="guide-step">
                    <span class="step-number">6</span>
                    <div class="step-content">
                        <div class="step-text">Select the <span class="step-action">WRC</span> class</div>
                    </div>
                </li>
                <li class="guide-step">
                    <span class="step-number">7</span>
                    <div class="step-content">
                        <div class="step-text">Select <span class="step-action">Rally</span> and <span class="step-action">Season</span></div>
                    </div>
                </li>
                <li class="guide-step">
                    <span class="step-number">8</span>
                    <div class="step-content">
                        <div class="step-text">
                            Select the first <span class="step-action">Stage</span> from your list. Remember to set:
                            <span class="step-action">Service Area → Long</span>
                            <span class="step-action">Weather → Clear</span>
                            <span class="step-action">Time of Day → Morning</span>
                        </div>
                    </div>
                </li>
                <li class="guide-step">
                    <span class="step-number">9</span>
                    <div class="step-content">
                        <div class="step-text">Press <span class="step-action">X</span> to confirm, then select <span class="step-action">Add Stage</span> again and repeat for all remaining stages</div>
                    </div>
                </li>
                <li class="guide-step">
                    <span class="step-number">10</span>
                    <div class="step-content">
                        <div class="step-text">Once all stages are added, select <span class="step-action">Confirm Championship</span></div>
                    </div>
                </li>
                <li class="guide-step">
                    <span class="step-number">11</span>
                    <div class="step-content">
                        <div class="step-text">In the <em>Quick Play Championship</em> menu, select your rally and press <span class="step-action">□ Square</span> on your controller</div>
                    </div>
                </li>
                <li class="guide-step">
                    <span class="step-number">12</span>
                    <div class="step-content">
                        <div class="step-text">Select <span class="step-action">Save Event</span>, then choose an <span class="step-action">Empty Slot</span></div>
                    </div>
                </li>
                <li class="guide-step">
                    <span class="step-number">13</span>
                    <div class="step-content">
                        <div class="step-text">Rename the slot (e.g. <em>FINLAND 1</em>) and select <span class="step-action">Confirm Save</span></div>
                        <div class="step-finish">Save complete</div>
                    </div>
                </li>
            </ol>
        </div>

        {{-- ── LOAD CARD ── --}}
        <div class="guide-card load">
            <div class="guide-card-header">
                <div class="guide-card-icon">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="1 4 1 10 7 10"/>
                        <path d="M3.51 15a9 9 0 1 0 .49-3.51"/>
                    </svg>
                </div>
                <div>
                    <div class="guide-card-title">Load Saved Template</div>
                    <div class="guide-card-subtitle">Start a rally from a previously saved template</div>
                </div>
            </div>

            <ol class="guide-steps">
                <li class="guide-step">
                    <span class="step-number">1</span>
                    <div class="step-content">
                        <div class="step-text">From the main menu, select <span class="step-action">Quick Play</span></div>
                    </div>
                </li>
                <li class="guide-step">
                    <span class="step-number">2</span>
                    <div class="step-content">
                        <div class="step-text">Select <span class="step-action">Solo</span></div>
                    </div>
                </li>
                <li class="guide-step">
                    <span class="step-number">3</span>
                    <div class="step-content">
                        <div class="step-text">Select <span class="step-action">Create Rally</span></div>
                    </div>
                </li>
                <li class="guide-step">
                    <span class="step-number">4</span>
                    <div class="step-content">
                        <div class="step-text">Select <span class="step-action">Create Championship</span></div>
                    </div>
                </li>
                <li class="guide-step">
                    <span class="step-number">5</span>
                    <div class="step-content">
                        <div class="step-text">In the menu showing <em>Add Event</em>, press <span class="step-action">□ Square</span> and select <span class="step-action">Load Event</span></div>
                    </div>
                </li>
                <li class="guide-step">
                    <span class="step-number">6</span>
                    <div class="step-content">
                        <div class="step-text">Select the previously saved rally template you want and press <span class="step-action">X</span> to confirm</div>
                    </div>
                </li>
                <li class="guide-step">
                    <span class="step-number">7</span>
                    <div class="step-content">
                        <div class="step-text">In the <em>Quick Play Championship</em> menu your selected rally will be shown — press <span class="step-action">Confirm Championship</span></div>
                    </div>
                </li>
                <li class="guide-step">
                    <span class="step-number">8</span>
                    <div class="step-content">
                        <div class="step-text">Select <span class="step-action">Start Championship</span></div>
                        <div class="step-finish">Enjoy the rally!</div>
                    </div>
                </li>
            </ol>

            <div class="guide-tip">
                <strong>Tip:</strong> You can have multiple saved templates — one per rally location. Name them clearly (e.g. <em>KENYA 1</em>, <em>SWEDEN 2</em>) so they're easy to find later.
            </div>
        </div>

    </div>
</main>

</body>
</html>
