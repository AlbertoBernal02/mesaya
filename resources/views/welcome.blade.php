@extends('layouts.app')

@section('title', 'Inicio')

@section('content')


    @guest
    @else
        @if (Auth::user()->role && Auth::user()->role == 'admin')
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addProductModal">Añadir Restaurante</button>


            <!-- Modal para añadir producto -->
            <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addProductModalLabel">Añadir Producto</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nombre del Producto</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>

                                <div class="mb-3">
                                    <label for="categories_id" class="form-label">Categoría</label>
                                    <select class="form-select" id="categories_id" name="categories_id" required>
                                        <option value="">Cargando categorías...</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="image" class="form-label">Imagen</label>
                                    <input type="file" class="form-control" id="image" name="image">
                                </div>
                                
                                <div class="mb-3">
                                    <label for="ubication" class="form-label">Ubicación</label>
                                    <input type="text" class="form-control" id="ubication" name="ubication" required>
                                </div>

                                <div class="mb-3">
                                    <label for="total_price" class="form-label">Precio Medio</label>
                                    <input type="number" class="form-control" id="total_price" name="total_price" required>
                                </div>

                                <div class="mb-3">
                                    <label for="capacity" class="form-label">Aforo</label>
                                    <input type="number" class="form-control" id="capacity" name="capacity" required>
                                </div>


                                <button type="submit" class="btn btn-primary">Añadir Producto</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endguest


    <!-- Contenido Principal -->
    <div class="container mt-5">
        <div class="row">
            @if ($products->isEmpty())
            <p class="text-center text-danger">No hay restaurantes disponibles.</p>
            @endif


            @foreach ($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <img src="{{ asset('img/' . $product->image) }}" class="card-img-top"
                        alt="{{ $product->name }}" style="height: 150px; object-fit: cover;">
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->category->name ?? 'Sin categoría' }}</p>
                        <p class="card-text">{{ $product->ubication ?? 'Sin ubicación' }}</p>
                        <p class="card-text">Precio Medio: {{ $product->total_price }}€</p>
                        <p class="card-text">Aforo Disponible: {{ $product->capacity }} personas</p>
                        


                        @guest
                       
                        @else
                        @if (Auth::user()->role && Auth::user()->role == 'user')
                        <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#reserveModal" data-restaurante="{{ $product->name }}" data-restaurante-id="{{ $product->id }}">Reservar Ahora</a>
                        @elseif(Auth::user()->role && Auth::user()->role == 'admin')


                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning">Editar</a>


                        <!-- Botón para abrir el modal de confirmación -->
<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmarEliminacion"
data-id="{{ $product->id }}" data-name="{{ $product->name }}">
Borrar
</button>


                        @endif
                        @endguest
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>


    <!-- Modal de Reserva Mejorado -->
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
    <input type="date" class="form-control" id="reservationDate" name="fecha" required min="" />
</div>




<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Obtener la fecha actual en formato YYYY-MM-DD
        const today = new Date().toISOString().split('T')[0];  // Formato "YYYY-MM-DD"
        // Establecer la fecha mínima en el campo de fecha
        document.getElementById('reservationDate').setAttribute('min', today);
    });
