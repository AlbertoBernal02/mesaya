@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Añadir Producto</h2>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nombre del Producto</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="mb-3">
    <label for="categories_id" class="form-label">Categoría</label>
    <select class="form-select" id="categories_id" name="categories_id" required>
        <option value="">Selecciona una categoría</option>
        
    </select>
</div>



        <div class="mb-3">
            <label for="total_price" class="form-label">Precio Total</label>
            <input type="number" class="form-control" id="total_price" name="total_price" required>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Imagen del Producto</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>

        <button type="submit" class="btn btn-success">Añadir Producto</button>
    </form>
</div>
@endsection
