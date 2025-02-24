@extends('layouts.app')

@section('title', 'Inicio')

@section('content')

@guest
@else
    @if (Auth::user()->role && Auth::user()->role == 'admin')
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addProductModal">Añadir Restaurante</button>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#restoreProductModal">Restaurar Restaurante</button>
    @endif
@endguest

<div class="container mt-5">
    <div class="row">
        @if ($products->isEmpty())
            <p class="text-center text-danger">No hay restaurantes disponibles.</p>
        @endif

        @foreach ($products as $product)
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <img src="{{ asset('img/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 150px; object-fit: cover;">
                <div class="card-body text-center">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">{{ $product->category->name ?? 'Sin categoría' }}</p>
                    <p class="card-text">{{ $product->ubication ?? 'Sin ubicación' }}</p>
                    <p class="card-text">Precio Medio: {{ $product->total_price }}€</p>
                    <p class="card-text">Aforo Disponible: {{ $product->capacity }} personas</p>

                    @if (Auth::guest())
                        <a href="{{ route('login') }}" class="btn btn-success">Reservar Ahora</a>
                    @elseif (Auth::check() && Auth::user()->role == 'user')
                        <button class="btn btn-success open-reservation-modal" 
                                data-bs-toggle="modal" 
                                data-bs-target="#reserveModal" 
                                data-restaurante="{{ $product->name }}" 
                                data-restaurante-id="{{ $product->id }}">
                            Reservar Ahora
                        </button>
                    @elseif(Auth::check() && Auth::user()->role == 'admin')
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Ocultar</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- 🟢 MODAL DE RESERVA -->
<div class="modal fade" id="reserveModal" tabindex="-1" aria-labelledby="reserveModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reserveModalLabel">Reserva tu mesa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="reservationForm" action="{{ route('reservas.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="restaurante" id="restaurante">
                    
                    <div class="mb-3">
                        <label for="reservationDate" class="form-label">Fecha de Reserva</label>
                        <input type="date" class="form-control" id="reservationDate" name="fecha" required min="">
                    </div>

                    <div class="mb-3">
                        <label for="timeSlot" class="form-label">Hora</label>
                        <select class="form-select" id="timeSlot" name="hora" required></select>
                    </div>

                    <div class="mb-3">
                        <label for="numPeople" class="form-label">Número de Personas</label>
                        <input type="number" class="form-control" id="numPeople" name="num_comensales" min="1" max="10" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Reservar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- 🟢 SCRIPTS DE RESERVA -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const reservationDate = document.getElementById('reservationDate');
    const timeSlot = document.getElementById('timeSlot');

    // Establecer la fecha mínima (hoy)
    const today = new Date().toISOString().split('T')[0];
    reservationDate.setAttribute('min', today);

    // 🟢 Evento para actualizar datos en el modal antes de abrirlo
    document.querySelectorAll('.open-reservation-modal').forEach(button => {
        button.addEventListener('click', function() {
            const restaurantId = this.getAttribute('data-restaurante-id');
            document.getElementById('restaurante').value = restaurantId;
        });
    });

    // 🟢 Evento para cargar los horarios cuando se selecciona una fecha
    reservationDate.addEventListener('change', function () {
        const selectedDate = this.value;
        const restaurantId = document.getElementById('restaurante').value;
        loadAvailableTimes(selectedDate, restaurantId);
    });

    // 🟢 Función para cargar horarios disponibles desde el backend
    async function loadAvailableTimes(selectedDate, restaurantId) {
        timeSlot.innerHTML = ''; // Limpiar opciones previas

        try {
            const response = await fetch(`/get-schedule?restaurant_id=${restaurantId}&date=${selectedDate}`);
            if (!response.ok) throw new Error('Error al obtener horarios');

            const data = await response.json();
            const openingTime = parseInt(data.opening_time.split(':')[0]);
            const closingTime = parseInt(data.closing_time.split(':')[0]);
            const unavailableHours = data.unavailable_hours || [];

            // Crear opciones de horario
            for (let hour = openingTime; hour < closingTime; hour++) {
                const timeSlotValue = `${hour}:00`;
                if (!unavailableHours.includes(timeSlotValue)) {
                    const option = document.createElement('option');
                    option.value = timeSlotValue;
                    option.textContent = `${hour}:00 - ${hour + 1}:00`;
                    timeSlot.appendChild(option);
                }
            }
        } catch (error) {
            console.error('Error al obtener los horarios:', error);
        }
    }
});
</script>

@endsection
