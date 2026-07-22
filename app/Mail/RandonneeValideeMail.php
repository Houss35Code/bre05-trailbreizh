<?php

namespace App\Mail;

use App\Models\Randonnee;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RandonneeValideeMail extends Mailable
{
    use Queueable, SerializesModels;

    public Randonnee $randonnee;

    public function __construct(Randonnee $randonnee)
    {
        $this->randonnee = $randonnee;
    }

    public function build()
    {
        return $this->subject('Votre randonnée a été validée')
            ->view('emails.randonnee-validee');
    }
}