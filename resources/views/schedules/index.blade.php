@extends('layouts.app')

@section('title', __('panel_restaurante'))

@section('content')

<div class="container mt-5">
    <div class="text-center mb-4">
        <h2 class="fw-bold">{{ __('panel_restaurante_h2') }}</h2>
    </div>

    <div class="d-flex justify-content-center gap-3">
        <!-- Botón para editar restaurante -->
        <a href="{{ route('restaurant.products.edit', $restaurant->id) }}" class="btn btn-edit btn-custom">
            <i class="fas fa-edit"></i> {{ __('editar_restaurante') }}
        </a>

        <!-- Botón para ir a reservas -->
        <a href="{{ route('restaurant.reservas') }}" class="btn btn-reservas btn-custom">
            <i class="fas fa-calendar-alt"></i> {{ __('ir_a_reservas') }}
        </a>
    </div>
</div>

@endsection

