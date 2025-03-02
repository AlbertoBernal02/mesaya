@extends('layouts.app') <!-- Extiende la plantilla 'app' -->

@section('title', __('confirmar_reservas')) <!-- Establece el título de la página -->

@section('content')

<!-- Encabezado -->
<div class="container py-4">
    <div class="text-center mb-4">
        <h2 class="fw-bold text-primary">📆 {{ __('confirmar_reservas') }}</h2> <!-- Título de la página -->
        <p class="text-muted">{{ __('revisar_gestionar_reservas') }}</p> <!-- Subtítulo de la página -->
    </div>

    <!-- Tabla de Reservas -->
    <div class="table-responsive shadow-sm rounded">
        <table class="table table-hover table-bordered text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th>🍽️ {{ __('restaurante') }}</th> <!-- Columna de restaurante -->
                    <th>📆 {{ __('fecha') }}</th> <!-- Columna de fecha -->
                    <th>⏰ {{ __('hora') }}</th> <!-- Columna de hora -->
                    <th>👥 {{ __('num_comensales') }}</th> <!-- Columna de número de comensales -->
                    <th>⚙️ {{ __('acciones') }}</th> <!-- Columna de acciones -->
                </tr>
            </thead>
            <tbody>
                @forelse ($reservas as $reserva)
                <tr>
                    <td class="fw-semibold">
                        {{ \App\Models\Product::find($reserva->restaurante)->name ?? __('restaurante_no_encontrado') }} <!-- Nombre del restaurante -->
                    </td>
                    <td>{{ $reserva->fecha }}</td> <!-- Fecha de la reserva -->
                    <td>{{ $reserva->hora }}</td> <!-- Hora de la reserva -->
                    <td>{{ $reserva->num_comensales }}</td> <!-- Número de comensales -->
                    <td>
                        <!-- Botón para abrir el modal -->
                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                            data-bs-target="#confirmarEliminacion" onclick="setReservaId('{{ $reserva->id }}')">
                            <i class="bi bi-trash3"></i> {{ __('eliminar') }} <!-- Botón para eliminar la reserva -->
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">{{ __('no_tienes_reservas') }}</td> <!-- Mensaje si no hay reservas -->
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <!-- 🟢 PAGINACIÓN MEJORADA -->
    @if ($reservas->hasPages())
    <div class="d-flex justify-content-center align-items-center mt-4">
        <nav aria-label="Paginación">
            <ul class="pagination pagination-sm mb-0">
                {!! $reservas->links('pagination::bootstrap-4') !!} <!-- Paginación -->
            </ul>
        </nav>
    </div>
    @endif
</div>

<!-- Modal de Confirmación -->
<div class="modal fade" id="confirmarEliminacion" tabindex="-1" aria-labelledby="confirmarEliminacionLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-danger">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="confirmarEliminacionLabel">⚠️ {{ __('confirmar_eliminacion') }}</h5> <!-- Título del modal -->
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="{{ __('cerrar') }}"></button> <!-- Botón para cerrar el modal -->
            </div>
            <div class="modal-body">
                {{ __('mensaje_confirmar_eliminacion') }} <!-- Mensaje de confirmación de eliminación -->
            </div>
            <div class="modal-footer">
                <form id="formEliminarReserva" method="POST" action="">
                    @csrf <!-- Token CSRF para seguridad -->
                    @method('DELETE') <!-- Método DELETE para eliminar -->
                    <button type="submit" class="btn btn-danger">{{ __('si_eliminar') }}</button> <!-- Botón para confirmar eliminación -->
                </form>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('cancelar') }}</button> <!-- Botón para cancelar -->
            </div>
        </div>
    </div>
</div>

<!-- Script para establecer el ID dinámicamente -->
<script>
    function setReservaId(id) {
        const form = document.getElementById('formEliminarReserva');
        form.action = `/carrito/reserva/${id}`; // Establecer la acción del formulario con el ID de la reserva
    }
</script>

<!-- Botón de Confirmar Reserva -->
<div class="text-center mt-4">
    @if ($reservas->isNotEmpty())
    <form method="POST" action="{{ route('carrito.confirmar') }}">
        @csrf // Token CSRF para seguridad
        <button type="submit" class="btn btn-success btn-lg">
            🟢 {{ __('confirmar_reserva') }} <!-- Botón para confirmar la reserva -->
        </button>
    </form>
    @endif
</div>
@endsection