@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('iniciar_sesion') }}</div>


                    <div class="card-body">
                        @if (session('message'))
                            <div class="alert alert-warning">
                                {{ session('message') }}
                            </div>
                        @endif


                        @if (Auth::check() && !Auth::user()->hasVerifiedEmail())
                            <div class="alert alert-danger">
                                {{ __('cuenta_no_verificada') }}


                                <form method="POST" action="{{ route('verification.send') }}" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-link">{{ __('reenviar_correo') }}</button>
                                </form>
                            </div>
                        @endif


                        <form method="POST" action="{{ route('login') }}">
                            @csrf


                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('correo_electronico') }}</label>


                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>


                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('contrasena') }}</label>


                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">


                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('iniciar_sesion') }}
                                    </button>


                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('olvido_contrasena') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
