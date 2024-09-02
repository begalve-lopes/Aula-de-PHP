<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SeriesCreated extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $nomeSerie;
    public $serieId;
    public $seasonsQty;
    public $episodesPerSeason;

    public function __construct(string $nomeSerie, int $serieId, int $seasonsQty, int $episodesPerSeason)
    {
        $this->nomeSerie = $nomeSerie;
        $this->serieId = $serieId;
        $this->seasonsQty = $seasonsQty;
        $this->episodesPerSeason = $episodesPerSeason;
        $this->subject="Série $nomeSerie criada}";
    }

    public  function build(){
        return $this->markdown('mail.seriesCreated');
    }
}
