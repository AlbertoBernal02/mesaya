<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\ReservaConfirmada;
use App\Models\Factura;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ReservaRestaurante extends Mailable
{
    use Queueable, SerializesModels;

    public $reserva;
    public $cliente;
    public $factura;
    public $pdfPath;

    public function __construct(ReservaConfirmada $reserva)
    {
        $this->reserva = $reserva;
        $this->cliente = User::find($reserva->user_id);

        // Crear la factura en la BD
        $this->factura = Factura::create([
            'reserva_id' => $reserva->id,
            'restaurante' => $reserva->restaurante,
            'monto' => 1.00,
        ]);

        // Definir la carpeta donde se guardará el PDF
        $facturasPath = storage_path('app/public/facturas/');

        // Asegurar que la carpeta exista
        if (!File::exists($facturasPath)) {
            File::makeDirectory($facturasPath, 0755, true);
        }

        // Definir la ruta del archivo de la factura
        $this->pdfPath = $facturasPath . "factura_{$this->factura->id}.pdf";

        // Generar el PDF
        $pdf = Pdf::loadView('facturas.pdf', ['factura' => $this->factura]);

        // Guardar el PDF
        file_put_contents($this->pdfPath, $pdf->output());
    }

    public function build()
    {
        return $this->subject('Nueva reserva en tu restaurante')
                    ->view('emails.reserva-restaurante')
                    ->with([
                        'reserva' => $this->reserva,
                        'cliente' => $this->cliente,
                    ])
                    ->attach($this->pdfPath, [ // Aquí usamos la ruta corregida
                        'as' => "factura_{$this->factura->id}.pdf",
                        'mime' => 'application/pdf',
                    ]);
    }
}
