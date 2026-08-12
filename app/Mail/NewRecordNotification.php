<?php

namespace App\Mail;

use App\Models\StageTime;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewRecordNotification extends Mailable

// Talla voi ottaa kayttoon jonotuksen, mutta se vaatii ajamaan palvelimella:
// php artisan queue:work --stop-when-empty
// Pitaa tehda cron job hostingerilla
// class NewRecordNotification extends Mailable implements ShouldQueue

{
    use Queueable, SerializesModels;

    public StageTime $record;

    /**
     * Create a new message instance.
     */
    public function __construct(StageTime $record)
    {
        //
        $this->record = $record;
    }

  public function build()
{
    return $this->subject("EAWRC - Uusi ennätysaikakäyttäjältä {$this->record->driver_name}!")
                ->view('emails.new_record');
}


}
