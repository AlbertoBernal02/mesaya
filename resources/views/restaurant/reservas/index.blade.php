@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="fw-bold text-primary text-center">📆 Reservas Confirmadas</h2>

    @if($reservas->isEmpty())
        <p class="text-center text-muted">No hay reservas confirmadas en este momento.</p>
    @else
        <div class="table-responsive shadow-sm rounded mt-4">
            <table class="table table-hover table-bordered text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>👤 Cliente</th>
                        <th>📆 Fecha</th>
                        <th>⏰ Hora</th>
                        <th>👥 Nº Comensales</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reservas as $reserva)
                        <tr>
                            <td class="fw-semibold">{{ $reserva->user->name ?? 'Usuario desconocido' }}</td>
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
