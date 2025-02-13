@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Carrito de Reservas</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($reservas->isEmpty())
        <p>No tienes reservas pendientes.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Restaurante</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Número de comensales</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reservas as $reserva)
                    <tr>
                        <td>{{ $reserva->restaurante }}</td>
                        <td>{{ $reserva->fecha }}</td>
                        <td>{{ $reserva->hora }}</td>
                        <td>{{ $reserva->num_comensales }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <form action="{{ route('carrito.confirmar') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">Confirmar Reservas</button>
        </form>
    @endif
</div>
@endsection
