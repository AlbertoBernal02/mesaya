<!DOCTYPE html>
<html>
<head>
    <title>Confirmación de Reservas</title>
</head>
<body>
    <h1>Reservas Confirmadas</h1>
    <p>¡Gracias por confirmar tus reservas con nosotros!</p>

    @foreach ($reservasConfirmadas as $reserva)
        <p><strong>Restaurante:</strong> {{ $reserva->restaurante }}</p>
        <p><strong>Fecha:</strong> {{ $reserva->fecha }}</p>
        <p><strong>Hora:</strong> {{ $reserva->hora }}</p>
        <p><strong>Número de Comensales:</strong> {{ $reserva->num_comensales }}</p>
        <hr>
    @endforeach
</body>
</html>