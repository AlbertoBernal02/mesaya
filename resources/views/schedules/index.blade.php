@extends('layouts.app')

@section('content')

<div class="container">
    <h2>Editar Restaurante</h2>

    <!-- Botón para redirigir a la página de edición -->
    <a href="{{ route('admin.products.edit', $restaurant->id) }}" class="btn btn-warning mb-3">Editar Restaurante</a>

    <!-- Formulario para configurar horario, sin editar el restaurante -->
    <form action="{{ route('schedules.index1') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <h3>Configurar Horario</h3>

        <!-- Hora de apertura y cierre -->
        <div class="mb-3">
            <label for="opening_time" class="form-label">Hora de Apertura</label>
            <input type="time" class="form-control" id="opening_time" name="opening_time" value="{{ old('opening_time', $schedule->opening_time ?? '') }}" required>
        </div>
        <div class="mb-3">
            <label for="closing_time" class="form-label">Hora de Cierre</label>
            <input type="time" class="form-control" id="closing_time" name="closing_time" value="{{ old('closing_time', $schedule->closing_time ?? '') }}" required>
        </div>

        <!-- Horas no disponibles -->
        <h4 class="mt-5">Horas No Disponibles</h4>
        <div class="mb-3">
            <label for="unavailable_hours" class="form-label">Selecciona las horas a bloquear</label>
            <select class="form-select" id="unavailable_hours" name="unavailable_hours[]" multiple>
                @for ($hour = strtotime('00:00'); $hour < strtotime('24:00'); $hour += 1800)
                <option value="{{ date('H:i', $hour) }}" 
                    @if (in_array(date('H:i', $hour), old('unavailable_hours', $schedule->unavailable_hours ?? []))) selected @endif>
                    {{ date('H:i', $hour) }}
                </option>
                @endfor
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    </form>
</div>

@endsection
