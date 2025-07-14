<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CorreoContacto extends Mailable
{
    use Queueable, SerializesModels;
    public $datos;
    /**
     * Create a new message instance.
     */
    public function __construct($datos)
    {
        //
        $this->datos = $datos;
    }

    public function build(): Mailable
    {
        return $this->markdown('emails.contacto')->subject('Nuevo mensaje de contacto');
    }
}
