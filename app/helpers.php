
<?php

function formatTime(string $timeStr): string
{
    // "00:MM:SS.mmm" → "MM'SS"mmm"
    if (!$timeStr) return '—';
    [$h, $m, $rest] = explode(':', $timeStr);
    [$s, $ms] = explode('.', $rest);
    $totalMin = ((int)$h * 60) + (int)$m;
    return "{$totalMin}'{$s}\"{$ms}";
}

function formatGap(int $gapMs): string
{
    // millisekunnit → "+M'SS"mmm"
    $ms  = $gapMs % 1000;
    $s   = floor($gapMs / 1000) % 60;
    $m   = floor($gapMs / 60000);
    return sprintf("%d'%02d\"%03d", $m, $s, $ms);
}