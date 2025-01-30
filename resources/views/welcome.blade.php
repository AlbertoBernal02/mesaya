<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MesaYa - Reserva tu mesa</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&family=Montserrat:wght@400&display=swap" rel="stylesheet">
</head>
<body>

    <!-- Header Mejorado -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">MesaYa</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/nosotros') }}">Sobre Nosotros</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/contacto') }}">Contacto</a></li>
                    <li class="nav-item">
                        <a class="btn btn-accent" href="{{ url('/reservas') }}">Reservar Ahora</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenido Principal -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <img src="{{ asset('img/bilio.jpg') }}" class="card-img-top" alt="Plato Especial">
                    <div class="card-body text-center">
                        <h5 class="card-title">Reserva en los mejores restaurantes</h5>
                        <p class="card-text">Encuentra y reserva tu mesa en los restaurantes más exclusivos de la ciudad con MesaYa.</p>
                        <a href="{{ url('/reservas') }}" class="btn btn-primary">Reservar Ahora</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Mejorado -->
    <footer class="footer mt-5">
        <div class="container text-center">
            <p>&copy; 2025 MesaYa - Todos los derechos reservados.</p>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="{{ url('/nosotros') }}">Sobre Nosotros</a></li>
                <li class="list-inline-item"><a href="{{ url('/contacto') }}">Contacto</a></li>
                <li class="list-inline-item"><a href="{{ url('/reservas') }}">Reservas</a></li>
            </ul>
            <p>
                <a href="#" class="me-2"><i class="bi bi-facebook"></i></a>
                <a href="#" class="me-2"><i class="bi bi-instagram"></i></a>
                <a href="#" class="me-2"><i class="bi bi-twitter"></i></a>
            </p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
