@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('verificacion_correo') }}</div>


                <div class="card-body">
                    @if (session('message'))
                    <div class="alert alert-warning">
                        {{ session('message') }}
                    </div>
                    @endif


                    <p>{{ __('correo_verificacion_enviado') }}</p>


                    <p>{{ __('reenviar_correo_mensaje') }}</p>


                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="btn btn-primary">{{ __('reenviar_correo_verificacion') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection