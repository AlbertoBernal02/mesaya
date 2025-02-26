@extends('layouts.app')

@section('title', 'Panel Restaurante')

@section('content')

<div class="container">
    <h2>Editar Restaurante</h2>

    <a href="{{ route('restaurant.products.edit', $restaurant->id) }}" class="btn btn-warning mb-3">Editar Restaurante</a>

    <!-- Botón para ir a reservas -->
    <a href="{{ route('restaurant.reservas') }}" class="btn btn-primary mb-3">📆 Ir a Reservas</a>
</div>

@endsection
