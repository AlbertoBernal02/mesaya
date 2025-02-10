@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Panel de Administración</h1>

    <a href="{{ route('admin.restaurants.create') }}" class="btn btn-success mb-3">Agregar Restaurante</a>

    <div class="row">
        @foreach ($restaurants as $restaurant)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <img src="{{ asset('img/' . $restaurant->image) }}" class="card-img-top" alt="{{ $restaurant->name }}" style="height: 150px; object-fit: cover;">
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $restaurant->name }}</h5>
                        <p class="card-text">{{ $restaurant->category->name }}</p>
                        <p class="card-text">Precio Medio: {{ $restaurant->total_price }}€</p>

                        <a href="{{ route('admin.restaurants.edit', $restaurant->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('admin.restaurants.destroy', $restaurant->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
