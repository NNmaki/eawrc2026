<h2>EAWRC - Uusi ennätysaika pelaajalta {{ $record->driver_name }}</h2>
<p>Tietokantaan on tallennettu uusi aika pelaajalta:</p>
<ul>
    <li><strong>Kuljettaja:</strong> {{ $record->driver_name }}</li>
    <li><strong>Aika:</strong> {{ $record->time_result }}</li>
    <li><strong>Stage ID:</strong> {{ $record->stage_id }}</li>
</ul>