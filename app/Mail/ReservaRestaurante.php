<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\ReservaConfirmada;
use App\Models\Factura;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;

class ReservaRestaurante extends Mailable
{
    use Queueable, SerializesModels;

    public $reserva;
    public $cliente;
    public $factura;
    public $pdfPath;
    public $publicPath;

    public function __construct(ReservaConfirmada $reserva)
    {
        $this->reserva = $reserva;
        $this->cliente = User::find($reserva->user_id);

        // Calcula el monto a cobrar (1€ por cada comensal)
        $montoTotal = $reserva->num_comensales * 1.00;

        // Crea la factura en la BBDDD
        $this->factura = Factura::create([
            'reserva_id' => $reserva->id,
            'restaurante' => $reserva->restaurante,
            'monto' => $montoTotal,
        ]);

        // Asegura que la carpeta "public/facturas/" existe
        $facturasPath = public_path('facturas/');

        if (!File::exists($facturasPath)) {
            File::makeDirectory($facturasPath, 0755, true);
        }

        // Define la ruta del archivo en "public/facturas/"
        $this->pdfPath = $facturasPath . "factura_{$this->factura->id}.pdf";

        // URL pública de la factura
        $this->publicPath = asset("facturas/factura_{$this->factura->id}.pdf");

        // Genera el PDF
        $pdf = Pdf::loadView('facturas.pdf', ['factura' => $this->factura, 'reserva' => $this->reserva]);

        // Guarda el PDF en "public/facturas/"
        file_put_contents($this->pdfPath, $pdf->output());
    }

    public function build()
    {
        // Devolvuelve el asunto, la vista del cuerpo del correo y los datos
        return $this->subject('Nueva reserva en tu restaurante')
            ->view('emails.reserva-restaurante')
            ->with([
                'reserva' => $this->reserva,
                'cliente' => $this->cliente,
                'factura_url' => $this->publicPath, // URL pública para descargar
            ])
            ->attach($this->pdfPath, [
                'as' => "factura_{$this->factura->id}.pdf",
                'mime' => 'application/pdf',
            ]);
    }
}