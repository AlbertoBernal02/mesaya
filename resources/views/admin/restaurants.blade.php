@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Panel de Administración</h1>

    <a href="{{ route('admin.restaurants.create') }}" class="btn btn-success mb-3">Agregar Restaurante</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Precio Medio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($restaurants as $restaurant)
                <tr>
                    <td>{{ $restaurant->name }}</td>
                    <td>{{ $restaurant->category->name }}</td>
                    <td>{{ $restaurant->total_price }}€</td>
                    <td>
                        <a href="{{ route('admin.restaurants.edit', $restaurant->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('admin.restaurants.destroy', $restaurant->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
