<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MesaYa - Sobre Nosotros</title>

    {{-- Vite para importar bootstrap --}}
    @vite(['resources/js/app.js', 'resources/sass/app.scss'])

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&family=Montserrat:wght@400&display=swap"
        rel="stylesheet">
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('../../img/logo.png') }}" type="image/x-icon"> <!-- Cambia el nombre de la imagen según corresponda -->
</head>

<body>

   <!-- Header Mejorado -->
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <!-- Logo de la empresa al lado del texto "MesaYa" -->
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" style="height: 40px; margin-right: 10px;"> <!-- Cambia el nombre de la imagen según corresponda -->
            MesaYa
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Inicio</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/nosotros') }}">Sobre Nosotros</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/contacto') }}">Contacto</a></li>

                    @guest
                        <li class="nav-item">
                            <a class="btn btn-primary me-2" href="{{ route('login') }}">Iniciar Sesión</a>
                            <a class="btn btn-secondary" href="{{ route('register') }}">Registrarse</a>
                        </li>
                    @else
                        @if (Auth::user()->role && Auth::user()->role->role_name == 'Cliente')
                            <li class="nav-item">
                                <a class="btn btn-accent" href="{{ url('/reservas') }}">Reservar Ahora</a>
                            </li>
                        @elseif(Auth::user()->role && Auth::user()->role->role_name == 'Administrador')
                            <li class="nav-item">
                                <a class="btn btn-warning" href="{{ url('/') }}">Administrar Restaurantes</a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a class="btn btn-danger" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                               Cerrar Sesión
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    <!-- Formulario de Contacto -->
    <div class="container mt-5">
        <h1>Contacto</h1>
        <p>Si tienes alguna pregunta, por favor completa el siguiente formulario y nos pondremos en contacto contigo lo antes posible.</p>
        
        <!-- Formulario -->
        <form action="#" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
            </div>
            <div class="mb-3">
                <label for="asunto" class="form-label">Asunto</label>
                <input type="text" class="form-control" id="asunto" name="asunto" required>
            </div>
            <div class="mb-3">
                <label for="mensaje" class="form-label">Mensaje</label>
                <textarea class="form-control" id="mensaje" name="mensaje" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Enviar Mensaje</button>
        </form>
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

</body>
</html>
