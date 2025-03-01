@extends('layouts.app') <!-- Extiende la plantilla 'app' -->

@section('title', __('reservas_confirmadas')) <!-- Establece el título de la página -->

@section('content')
    <div class="container py-4"></div>
        <h2 class="fw-bold text-primary text-center">📆 {{ __('reservas_confirmadas') }}</h2> <!-- Título de la página -->

        @if ($reservas->isEmpty())
            <p class="text-center text-muted">{{ __('no_reservas_confirmadas') }}</p> <!-- Mensaje si no hay reservas confirmadas -->
        @else
            <div class="table-responsive shadow-sm rounded mt-4">
                <table class="table table-hover table-bordered text-center align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>👤 {{ __('cliente') }}</th> <!-- Columna de cliente -->
                            <th>📆 {{ __('fecha') }}</th> <!-- Columna de fecha -->
                            <th>⏰ {{ __('hora') }}</th> <!-- Columna de hora -->
                            <th>👥 {{ __('num_comensales') }}</th> <!-- Columna de número de comensales -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reservas as $reserva)
                            <tr>
                                <td class="fw-semibold">{{ $reserva->user->name ?? __('usuario_desconocido') }}</td> <!-- Nombre del cliente -->
                                <td>{{ $reserva->fecha }}</td> <!-- Fecha de la reserva -->
                                <td>{{ $reserva->hora }}</td> <!-- Hora de la reserva -->
                                <td>{{ $reserva->num_comensales }}</td> <!-- Número de comensales -->
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            <div class="d-flex justify-content-center align-items-center mt-4">
                <nav aria-label="Paginación">
                    <ul class="pagination pagination-sm mb-0"></ul>
                        {!! $reservas->links('pagination::bootstrap-4') !!} <!-- Paginación -->
                    </ul>
                </nav>
            </div>
        @endif
    </div>
@endsection
