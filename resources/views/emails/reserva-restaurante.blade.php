<!DOCTYPE html>
<html>
<head>
    <title>Nueva Reserva en tu Restaurante</title>
</head>
<body>
    <h1>📅 Nueva Reserva Recibida</h1>
    
    <p>Hola, tienes una nueva reserva en tu restaurante <strong>{{ $reserva->restaurante }}</strong>.</p>
    
    <h3>👤 Información del Cliente:</h3>
    <p><strong>Nombre:</strong> {{ $cliente->name }}</p>
    <p><strong>Correo:</strong> {{ $cliente->email }}</p>

    <h3>📆 Detalles de la Reserva:</h3>
    <p><strong>Fecha:</strong> {{ $reserva->fecha }}</p>
    <p><strong>Hora:</strong> {{ $reserva->hora }}</p>
    <p><strong>Número de Comensales:</strong> {{ $reserva->num_comensales }}</p>
    
    <p>Revisa tu panel de administración para gestionar las reservas.</p>

    <p>Saludos,<br>
    <strong>Equipo Lumiere</strong></p>
</body>
</html>
