@extends('layouts.app')


@section('title', __('panel_restaurante'))


@section('content')


    <div class="container">
        <h2>{{ __('editar_restaurante') }}</h2>


        <a href="{{ route('restaurant.products.edit', $restaurant->id) }}"
            class="btn btn-warning mb-3">{{ __('editar_restaurante') }}</a>


        <!-- Botón para ir a reservas -->
        <a href="{{ route('restaurant.reservas') }}" class="btn btn-primary mb-3">📆 {{ __('ir_a_reservas') }}</a>
    </div>


@endsection
