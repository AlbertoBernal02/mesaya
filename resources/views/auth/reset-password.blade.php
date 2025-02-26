@extends('layouts.app')


@section('title', __('restablecer_contrasena'))


@section('content')
<div class="container">
    <h2>{{ __('restablecer_contrasena') }}</h2>
    <p>{{ __('introducir_nueva_contrasena') }}</p>


    <form action="{{ route('password.update') }}" method="POST">
        @csrf
        <input type="hidden" name="token" value="{{ request()->route('token') }}">


        <div class="mb-3">
            <label for="email" class="form-label">{{ __('correo_electronico') }}</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>


        <div class="mb-3">
            <label for="password" class="form-label">{{ __('nueva_contrasena') }}</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>


        <div class="mb-3">
            <label for="password_confirmation" class="form-label">{{ __('confirmar_contrasena') }}</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
        </div>


        <button type="submit" class="btn btn-primary">{{ __('restablecer_contrasena') }}</button>
    </form>
</div>
@endsection



