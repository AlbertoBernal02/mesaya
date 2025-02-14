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
                        <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#reserveModal" data-restaurante="{{ $product->name }}">Reservar Ahora</a>
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
                timeSlot.innerHTML = '';
                let startHour = 12, endHour = 21; // Horario estándar de reservas
               
                if (selectedDay.toDateString() === now.toDateString()) {
                    startHour = now.getHours() + (now.getMinutes() >= 30 ? 1 : 0);
                }
               
                for (let h = startHour; h <= endHour; h++) {
                    ["00", "30"].forEach(min => {
                        if (h < endHour || min === "00") {
                            const option = document.createElement('option');
                            option.value = `${h}:${min}`;
                            option.textContent = `${h}:${min}`;
                            timeSlot.appendChild(option);
                        }
                    });
                }
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


</body>


</html>