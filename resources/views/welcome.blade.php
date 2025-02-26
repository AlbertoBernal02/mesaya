@extends('layouts.app')

@section('title', 'Inicio')

@section('content')

@guest
@else
    @if (Auth::user()->role && Auth::user()->role == 'admin')
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addProductModal">Añadir Restaurante</button>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#restoreProductModal">Restaurar Restaurante</button>
    
        <!-- Modal para añadir producto -->
        <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addProductModalLabel">Añadir Producto</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nombre del Producto</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Categoría</label>
                                    <div>
                                        @foreach ($categories as $category)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="categories_id" id="category_{{ $category->id }}" value="{{ $category->id }}">
                                                <label class="form-check-label" for="category_{{ $category->id }}">
                                                    {{ $category->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
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
                                    <input type="number" class="form-control" id="total_price" name="total_price"  min="1" max="1000" required>
                                </div>

                                <div class="mb-3">
                                    <label for="capacity" class="form-label">Aforo</label>
                                    <input type="number" class="form-control" id="capacity" name="capacity" min="1" max="500" required>
                                </div>

                                <div class="mb-3">
                                    <label for="opening_time" class="form-label">Hora de Apertura</label>
                                    <input type="time" class="form-control" id="opening_time" name="opening_time" value="09:00" required>
                                </div>

                                <div class="mb-3">
                                    <label for="closing_time" class="form-label">Hora de Cierre</label>
                                    <input type="time" class="form-control" id="closing_time" name="closing_time" value="23:00" required>
                                </div>
                                <div class="mb-3">
    <label for="email" class="form-label">Correo Electrónico</label>
    <input type="email" class="form-control" id="email" name="email" required>
</div>
                                <button type="submit" class="btn btn-primary">Añadir Producto</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal para restaurar productos ocultos -->
            <div class="modal fade" id="restoreProductModal" tabindex="-1" aria-labelledby="restoreProductModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="restoreProductModalLabel">Restaurar Restaurante Oculto</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('admin.products.restore') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="hiddenProduct" class="form-label">Selecciona un Restaurante</label>
                                    <select class="form-select" id="hiddenProduct" name="product_id" required>
                                        <option value="">Selecciona un Restaurante</option>
                                        @foreach($hiddenProducts as $hiddenProduct)
                                            <option value="{{ $hiddenProduct->id }}">{{ $hiddenProduct->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-success w-100">Restaurar Restaurante</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    
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
                <img src="{{ asset('img/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                <div class="card-body text-center">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">{{ $product->category->name ?? 'Sin categoría' }}</p>
                    <p class="card-text">{{ $product->ubication ?? 'Sin ubicación' }}</p>
                    <p class="card-text">Precio Medio: {{ $product->total_price }}€</p>
                    <p class="card-text">Aforo Disponible: {{ $product->capacity }} personas</p>

                    @if (Auth::guest())
                        <a href="{{ route('login') }}" class="btn btn-success btn-reservar">Reservar Ahora</a>
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
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Ocultar</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
        <!-- 🟢 PAGINACIÓN MEJORADA -->
<div class="d-flex justify-content-center align-items-center mt-4">
    <nav aria-label="Paginación">
        <ul class="pagination pagination-sm mb-0">
            {!! $products->links('pagination::bootstrap-4') !!}
        </ul>
    </nav>
</div>

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
                        <input type="number" class="form-control" id="numPeople" name="num_comensales" min="1" max="50" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Reservar</button>
                </form>
            </div>
        </div>
    </div>
</div>





@endsection
