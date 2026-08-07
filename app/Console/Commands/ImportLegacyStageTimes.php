<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportLegacyStageTimes extends Command
{
    protected $signature = 'import:legacy-times {--dry-run : Näytä vain mitä tuotaisiin, älä tallenna}';
    protected $description = 'Tuo ajat vanhasta per-stage-taulurakenteesta uuteen stage_times-tauluun';

    // Vanha taulu => uuden 'stages'-taulun id
    protected array $tableToStageId = [
        'croatia_stojdraga'       => 1,
        'croatia_hartje'          => 2,
        'croatia_krasic'          => 3,
        'estonia_nupli'           => 4,
        'estonia_koigu'           => 5,
        'estonia_vahessare'       => 6,
        'estonia_vissi'           => 7,
        'europe_vitova'           => 8,
        'europe_libosvary'        => 9,
        'europe_osicko'           => 10,
        'finland_honkanen'        => 11,
        'finland_vehmas'          => 12,
        'finland_saakoski'        => 13,
        'finland_painaa'          => 14,
        'greece_mariolata'        => 15,
        'greece_viniani'          => 16,
        'greece_parnassos'        => 17,
        'greece_drosochori'       => 18,
        'japan_oninotaira'        => 19,
        'japan_habudam'           => 20,
        'japan_higashino'         => 21,
        'japan_nenouehighlands'   => 22,
        'kenya_moinorth'          => 23,
        'kenya_wileli'            => 24,
        'kenya_sugunoi'           => 25,
        'kenya_kanyawa'           => 26,
        'mexico_ortega'           => 27,
        'mexico_ibarrilla'        => 28,
        'mexico_alfaro'           => 29,
        'montecarlo_labollene'    => 30,
        'montecarlo_lamairis'     => 31,
        'montecarlo_moissiere'    => 32,
        'montecarlo_ravindecoste' => 33,
        'portugal_fridao'         => 34,
        'portugal_touca'          => 35,
        'portugal_carrazedo'      => 36,
        'sardegna_littichedda'    => 37,
        'sardegna_bortigiadas'    => 38,
        'sardegna_montemuvri'     => 39,
        'sweden_spikbrenna'       => 40,
        'sweden_aslia'            => 41,
        'sweden_algsjon'          => 42,
        'sweden_storajangen'      => 43,
    ];

    public function handle(): int
    {
        $dry = (bool) $this->option('dry-run');
        $totalImported = 0;
        $totalSkipped = 0;

        foreach ($this->tableToStageId as $table => $stageId) {
            if (! DB::getSchemaBuilder()->hasTable($table)) {
                $this->warn("Taulua '{$table}' ei löytynyt kannasta, ohitetaan.");
                continue;
            }

            $rows = DB::table($table)->orderBy('id')->get();

            foreach ($rows as $row) {
                [$timeMs, $timeResult] = $this->convertTime($row->time);

                if ($timeMs === null) {
                    $this->warn("  Ohitettu {$table}#{$row->id}: aikaa '{$row->time}' ei voitu jäsentää.");
                    $totalSkipped++;
                    continue;
                }

                $data = [
                    'event_id'      => null, // vanhat ajat eivät liity mihinkään eventtiin
                    'stage_id'      => $stageId,
                    'driver_number' => 1,
                    'driver_name'   => $row->driver,
                    'class'         => $row->class,
                    'car'           => $row->car,
                    'time_result'   => $timeResult,
                    'time_ms'       => $timeMs,
                    'recorded_at'   => $row->created_at,
                    'created_at'    => $row->created_at,
                    'updated_at'    => $row->created_at,
                ];

                if ($dry) {
                    $this->line("  {$table}#{$row->id} -> stage_id={$stageId} driver={$row->driver} time={$timeResult} ({$timeMs} ms)");
                } else {
                    DB::table('stage_times')->insert($data);
                }

                $totalImported++;
            }
        }

        $prefix = $dry ? '[DRY RUN] ' : '';
        $this->info("{$prefix}Valmis. Tuotu {$totalImported} riviä, ohitettu {$totalSkipped}.");

        return Command::SUCCESS;
    }

    /**
     * Muuntaa vanhan ajan "05'28\"978" (min'sek"ms) muotoon:
     * time_ms (int) ja time_result "HH:MM:SS.mmm"
     *
     * @return array{0: int|null, 1: string|null}
     */
    protected function convertTime(string $raw): array
    {
        if (! preg_match('/^(\d+)\'(\d{2})"(\d{3})$/', trim($raw), $m)) {
            return [null, null];
        }

        [, $min, $sec, $ms] = $m;

        $min = (int) $min;
        $sec = (int) $sec;
        $ms  = (int) $ms;

        $hours   = intdiv($min, 60);
        $minutes = $min % 60;

        $totalMs = ($min * 60 + $sec) * 1000 + $ms;

        $timeResult = sprintf('%02d:%02d:%02d.%03d', $hours, $minutes, $sec, $ms);

        return [$totalMs, $timeResult];
    }
}
