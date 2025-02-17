<!-- resources/views/partials/header.blade.php -->
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" style="height: 40px; margin-right: 10px;">
            MesaYa
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Inicio</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('nosotros') }}">Sobre Nosotros</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('contacto') }}">Contacto</a></li>

                @guest
                    <li class="nav-item">
                        <a class="btn btn-primary me-2" href="{{ route('login') }}">Iniciar Sesión</a>
                        <a class="btn btn-secondary" href="{{ route('register') }}">Registrarse</a>
                    </li>
                @else
                    @if (Auth::user()->role == 'user')
                        <li class="nav-item">
                            <a class="btn btn-warning me-2 position-relative" href="{{ route('carrito.index') }}">
                                📆 Confirmar Reservas
                                @if($reservasPendientes > 0)
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        {{ $reservasPendientes }}
                                    </span>
                                @endif
                            </a>
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
