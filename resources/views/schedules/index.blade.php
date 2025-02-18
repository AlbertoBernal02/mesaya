@extends('layouts.app')

@section('content')

<div class="container">
    <h2>Editar Restaurante</h2>

    <a href="{{ route('restaurant.products.edit', $restaurant->id) }}" class="btn btn-warning mb-3">Editar Restaurante</a>
</div>

@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const selectElement = document.getElementById('unavailable_hours');
            const message = document.querySelector('.form-text');

            selectElement.addEventListener('change', function () {
                // Mostrar las horas seleccionadas
                const selectedHours = Array.from(selectElement.selectedOptions).map(option => option.value);
                if (selectedHours.length > 0) {
                    message.textContent = `Has seleccionado ${selectedHours.length} hora(s): ${selectedHours.join(', ')}`;
                } else {
                    message.textContent = 'Mantén presionada la tecla Ctrl o Cmd para seleccionar múltiples horas.';
                }
            });
        });
    </script>
@endsection
