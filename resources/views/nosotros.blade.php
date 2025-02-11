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

 <!-- Imagen y Texto sobre nuestra empresa -->
<div class="d-flex flex-column min-vh-100">
    <!-- Gif alargado que ocupa todo el ancho con altura reducida -->
    <div class="w-100">
        <img src="../../img/anuncio.gif" alt="GIF de ejemplo" style="width: 100%; height: 35vh;">
    </div>

    <!-- Texto sobre la empresa centrado -->
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 40vh; margin-top: 5vh;">
        <div class="text-center">
            <h1>Somos una plataforma que conecta a los amantes de la gastronomía con los mejores restaurantes locales. Nuestra misión es facilitar reservas y mejorar la experiencia de comer fuera de casa, brindando un servicio cómodo, rápido y eficiente para todos.</h1>
        </div>
    </div>

    <!-- Título adicional "Disfruta de nuestras ventajas" -->
    <div class="container text-center mb-4" style= "min-height: 20vh";>
        <h2>Disfruta de nuestras ventajas</h2>
    </div>

 <!-- Tres Cards con diseño mejorado usando Bootstrap -->
<div class="container mt-5">
    <div class="row justify-content-center">
        <!-- Card 1 -->
        <div class="col-md-3 mb-4">
            <div class="card border-0 shadow-lg hover-card">
                <div class="card-inner">
                    <div class="card-front">
                        <img src="{{ asset('../../img/reloj.png') }}" class="card-img-top" alt="Card 1">
                        <div class="card-body text-center">
                            <h5 class="card-title">¿Tienes prisa?</h5>
                        </div>
                    </div>
                    <div class="card-back d-flex justify-content-center align-items-center text-center">
                        <div class="card-body">
                            <p class="card-text">Ahorrate el ir al restaurante y que no haya mesa y tengas que comer tarde. ¡Mesaya tiene la solución al problema!.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="col-md-3 mb-4">
            <div class="card border-0 shadow-lg hover-card">
                <div class="card-inner">
                    <div class="card-front">
                        <img src="{{ asset('../../img/vip.png') }}" class="card-img-top" alt="Card 2">
                        <div class="card-body text-center">
                            <h5 class="card-title">Fidelidad</h5>
                        </div>
                    </div>
                    <div class="card-back d-flex justify-content-center align-items-center text-center">
                        <div class="card-body">
                            <p class="card-text">Tendrás más opciones de eventos organizados por nosotros y descuentos en nuestros restaurantes.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="col-md-3 mb-4">
            <div class="card border-0 shadow-lg hover-card">
                <div class="card-inner">
                    <div class="card-front">
                        <img src="{{ asset('../../img/ahorro.png') }}" class="card-img-top" alt="Card 3">
                        <div class="card-body text-center">
                            <h5 class="card-title">Ofertas Exclusivas</h5>
                        </div>
                    </div>
                    <div class="card-back d-flex justify-content-center align-items-center text-center">
                        <div class="card-body">
                            <p class="card-text">Accede a promociones y descuentos exclusivos solo para usuarios de MesaYa.</p>
                        </div>
                    </div>
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

</body>
</html>

