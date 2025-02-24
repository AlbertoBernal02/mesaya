<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\ReservaConfirmada;

class ReservaRestaurante extends Mailable
{
    use Queueable, SerializesModels;

    public $reserva;

    public function __construct(ReservaConfirmada $reserva)
    {
        $this->reserva = $reserva;
    }

    public function build()
    {
        return $this->subject('Nueva reserva en tu restaurante')
                    ->view('emails.reserva-restaurante')
                    ->with([
                        'reserva' => $this->reserva,
                    ]);
    }
}
