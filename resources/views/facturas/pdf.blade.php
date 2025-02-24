<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Factura</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { width: 80%; margin: auto; }
        .header { text-align: center; }
        .details { margin-top: 20px; }
        .footer { margin-top: 30px; font-size: 12px; text-align: center; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Factura</h2>
            <p>Número: {{ $factura->id }}</p>
            <p>Fecha: {{ $factura->created_at->format('d/m/Y') }}</p>
        </div>
        <div class="details">
            <p><strong>Restaurante:</strong> {{ $factura->restaurante }}</p>
            <p><strong>Reserva ID:</strong> {{ $factura->reserva_id }}</p>
            <p><strong>Monto:</strong> 1.00€</p>
        </div>
        <div class="footer">
            <p>Gracias por usar nuestra plataforma.</p>
        </div>
    </div>
</body>
</html>