</script>
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


    <script>
        document.addEventListener('DOMContentLoaded', function () {
    const reservationDate = document.getElementById('reservationDate');
    const timeSlot = document.getElementById('timeSlot');
   
    reservationDate.addEventListener('change', function () {
        populateTimeSlots(this.value);
    });

    function populateTimeSlots(selectedDate) {
        const now = new Date();
        const selectedDay = new Date(selectedDate);
        timeSlot.innerHTML = '';  // Limpiar las opciones previas
        
        const restaurantId = document.getElementById('restaurante').value; // Obtener el ID del restaurante seleccionado

        // Hacer la llamada a la API para obtener el horario del restaurante
        fetch(`/get-schedule?restaurant_id=${restaurantId}`)
            .then(response => response.json())
            .then(data => {
                // Asegurarnos de que los datos estén disponibles y sean correctos
                const openingTime = data.opening_time || "12:00:00";
                const closingTime = data.closing_time || "21:00:00";

                const [startHour, startMinute] = openingTime.split(":");
                const [endHour, endMinute] = closingTime.split(":");

                let start = parseInt(startHour);
                let end = parseInt(endHour);

                // Ajustar las horas si es hoy y ya ha pasado la mitad del día
                if (selectedDay.toDateString() === now.toDateString()) {
                    start = now.getHours() + (now.getMinutes() >= 30 ? 1 : 0);
                }

                // Rellenar las opciones de horas en el select
                for (let h = start; h <= end; h++) {
                    ["00", "30"].forEach(min => {
                        const option = document.createElement('option');
                        option.value = `${h}:${min}`;
                        option.textContent = `${h}:${min}`;
                        timeSlot.appendChild(option);
                    });
                }
            })
            .catch(error => {
                console.error('Error al obtener el horario:', error);
            });
    }

    // Establecer el restaurante cuando se abra el modal
    const reserveButtons = document.querySelectorAll('[data-bs-toggle="modal"]');
    reserveButtons.forEach(button => {
        button.addEventListener('click', function() {
            const restaurante = this.getAttribute('data-restaurante');
            document.getElementById('restaurante').value = restaurante;
        });
    });
});


    </script>

<script>
document.addEventListener('DOMContentLoaded', async function () {
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('reservationDate').setAttribute('min', today);

    const reserveButtons = document.querySelectorAll('[data-bs-toggle="modal"]');
    reserveButtons.forEach(button => {
        button.addEventListener('click', async function() {
            const restaurantId = this.getAttribute('data-restaurante-id');
            document.getElementById('restaurante').value = restaurantId; // Usar el ID del restaurante

            try {
                const response = await fetch(`/get-schedule?restaurant_id=${restaurantId}`);
                if (!response.ok) {
                    throw new Error('Error al obtener horarios');
                }
                const schedule = await response.json();
                
                if (!schedule.opening_time || !schedule.closing_time) {
                    console.error('Horario no disponible.');
                    return;
                }

                const openingTime = parseInt(schedule.opening_time.split(':')[0]);
                const closingTime = parseInt(schedule.closing_time.split(':')[0]);
                
                const selectElement = document.createElement('select');
                selectElement.classList.add('form-select');
                selectElement.name = 'hora';
                selectElement.required = true;

                for (let hour = openingTime; hour < closingTime; hour++) {
                    const option = document.createElement('option');
                    option.value = `${hour}:00`;
                    option.textContent = `${hour}:00 - ${hour + 1}:00`;
                    selectElement.appendChild(option);
                }

                const form = document.getElementById('reservationForm');
                const existingSelect = form.querySelector('select[name="hora"]');
                if (existingSelect && existingSelect.parentNode === form) {
                    form.removeChild(existingSelect);
                }
                form.insertBefore(selectElement, form.children[2]);
            } catch (error) {
                console.error('Error al obtener horarios:', error);
            }
        });
    });
});
</script>



    <!-- Scripts de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <!-- Modal de Confirmación de Eliminación -->
<div class="modal fade" id="confirmarEliminacion" tabindex="-1" aria-labelledby="confirmarEliminacionLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-danger">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="confirmarEliminacionLabel">⚠️ Confirmar Eliminación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <p id="deleteMessage">¿Estás seguro de que deseas eliminar este restaurante? Esta acción no se puede deshacer.</p>
            </div>
            <div class="modal-footer">
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Sí, eliminar</button>
                </form>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var confirmDeleteModal = document.getElementById("confirmarEliminacion");

        confirmDeleteModal.addEventListener("show.bs.modal", function (event) {
            var button = event.relatedTarget;
            var restaurantId = button.getAttribute("data-id");
            var restaurantName = button.getAttribute("data-name");

            var deleteMessage = document.getElementById("deleteMessage");
            deleteMessage.textContent = `¿Estás seguro de que deseas eliminar el restaurante "${restaurantName}"?`;

            var deleteForm = document.getElementById("deleteForm");
            deleteForm.action = `/admin/products/${restaurantId}`;
        });
    });
</script>

@endsection