<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\ReservaConfirmada;
use App\Models\User;

class ReservaRestaurante extends Mailable
{
    use Queueable, SerializesModels;

    public $reserva;
    public $cliente;

    public function __construct(ReservaConfirmada $reserva)
    {
        $this->reserva = $reserva;
        $this->cliente = User::find($reserva->user_id); // Obtener datos del cliente
    }

    public function build()
    {
        return $this->subject('Nueva reserva en tu restaurante')
                    ->view('emails.reserva-restaurante')
                    ->with([
                        'reserva' => $this->reserva,
                        'cliente' => $this->cliente, // Pasamos el cliente a la vista
                    ]);
    }
}
