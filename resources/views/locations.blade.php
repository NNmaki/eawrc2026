<!DOCTYPE html>
<html lang="fi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>EAWRC 2024 — Stage Locations</title>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@400;600;700;900&family=Barlow:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

<header>
    <div class="header-inner">
        <a href="{{ route('home') }}" class="logo-link" style="text-decoration: none; color: inherit;">
            <div class="logo-block">
                <span class="logo-eyebrow">EA Sports</span>
                <h1>EAWRC <span>2024</span><br>Stage Locations</h1>
            </div>
        </a>
        <div style="display: flex; gap: 12px; flex-wrap: wrap;">
            <button class="btn-start" id="btnOpenSingleTimeModal">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <path d="M12 5v14M5 12h14"/>
                </svg>
                Add Single Time
            </button>
            <a href="{{ route('home') }}" class="btn-start">
                ← Back
            </a>
        </div>
    </div>
</header>

<main>
    <div class="section-header">
        <span class="section-label">Real World Stage Locations</span>
        <div class="section-line"></div>
    </div>

    <div class="locations-links">
        <div class="locations-container">
            <h4>Rallye Monte-Carlo</h4>
            <p class="location-detail">Location: Provence-Alpes-Côte d'Azur</p>
            <a class="map-link-btn" href="https://www.google.com/maps/d/viewer?mid=16fdFAe8EVl_HjoTBDPWDb06wfSIcOPw" target="_blank">Link to stage map</a>
        </div>

        <div class="locations-container">
            <h4>Rally Sweden</h4>
            <p class="location-detail">Location: Värmland (Vargasen)</p>
            <a class="map-link-btn" href="https://www.google.com/maps/d/viewer?mid=1pvb6l2BRHJGJiCZtw5-eXHqoRNjW0sU" target="_blank">Link to stage map</a>
        </div>

        <div class="locations-container">
            <h4>Safari Rally Kenya</h4>
            <p class="location-detail">Location: Nakuru County</p>
            <a class="map-link-btn" href="https://www.google.com/maps/d/viewer?mid=1clYKg9WehNAcTh3XkfPZZK9tHk91w9k" target="_blank">Link to stage map</a>
        </div>

        <div class="locations-container">
            <h4>Croatia Rally</h4>
            <p class="location-detail">Location: Zagreb & Krapina-Zagorje</p>
            <a class="map-link-btn" href="https://www.google.com/maps/d/viewer?mid=15mmEu0pVmvRhrvFs2RgsXOaNWQARe-s" target="_blank">Link to stage map</a>
        </div>

        <div class="locations-container">
            <h4>Vodafone Rally de Portugal</h4>
            <p class="location-detail">Location: Distrito de Braga</p>
            <a class="map-link-btn" href="https://www.google.com/maps/d/viewer?mid=1vnLiPdtaOJAEfQ7tikIZY0HXrjhNCU4&usp=sharing" target="_blank">Link to stage map</a>
        </div>

        <div class="locations-container">
            <h4>Rally Italia Sardegna</h4>
            <p class="location-detail">Location: Provincia di Nuoro</p>
            <a class="map-link-btn" href="https://www.google.com/maps/d/viewer?mid=1VKNNiiVVd8vGSiQiD2PFkTDQ1zKzAa4" target="_blank">Link to stage map</a>
        </div>

        <div class="locations-container">
            <h4>Secto Rally Finland</h4>
            <p class="location-detail">Location: Pirkanmaa</p>
            <a class="map-link-btn" href="https://www.google.com/maps/d/viewer?mid=1QYkgdwvtytfXI5HEKZI-2gqMribCYns&usp=sharing" target="_blank">Link to stage map</a>
        </div>

        <div class="locations-container">
            <h4>EKO Acropolis Rally Greece</h4>
            <p class="location-detail">Location: Phocis (Gravia), Corinthia (Harvati)</p>
            <a class="map-link-btn" href="https://www.google.com/maps/d/viewer?mid=1cSFVXWpgY1gGcdG_TnTIDV86Qj-q7fI" target="_blank">Link to stage map</a>
        </div>
       
        <div class="locations-container">
            <h4>Rally Chile BIOBÍO</h4>
            <p class="location-detail">Location: Región del Biobío</p>
            <a class="map-link-btn" href="https://www.google.com/maps/d/viewer?mid=1n6hNKPnHiU5jYwzVr4mUpfoblBXbG5Q" target="_blank">Link to stage map</a>
        </div>

        <div class="locations-container">
            <h4>Central European Rally</h4>
            <p class="location-detail">Location: Zlín Region</p>
            <a class="map-link-btn" href="https://www.google.com/maps/d/viewer?mid=1BOeGwEocyIxHIYM68Le5DdqHMphQbEk" target="_blank">Link to stage map</a>
        </div>

        <div class="locations-container">
            <h4>Forum8 Rally Japan</h4>
            <p class="location-detail">Location: Chūbu</p>
            <a class="map-link-btn" href="https://www.google.com/maps/d/viewer?mid=1Cpi5BDyLWkq17Z4EsB2dBgg4osoajBw&ll=35.240276168648954%2C137.44459500000002&z=11" target="_blank">Link to stage map</a>
        </div>

        <div class="locations-container">
            <h4>Rally Estonia</h4>
            <p class="location-detail">Location: Tartu (Elva), Valga & Põlva (Otepää)</p>
            <a class="map-link-btn" href="https://www.google.com/maps/d/viewer?mid=1z_xnSBe1oOz_soqFWl6Y4D_nGt7ZK0M&usp=sharing" target="_blank">Link to stage map</a>
        </div>

        <div class="locations-container">
            <h4>Rally Iberia (Spain)</h4>
            <p class="location-detail">Location: Catalonia</p>
            <a class="map-link-btn" href="https://www.google.com/maps/d/viewer?mid=1iil_uowFbTO4z6kEIJFat49urn1xe6k&usp=sharing" target="_blank">Link to stage map</a>
        </div>

        <div class="locations-container">
            <h4>Guanajuato Rally Mexico</h4>
            <p class="location-detail">Location: Estado de Guanajuato</p>
            <a class="map-link-btn" href="https://www.google.com/maps/d/viewer?mid=1sKTOg6aqfavrmWfFz7j2bF6jNX21w7k" target="_blank">Link to stage map</a>
        </div>
    </div>
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
