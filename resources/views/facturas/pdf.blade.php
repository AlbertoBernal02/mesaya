<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Factura</title>
    <link rel="stylesheet" href="file://{{ public_path('css/pdf.css') }}">

</head>

<body>
    <div class="container">
        <div class="header">
            <h2>Factura</h2>
            <p>Número: {{ $factura->id }}</p>
            <p>Fecha: {{ $factura->created_at->format('d/m/Y') }}</p>
        </div>

        <div class="details">
            <div>
                <h3>Datos del Cliente</h3>
                <p><strong>Nombre:</strong> {{ $factura->restaurante }}</p>
            </div>
            <div>
                <h3>Datos de la Empresa</h3>
                <p><strong>Nombre:</strong> MesaYa</p>
                <p><strong>Dirección:</strong> Calle Campana 2, Sevilla</p>
                <p><strong>Mail:</strong> adminmesaya@yopmail.com</p>
            </div>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>Concepto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Comensales</td>
                    <td>{{ $reserva->num_comensales }}</td>
                    <td>1€</td>
                    <td>{{ number_format($reserva->num_comensales * 1, 2) }}€</td>
                </tr>
            </tbody>
        </table>

        <div class="section">
            <p><strong>Subtotal:</strong> {{ number_format($reserva->num_comensales * 1, 2) }}€</p>
            <p><strong>IVA 21%:</strong> {{ number_format(($reserva->num_comensales * 1) * 0.21, 2) }}€</p>
            <h3><strong>Total:</strong> {{ number_format(($reserva->num_comensales * 1) * 1.21, 2) }}€</h3>
        </div>

        <div class="footer">
            <p>Gracias por usar nuestra plataforma.</p>
        </div>
    </div>
</body>

</html>