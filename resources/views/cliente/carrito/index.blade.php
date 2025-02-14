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
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/x-icon">


    <!-- Agregar los enlaces de FullCalendar y Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js" defer></script>
    <!-- Agregar Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" defer></script>
</head>


<body>


    <!-- Header Mejorado -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <!-- Logo de la empresa al lado del texto "MesaYa" -->
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
                    @else
                    @if (Auth::user()->role && Auth::user()->role == 'user')
                    <li class="nav-item">
    <a class="btn btn-warning me-2 position-relative" href="{{ route('carrito.index') }}">
    📆 Confirmar Reservas
        @if($reservasPendientes > 0)
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                {{ $reservasPendientes }}
                <span class="visually-hidden">reservas pendientes</span>
            </span>
        @endif
    </a>
</li>
    @endif
    @endguest

                    @guest
                    <li class="nav-item">
                        <a class="btn btn-primary me-2" href="{{ route('login') }}">Iniciar Sesión</a>
                        <a class="btn btn-secondary" href="{{ route('register') }}">Registrarse</a>
                    </li>
                    @else
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

<!-- Encabezado -->
<div class="container py-4">
    <div class="text-center mb-4">
        <h2 class="fw-bold text-primary">📆 Confirmar Reservas</h2>
        <p class="text-muted">Revisa y gestiona tus reservas antes de confirmarlas.</p>
    </div>

    <!-- Tabla de Reservas -->
    <div class="table-responsive shadow-sm rounded">
        <table class="table table-hover table-bordered text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th>🍽️ Restaurante</th>
                    <th>📆 Fecha</th>
                    <th>⏰ Hora</th>
                    <th>👥 Nº Comensales</th>
                    <th>⚙️ Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($reservas as $reserva)
                    <tr>
                        <td class="fw-semibold">{{ $reserva->restaurante }}</td>
                        <td>{{ $reserva->fecha }}</td>
                        <td>{{ $reserva->hora }}</td>
                        <td>{{ $reserva->num_comensales }}</td>
                        <td>
                            <!-- Botón para abrir el modal -->
                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmarEliminacion" 
                                onclick="setReservaId('{{ $reserva->id }}')">
                                <i class="bi bi-trash3"></i> Eliminar
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">No tienes reservas en tu carrito.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal de Confirmación -->
<div class="modal fade" id="confirmarEliminacion" tabindex="-1" aria-labelledby="confirmarEliminacionLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-danger">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="confirmarEliminacionLabel">⚠️ Confirmar Eliminación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                ¿Estás seguro de que deseas eliminar esta reserva? Esta acción no se puede deshacer.
            </div>
            <div class="modal-footer">
                <form id="formEliminarReserva" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Sí, eliminar</button>
                </form>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<!-- Script para establecer el ID dinámicamente -->
<script>
    function setReservaId(id) {
        const form = document.getElementById('formEliminarReserva');
        form.action = `/carrito/reserva/${id}`;
    }
</script>

<!-- Botón de Confirmar Reserva -->
<div class="text-center mt-4">
    @if($reservas->isNotEmpty())
        <form method="POST" action="{{ route('carrito.confirmar') }}">
            @csrf
            <button type="submit" class="btn btn-success btn-lg">
                🟢 Confirmar Reserva
            </button>
        </form>
   
    @endif
</div>
