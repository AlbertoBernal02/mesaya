@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Verificación de Correo</div>

                <div class="card-body">
                    @if (session('message'))
                        <div class="alert alert-warning">
                            {{ session('message') }}
                        </div>
                    @endif

                    <p>Hemos enviado un correo de verificación a tu dirección de email. Por favor, revisa tu bandeja de entrada y haz clic en el enlace para activar tu cuenta.</p>

                    <p>Si no has recibido el correo, puedes solicitar que te lo reenviemos:</p>

                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="btn btn-primary">Reenviar Correo de Verificación</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
