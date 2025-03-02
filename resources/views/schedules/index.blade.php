@extends('layouts.app') <!-- Extiende la plantilla 'app' -->

@section('title', __('panel_restaurante')) <!-- Establece el título de la página -->

@section('content')

<div class="container mt-5">
    <div class="text-center mb-4">
        <h2 class="fw-bold">{{ __('panel_restaurante_h2') }}</h2> <!-- Título de la página -->
    </div>

    <div class="d-flex justify-content-center gap-3">
        <!-- Botón para editar restaurante -->
        <a href="{{ route('restaurant.products.edit', $restaurant->id) }}" class="btn btn-edit btn-custom">
            <i class="fas fa-edit"></i> {{ __('editar_restaurante') }} <!-- Texto del botón -->
        </a>

        <!-- Botón para ir a reservas -->
        <a href="{{ route('restaurant.reservas') }}" class="btn btn-reservas btn-custom">
            <i class="fas fa-calendar-alt"></i> {{ __('ir_a_reservas') }} <!-- Texto del botón -->
        </a>
    </div>
</div>

@endsection