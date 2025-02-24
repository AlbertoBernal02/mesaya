@extends('layouts.app')

@section('title', 'Recuperar Contraseña')

@section('content')
<div class="container">
    <h2>¿Olvidaste tu contraseña?</h2>
    <p>Ingresa tu dirección de correo electrónico y te enviaremos un enlace para restablecer tu contraseña.</p>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form action="{{ route('password.email') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Correo Electrónico</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <button type="submit" class="btn btn-primary">Enviar Enlace de Restablecimiento</button>
    </form>
</div>
@endsection
