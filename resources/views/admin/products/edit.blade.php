@extends('layouts.app')

@section('title', __('editar_producto'))

@section('content')
<div class="container mt-5">
    <div class="text-center mb-4">
        <h2 class="fw-bold">{{ __('editar_producto') }}</h2>
    </div>

    <div class="card shadow-lg p-4">
        <form action="{{ route(Auth::user()->role == 'restaurant' ? 'restaurant.products.update' : 'admin.products.update', $product->id) }}"
            method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">{{ __('nombre_producto') }}</label>
                <input type="text" class="form-control input-custom" id="name" name="name" value="{{ $product->name }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">{{ __('categoria') }}</label>
                <div>
                    @foreach ($categories as $category)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="categories_id"
                                id="category_{{ $category->id }}" value="{{ $category->id }}"
                                {{ $product->categories_id == $category->id ? 'checked' : '' }}>
                            <label class="form-check-label" for="category_{{ $category->id }}">
                                {{ $category->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">{{ __('imagen') }}</label>
                <div class="image-preview mb-2">
                    <img id="imagePreview" src="{{ $product->image ? asset('storage/' . $product->image) : asset('img/default.png') }}"
                        alt="{{ __('imagen_producto') }}">
                </div>
                <input type="file" class="form-control input-custom" id="image" name="image" onchange="previewImage(event)">
            </div>

            <div class="mb-3">
                <label for="ubication" class="form-label">{{ __('ubicacion') }}</label>
                <input type="text" class="form-control input-custom" id="ubication" name="ubication"
                    value="{{ $product->ubication }}" required>
            </div>

            <div class="mb-3">
                <label for="total_price" class="form-label">{{ __('precio_medio') }}</label>
                <input type="number" class="form-control input-custom" id="total_price" name="total_price"
                    value="{{ $product->total_price }}" min="1" max="1000" required>
            </div>

            <div class="mb-3">
                <label for="capacity" class="form-label">{{ __('aforo') }}</label>
                <input type="number" class="form-control input-custom" id="capacity" name="capacity" value="{{ $product->capacity }}"
                    min="1" max="500" required>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="opening_time" class="form-label">{{ __('hora_apertura') }}</label>
                    <input type="time" class="form-control input-custom" id="opening_time" name="opening_time" 
                        value="{{ $product->schedule->opening_time }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="closing_time" class="form-label">{{ __('hora_cierre') }}</label>
                    <input type="time" class="form-control input-custom" id="closing_time" name="closing_time" 
                        value="{{ $product->schedule->closing_time }}">
                </div>
            </div>

            <h4 class="mt-4">{{ __('horas_no_disponibles') }}</h4>
            <div class="mb-3">
                <button type="button" id="toggle-all" class="btn btn-secondary mb-2">
                     {{ __('seleccionar_deseleccionar') }}
                </button>
                <div id="unavailable-hours-container" class="row">
                    @foreach($product->schedule->unavailable_hours ?? [] as $hour)
                        <div class="col-md-3">
                            <div class="form-check">
                                <input class="form-check-input unavailable-hour" type="checkbox" 
                                    name="unavailable_hours[]" value="{{ $hour }}" id="hora_{{ $hour }}" checked>
                                <label class="form-check-label" for="hora_{{ $hour }}">{{ $hour }}</label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-submit btn-custom">
                    <i class="fas fa-save"></i> {{ __('guardar_cambios') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
