@extends('layouts.app')

@section('title', 'Acceso Denegado')

@section('content')
<div class="container text-center mt-5">
    <div class="card shadow-lg p-5 mx-auto ad">
        <h1 class="text-danger"><i class="fas fa-exclamation-triangle"></i> Acceso Denegado</h1>
        <p class="mt-3 text-muted">No tienes los permisos necesarios para acceder a esta página.</p>
        <a href="{{ url('/') }}" class="btn btn-primary mt-3"><i class="fas fa-home"></i> Volver al Inicio</a>
    </div>
</div>
@endsection