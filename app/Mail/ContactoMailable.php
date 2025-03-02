<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactoMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $datos;

    public function __construct($datos)
    {
        $this->datos = $datos;
    }

    public function build()
    {
        // Devolvuelve el asunto, la vista del cuerpo del correo y los datos
        return $this->subject($this->datos['asunto'])
            ->view('emails.contacto')
            ->with('datos', $this->datos);
    }
}