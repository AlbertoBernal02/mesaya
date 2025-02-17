@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Producto</h2>

    <form action="{{ route(Auth::user()->role == 'restaurant' ? 'restaurant.products.update' : 'admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nombre del Producto</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}" required>
        </div>

        <div class="mb-3">
            <label for="categories_id" class="form-label">Categoría</label>
            <select class="form-select" id="categories_id" name="categories_id" required>
                <option value="{{ $product->categories_id }}">{{ $product->category }}</option>
                <!-- Aquí puedes cargar otras categorías -->
            </select>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Imagen</label>
            <!-- Si hay una imagen, mostrarla -->
            @if($product->image)
                <div class="mb-2">
                    <img id="imagePreview" src="{{ asset('storage/' . $product->image) }}" alt="Imagen del producto" style="max-width: 150px;">
                </div>
            @else
                <div class="mb-2">
                    <img id="imagePreview" src="default_image_path_here" alt="Imagen del producto" style="max-width: 150px;">
                </div>
            @endif
            <input type="file" class="form-control" id="image" name="image" onchange="previewImage(event)">
        </div>

        <div class="mb-3">
            <label for="ubication" class="form-label">Ubicación</label>
            <input type="text" class="form-control" id="ubication" name="ubication" value="{{ $product->ubication }}" required>
        </div>

        <div class="mb-3">
            <label for="total_price" class="form-label">Precio Medio</label>
            <input type="number" class="form-control" id="total_price" name="total_price" value="{{ $product->total_price }}" required>
        </div>

        <div class="mb-3">
            <label for="capacity" class="form-label">Aforo</label>
            <input type="number" class="form-control" id="capacity" name="capacity" value="{{ $product->capacity }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    </form>
</div>

<script>
    // Función para actualizar la vista previa de la imagen
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const output = document.getElementById('imagePreview');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection
