<?php

namespace App\Mail;

use App\Models\Randonnee;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RandonneeRefuseeMail extends Mailable
{
    use Queueable, SerializesModels;

    public Randonnee $randonnee;

    public function __construct(Randonnee $randonnee)
    {
        $this->randonnee = $randonnee;
    }

    public function build()
    {
        return $this->subject('Votre randonnée n\'a pas été validée')
            ->view('emails.randonnee-refusee');
    }
}