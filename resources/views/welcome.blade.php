<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MesaYa - Reserva tu mesa</title>

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

    <!-- Contenido Principal -->
    <div class="container mt-5">
        <div class="row">
            @if ($restaurants->isEmpty())
                <p class="text-center text-danger">No hay restaurantes disponibles.</p>
            @endif

            @foreach ($restaurants as $restaurant)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <img src="{{ asset('img/' . $restaurant->image) }}" class="card-img-top"
                            alt="{{ $restaurant->name }}" style="height: 150px; object-fit: cover;">
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ $restaurant->name }}</h5>
                            <p class="card-text">{{ $restaurant->category->name }}</p>
                            <p class="card-text">Precio Medio: {{ $restaurant->total_price }}€</p>

                            @guest
                                <a href="{{ route('login') }}" class="btn btn-primary">Reservar Ahora</a>
                            @else
                                @if (Auth::user()->role && Auth::user()->role->role_name == 'Cliente')
                                    <a href="{{ url('/reservas') }}" class="btn btn-success">Reservar Ahora</a>
                                @elseif(Auth::user()->role && Auth::user()->role->role_name == 'Administrador')
                                    <a href="{{ url('/admin/dashboard') }}" class="btn btn-warning">Administrar Restaurantes</a>
                                @endif
                            @endguest
                        </div>
                    </div>
                </div>
            @endforeach
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

</body>
</html>
