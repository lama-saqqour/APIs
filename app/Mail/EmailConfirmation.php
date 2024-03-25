<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;


class EmailConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $confermationCode;

    public function __construct($confermationCode)
    {
        $this->confermationCode = $confermationCode;
    }


    public function build () {

        return $this->view('email.confirmation', ['code' => $this->confermationCode])
        ->subject('Email Confirmation');
    }
}
