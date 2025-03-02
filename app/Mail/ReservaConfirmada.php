<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReservaConfirmada extends Mailable
{
    use Queueable, SerializesModels;

    public $reservasConfirmadas;

    public function __construct(array $reservasConfirmadas)
    {
        $this->reservasConfirmadas = $reservasConfirmadas;
    }

    public function build()
    {
        // Devolvuelve el asunto, la vista del cuerpo del correo y los datos
        return $this->subject('Confirmación de Reservas')
            ->view('emails.reserva_confirmada')
            ->with([
                'reservasConfirmadas' => $this->reservasConfirmadas,
            ]);
    }
}