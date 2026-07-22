<?php

namespace App\Mail;

use App\Models\Avis;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AvisAvertissementMail extends Mailable
{
    use Queueable, SerializesModels;

    public Avis $avis;

    public function __construct(Avis $avis)
    {
        $this->avis = $avis;
    }

    public function build()
    {
        return $this->subject('Avertissement concernant votre avis sur TrailBreizh')
            ->view('emails.avis-avertissement');
    }
}