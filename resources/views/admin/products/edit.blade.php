@extends('layouts.app')


@section('title', __('editar_producto'))


@section('content')
    <div class="container">
        <h2>{{ __('editar_producto') }}</h2>


        <form
            action="{{ route(Auth::user()->role == 'restaurant' ? 'restaurant.products.update' : 'admin.products.update', $product->id) }}"
            method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')


            <div class="mb-3">
                <label for="name" class="form-label">{{ __('nombre_producto') }}</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}" required>
            </div>


            <div class="mb-3">
                <label class="form-label">{{ __('categoria') }}</label>
                <div>
                    @foreach ($categories as $category)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="categories_id"
                                id="category_{{ $category->id }}" value="{{ $category->id }}"
                                {{ $product->categories_id == $category->id ? 'checked' : '' }}>
                            <label class="form-check-label" for="category_{{ $category->id }}">
                                {{ $category->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>


            <div class="mb-3">
                <label for="image" class="form-label">{{ __('imagen') }}</label>
                @if ($product->image)
                    <div class="mb-2">
                        <img id="imagePreview" src="{{ asset('storage/' . $product->image) }}"
                            alt="{{ __('imagen_producto') }}" style="max-width: 150px;">
                    </div>
                @else
                    <div class="mb-2">
                        <img id="imagePreview" src="default_image_path_here" alt="{{ __('imagen_producto') }}"
                            style="max-width: 150px;">
                    </div>
                @endif
                <input type="file" class="form-control" id="image" name="image" onchange="previewImage(event)">
            </div>


            <div class="mb-3">
                <label for="ubication" class="form-label">{{ __('ubicacion') }}</label>
                <input type="text" class="form-control" id="ubication" name="ubication"
                    value="{{ $product->ubication }}" required>
            </div>


            <div class="mb-3">
                <label for="total_price" class="form-label">{{ __('precio_medio') }}</label>
                <input type="number" class="form-control" id="total_price" name="total_price"
                    value="{{ $product->total_price }}" min="1" max="1000" required>
            </div>


            <div class="mb-3">
                <label for="capacity" class="form-label">{{ __('aforo') }}</label>
                <input type="number" class="form-control" id="capacity" name="capacity" value="{{ $product->capacity }}"
                    min="1" max="500" required>
            </div>


            <div class="mb-3">
                <label for="opening_time" class="form-label">{{ __('hora_apertura') }}</label>
                <input type="time" class="form-control" id="opening_time" name="opening_time" value="09:00" required>
            </div>


            <div class="mb-3">
                <label for="closing_time" class="form-label">{{ __('hora_cierre') }}</label>
                <input type="time" class="form-control" id="closing_time" name="closing_time" value="23:00" required>
            </div>


            <h4 class="mt-5">{{ __('horas_no_disponibles') }}</h4>
            <div class="mb-3">
                <label for="unavailable_hours" class="form-label">{{ __('selecciona_horas_bloquear') }}</label>
                <select class="form-select" id="unavailable_hours" name="unavailable_hours[]" multiple size="10">
                    @for ($hour = strtotime('00:00'); $hour < strtotime('24:00'); $hour += 1800)
                        <option value="{{ date('H:i', $hour) }}" @if (in_array(date('H:i', $hour), old('unavailable_hours', $schedule->unavailable_hours ?? []))) selected @endif>
                            {{ date('H:i', $hour) }}
                        </option>
                    @endfor
                </select>
                <small class="form-text text-muted">{{ __('mantener_ctrl_seleccionar') }}</small>
            </div>


            <button type="submit" class="btn btn-primary">{{ __('guardar_cambios') }}</button>
        </form>
    </div>
@endsection
