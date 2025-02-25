@extends('layouts.app')

@section('title', 'Confirmar Reservas')

@section('content')

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
                    <td class="fw-semibold">{{ \App\Models\Product::find($reserva->restaurante)->name ?? 'Restaurante no encontrado' }}</td>
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
    <!-- 🟢 PAGINACIÓN MEJORADA -->
@if($reservas->hasPages())
<div class="d-flex justify-content-center align-items-center mt-4">
    <nav aria-label="Paginación">
        <ul class="pagination pagination-sm mb-0">
            {!! $reservas->links('pagination::bootstrap-4') !!}
        </ul>
    </nav>
</div>
@endif
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
@endsection
