@extends('layouts.app')


@section('title', __('contacto'))


@section('content')
<div class="container mt-5">
    <h1>{{ __('contacto') }}</h1>
    <p>{{ __('contacto_mensaje') }}</p>


    <form action="{{ route('contacto.enviar') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="nombre" class="form-label">{{ __('nombre') }}</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $usuario->name }}" readonly>
            </div>
            <div class="col-md-6 mb-3">
                <label for="email" class="form-label">{{ __('correo_electronico') }}</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $usuario->email }}" readonly>
            </div>
        </div>
        <div class="mb-3">
            <label for="asunto" class="form-label">{{ __('asunto') }}</label>
            <input type="text" class="form-control" id="asunto" name="asunto" required>
        </div>
        <div class="mb-3">
            <label for="mensaje" class="form-label">{{ __('mensaje') }}</label>
            <textarea class="form-control" id="mensaje" name="mensaje" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">{{ __('enviar_mensaje') }}</button>
    </form>
</div>
@endsection





