<?php

namespace App\Observers;

use App\Models\StageTime;
use App\Mail\NewRecordNotification;
use Illuminate\Support\Facades\Mail;

class RecordObserver
{
    /**
     * Handle the Record "created" event.
     */
    public function created(StageTime $record): void
    {
    // Lähetetään sähköposti haluttuun osoitteeseen
    Mail::to('niko@nnmaki.com')->send(new NewRecordNotification($record));
    }

    /**
     * Handle the Record "updated" event.
     */
    public function updated(StageTime $record): void
    {
        //
    }

    /**
     * Handle the Record "deleted" event.
     */
    public function deleted(StageTime $record): void
    {
        //
    }

    /**
     * Handle the Record "restored" event.
     */
    public function restored(StageTime $record): void
    {
        //
    }

    /**
     * Handle the Record "force deleted" event.
     */
    public function forceDeleted(StageTime $record): void
    {
        //
    }
}
