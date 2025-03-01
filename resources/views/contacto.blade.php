@extends('layouts.app') <!-- Extiende la plantilla 'app' -->

@section('title', __('contacto')) <!-- Establece el título de la página -->

@section('content')
<div class="container mt-5">
    <div class="text-center mb-4">
        <h1 class="fw-bold">{{ __('contacto') }}</h1> <!-- Título de la página -->
        <p class="text-muted">{{ __('contacto_mensaje') }}</p> <!-- Mensaje de introducción -->
    </div>

    <div class="card shadow-lg p-4">
        <form action="{{ route('contacto.enviar') }}" method="POST"> <!-- Formulario para enviar el mensaje de contacto -->
            @csrf <!-- Token CSRF para seguridad -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nombre" class="form-label">{{ __('nombre') }}</label> <!-- Etiqueta para el nombre -->
                    <input type="text" class="form-control input-custom" id="nombre" name="nombre" value="{{ $usuario->name }}" readonly> <!-- Campo de entrada para el nombre -->
                </div>
                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">{{ __('correo_electronico') }}</label> <!-- Etiqueta para el correo electrónico -->
                    <input type="email" class="form-control input-custom" id="email" name="email" value="{{ $usuario->email }}" readonly> <!-- Campo de entrada para el correo electrónico -->
                </div>
            </div>
            <div class="mb-3">
                <label for="asunto" class="form-label">{{ __('asunto') }}</label> <!-- Etiqueta para el asunto -->
                <input type="text" class="form-control input-custom" id="asunto" name="asunto" required> <!-- Campo de entrada para el asunto -->
            </div>
            <div class="mb-3">
                <label for="mensaje" class="form-label">{{ __('mensaje') }}</label> <!-- Etiqueta para el mensaje -->
                <textarea class="form-control input-custom" id="mensaje" name="mensaje" rows="5" placeholder="Escribe tu mensaje aquí..." required></textarea> <!-- Área de texto para el mensaje -->
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-submit btn-custom">
                    <i class="fas fa-paper-plane"></i> {{ __('enviar_mensaje') }} <!-- Botón para enviar el mensaje -->
                </button>
            </div>
        </form>
    </div>
</div>
@endsection





