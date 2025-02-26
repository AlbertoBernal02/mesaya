@extends('layouts.app')


@section('title', __('recuperar_contrasena'))


@section('content')
    <div class="container">
        <h2>{{ __('olvidaste_contrasena') }}</h2>
        <p>{{ __('ingresa_correo_para_restaurar') }}</p>


        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif


        <form action="{{ route('password.email') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">{{ __('correo_electronico') }}</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>


            <button type="submit" class="btn btn-primary">{{ __('enviar_enlace_restauracion') }}</button>
        </form>
    </div>
@endsection
