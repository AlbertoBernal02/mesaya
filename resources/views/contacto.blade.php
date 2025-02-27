@extends('layouts.app')

@section('title', __('contacto'))

@section('content')
<div class="container mt-5">
    <div class="text-center mb-4">
        <h1 class="fw-bold">{{ __('contacto') }}</h1>
        <p class="text-muted">{{ __('contacto_mensaje') }}</p>
    </div>

    <div class="card shadow-lg p-4">
        <form action="{{ route('contacto.enviar') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nombre" class="form-label">{{ __('nombre') }}</label>
                    <input type="text" class="form-control input-custom" id="nombre" name="nombre" value="{{ $usuario->name }}" readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">{{ __('correo_electronico') }}</label>
                    <input type="email" class="form-control input-custom" id="email" name="email" value="{{ $usuario->email }}" readonly>
                </div>
            </div>
            <div class="mb-3">
                <label for="asunto" class="form-label">{{ __('asunto') }}</label>
                <input type="text" class="form-control input-custom" id="asunto" name="asunto" required>
            </div>
            <div class="mb-3">
                <label for="mensaje" class="form-label">{{ __('mensaje') }}</label>
                <textarea class="form-control input-custom" id="mensaje" name="mensaje" rows="5" placeholder="Escribe tu mensaje aquí..." required></textarea>
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-submit btn-custom">
                    <i class="fas fa-paper-plane"></i> {{ __('enviar_mensaje') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection





