@extends('layouts.app')


@section('title', __('reservas_confirmadas'))


@section('content')
    <div class="container py-4">
        <h2 class="fw-bold text-primary text-center">📆 {{ __('reservas_confirmadas') }}</h2>


        @if ($reservas->isEmpty())
            <p class="text-center text-muted">{{ __('no_reservas_confirmadas') }}</p>
        @else
            <div class="table-responsive shadow-sm rounded mt-4">
                <table class="table table-hover table-bordered text-center align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>👤 {{ __('cliente') }}</th>
                            <th>📆 {{ __('fecha') }}</th>
                            <th>⏰ {{ __('hora') }}</th>
                            <th>👥 {{ __('num_comensales') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reservas as $reserva)
                            <tr>
                                <td class="fw-semibold">{{ $reserva->user->name ?? __('usuario_desconocido') }}</td>
                                <td>{{ $reserva->fecha }}</td>
                                <td>{{ $reserva->hora }}</td>
                                <td>{{ $reserva->num_comensales }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


            <!-- Paginación -->
            <div class="d-flex justify-content-center align-items-center mt-4">
                <nav aria-label="Paginación">
                    <ul class="pagination pagination-sm mb-0">
                        {!! $reservas->links('pagination::bootstrap-4') !!}
                    </ul>
                </nav>
            </div>
        @endif
    </div>
@endsection
