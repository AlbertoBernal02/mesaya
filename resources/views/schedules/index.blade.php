@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Configurar Horario</h2>

    <form method="POST" action="{{ route('schedule.store') }}">
        @csrf
        <div class="mb-3">
            <label for="opening_time" class="form-label">Hora de Apertura</label>
            <input type="time" class="form-control" id="opening_time" name="opening_time" value="{{ $schedule->opening_time ?? '' }}" required>
        </div>
        <div class="mb-3">
            <label for="closing_time" class="form-label">Hora de Cierre</label>
            <input type="time" class="form-control" id="closing_time" name="closing_time" value="{{ $schedule->closing_time ?? '' }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar Horario</button>
    </form>

    <h3 class="mt-5">Horas No Disponibles</h3>
    <form method="POST" action="{{ route('schedule.unavailable') }}">
        @csrf
        <div class="mb-3">
            <label for="unavailable_hours" class="form-label">Selecciona las horas a bloquear</label>
            <select class="form-select" id="unavailable_hours" name="unavailable_hours[]" multiple>
                @for ($hour = strtotime('00:00'); $hour < strtotime('24:00'); $hour += 1800)
                <option value="{{ date('H:i', $hour) }}" 
                    @if ($schedule && in_array(date('H:i', $hour), $schedule->unavailable_hours ?? [])) selected @endif>
                    {{ date('H:i', $hour) }}
                </option>
                @endfor
            </select>
        </div>
        <button type="submit" class="btn btn-danger">Actualizar Horas Bloqueadas</button>
    </form>
</div>
@endsection