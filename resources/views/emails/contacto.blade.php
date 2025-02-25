<!DOCTYPE html>
<html>
<head>
    <title>Nuevo mensaje de contacto</title>
</head>
<body>
    <h2>Nuevo mensaje de contacto</h2>
    <p><strong>Nombre:</strong> {{ $datos['nombre'] }}</p>
    <p><strong>Correo Electrónico:</strong> {{ $datos['email'] }}</p>
    <p><strong>Asunto:</strong> {{ $datos['asunto'] }}</p>
    <p><strong>Mensaje:</strong></p>
    <p>{{ $datos['mensaje'] }}</p>
</body>
</html>
