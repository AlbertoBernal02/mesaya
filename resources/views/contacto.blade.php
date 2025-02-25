@extends('layouts.app')

@section('title', 'Contacto')

@section('content')
<div class="container mt-5">
    <h1>Contacto</h1>
    <p>Si tienes alguna pregunta, por favor completa el siguiente formulario y nos pondremos en contacto contigo lo antes posible.</p>

    <form action="{{ route('contacto.enviar') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $usuario->name }}" readonly>
            </div>
            <div class="col-md-6 mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $usuario->email }}" readonly>
            </div>
        </div>
        <div class="mb-3">
            <label for="asunto" class="form-label">Asunto</label>
            <input type="text" class="form-control" id="asunto" name="asunto" required>
        </div>
        <div class="mb-3">
            <label for="mensaje" class="form-label">Mensaje</label>
            <textarea class="form-control" id="mensaje" name="mensaje" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Enviar Mensaje</button>
    </form>
</div>
@endsection
